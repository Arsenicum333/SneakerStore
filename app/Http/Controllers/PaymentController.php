<?php

namespace App\Http\Controllers;

use App\Models\ProductVariantSize;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class PaymentController extends Controller
{
    public function index(Request $request): View
    {
        [$items, $subtotal] = $this->resolveBagItems();

        return view('payment', [
            'items' => $items,
            'subtotal' => $subtotal,
            'shippingFee' => 19.99,
            'isAuthenticated' => Auth::check(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('bag_status', 'Please sign in to place an order.');
        }

        $request->merge([
            'email' => trim((string) $request->input('email', '')),
            'first_name' => trim((string) $request->input('first_name', '')),
            'last_name' => trim((string) $request->input('last_name', '')),
            'address' => trim((string) $request->input('address', '')),
            'phone_number' => trim((string) $request->input('phone_number', '')),
            'card_name' => trim((string) $request->input('card_name', '')),
            'card_number' => preg_replace('/\D+/', '', (string) $request->input('card_number', '')),
            'card_expiry' => str_replace(' ', '', (string) $request->input('card_expiry', '')),
            'card_cvv' => preg_replace('/\D+/', '', (string) $request->input('card_cvv', '')),
        ]);

        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'first_name' => ['required', 'string', 'min:2', 'max:20', "regex:/^[\p{L}\p{M}'\-\s]+$/u"],
            'last_name' => ['required', 'string', 'min:2', 'max:20', "regex:/^[\p{L}\p{M}'\-\s]+$/u"],
            'address' => ['required', 'string', 'min:5', 'max:255'],
            'phone_number' => ['required', 'string', 'regex:/^\+?[0-9\s\-\(\)]{10,20}$/'],
            'shipping_method' => ['required', 'in:extra_fast,nova_poshta'],
            'payment_method' => ['required', 'in:card,paypal,google_pay'],
            'card_name' => ['exclude_unless:payment_method,card', 'required', 'string', 'min:2', 'max:255', "regex:/^[\p{L}\p{M}'\-\s]+$/u"],
            'card_number' => ['exclude_unless:payment_method,card', 'required', 'digits_between:12,19'],
            'card_expiry' => [
                'exclude_unless:payment_method,card',
                'required',
                'regex:/^(0[1-9]|1[0-2])\/\d{2}$/',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    if (!is_string($value) || !preg_match('/^(0[1-9]|1[0-2])\/(\d{2})$/', $value, $matches)) {
                        return;
                    }

                    $expiryMonth = (int) $matches[1];
                    $expiryYear = 2000 + (int) $matches[2];
                    $expiresAt = Carbon::create($expiryYear, $expiryMonth, 1)->endOfMonth()->endOfDay();

                    if ($expiresAt->isPast()) {
                        $fail('The card expiry date is invalid.');
                    }
                },
            ],
            'card_cvv' => ['exclude_unless:payment_method,card', 'required', 'digits_between:3,4'],
        ]);

        [$items, $subtotal] = $this->resolveBagItems();

        if ($items === []) {
            return redirect()->route('bag')->with('bag_status', 'Your bag is empty.');
        }

        $shippingFee = $validated['shipping_method'] === 'extra_fast' ? 19.99 : 0.0;
        $totalAmount = $subtotal + $shippingFee;
        $paymentMethodLabel = [
            'card' => 'Credit or Debit Card',
            'paypal' => 'PayPal',
            'google_pay' => 'Google Pay',
        ][$validated['payment_method']];

        try {
            $orderId = DB::transaction(function () use ($validated, $items, $totalAmount, $paymentMethodLabel) {
                $orderId = DB::table('orders')->insertGetId([
                    'user_id' => Auth::id(),
                    'session_token' => session()->getId(),
                    'total_amount' => $totalAmount,
                    'status' => 'pending',
                    'payment_method' => $paymentMethodLabel,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::table('shipping_details')->insert([
                    'order_id' => $orderId,
                    'email' => $validated['email'],
                    'first_name' => $validated['first_name'],
                    'last_name' => $validated['last_name'],
                    'address' => $validated['address'],
                    'phone_number' => $validated['phone_number'],
                    'shipping_method' => $validated['shipping_method'] === 'extra_fast' ? 'Extra Fast' : 'Nova Poshta',
                ]);

                foreach ($items as $item) {
                    $stockUpdated = DB::table('product_variant_sizes')
                        ->where('id', $item['size_id'])
                        ->where('stock_quantity', '>=', $item['quantity'])
                        ->decrement('stock_quantity', $item['quantity']);

                    if ($stockUpdated === 0) {
                        throw new RuntimeException('Insufficient stock for one or more items.');
                    }

                    DB::table('order_items')->insert([
                        'order_id' => $orderId,
                        'variant_size_id' => $item['size_id'],
                        'quantity' => $item['quantity'],
                        'price_at_time' => $item['price'],
                    ]);
                }

                DB::table('order_histories')->insert([
                    'order_id' => $orderId,
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                return $orderId;
            });
        } catch (RuntimeException $exception) {
            return redirect()->route('bag')->with('bag_status', 'Some items are no longer available in the requested quantity.');
        }

        $this->clearStoredItems();

        return redirect()
            ->route('payment')
            ->with('payment_success', true)
            ->with('payment_order_id', $orderId)
            ->with('payment_total', $totalAmount);
    }

    private function resolveBagItems(): array
    {
        $storedItems = $this->getStoredItems();
        $sizeIds = array_map('intval', array_keys($storedItems));

        $sizes = ProductVariantSize::query()
            ->whereIn('id', $sizeIds)
            ->with([
                'variant.product',
                'variant.images' => fn ($query) => $query
                    ->orderByDesc('is_main')
                    ->orderBy('display_order'),
            ])
            ->get()
            ->keyBy('id');

        $items = [];
        $subtotal = 0.0;

        foreach ($storedItems as $sizeId => $sessionItem) {
            $size = $sizes->get((int) $sizeId);

            if (!$size) {
                continue;
            }

            $quantity = max(1, min(99, (int) ($sessionItem['quantity'] ?? 1)));
            $availableStock = max(0, (int) $size->stock_quantity);

            if ($availableStock > 0) {
                $quantity = min($quantity, $availableStock);
            }

            $price = (float) $size->variant->price;
            $lineTotal = $price * $quantity;
            $imageUrl = $size->variant->images->first()?->image_url ?? 'assets/sneakers/sneakers1_1.avif';

            $subtotal += $lineTotal;

            $items[] = [
                'size_id' => $size->id,
                'product_id' => $size->variant->product->id,
                'variant_id' => $size->variant->id,
                'product_name' => $size->variant->product->name,
                'gender' => $size->variant->product->gender,
                'sport' => $size->variant->product->sport,
                'color' => $size->variant->color,
                'size' => $size->size,
                'quantity' => $quantity,
                'price' => $price,
                'line_total' => $lineTotal,
                'image_url' => $imageUrl,
            ];
        }

        return [$items, $subtotal];
    }

    private function getStoredItems(): array
    {
        if (!Auth::check()) {
            return session('bag.items', []);
        }

        $bagId = $this->getOrCreateUserBagId((int) Auth::id());

        return DB::table('bag_items')
            ->where('bag_id', $bagId)
            ->get(['variant_size_id', 'quantity'])
            ->mapWithKeys(fn ($row) => [(string) $row->variant_size_id => ['quantity' => (int) $row->quantity]])
            ->all();
    }

    private function clearStoredItems(): void
    {
        if (!Auth::check()) {
            session()->forget('bag.items');

            return;
        }

        $bagId = $this->getOrCreateUserBagId((int) Auth::id());
        DB::table('bag_items')->where('bag_id', $bagId)->delete();
    }

    private function getOrCreateUserBagId(int $userId): int
    {
        $bagId = DB::table('bags')
            ->where('user_id', $userId)
            ->value('id');

        if ($bagId) {
            DB::table('bags')
                ->where('id', $bagId)
                ->update([
                    'session_token' => session()->getId(),
                    'updated_at' => now(),
                ]);

            return (int) $bagId;
        }

        return (int) DB::table('bags')->insertGetId([
            'user_id' => $userId,
            'session_token' => session()->getId(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
