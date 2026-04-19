<?php

namespace App\Http\Controllers;

use App\Models\ProductVariantSize;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BagController extends Controller
{
    public function index(): View
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

        return view('bag', [
            'items' => $items,
            'subtotal' => $subtotal,
        ]);
    }

    public function add(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'variant_id' => ['required', 'integer', 'exists:product_variants,id'],
            'variant_size_id' => ['required', 'integer', 'exists:product_variant_sizes,id'],
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $size = ProductVariantSize::query()
            ->where('id', $validated['variant_size_id'])
            ->where('variant_id', $validated['variant_id'])
            ->whereHas('variant', fn ($query) => $query->where('product_id', $validated['product_id']))
            ->firstOrFail();

        $items = $this->getStoredItems();
        $sizeKey = (string) $size->id;

        $existingQuantity = (int) ($items[$sizeKey]['quantity'] ?? 0);
        $requestedQuantity = (int) $validated['quantity'];
        $maxPerItem = 99;
        $stockQuantity = max(0, (int) $size->stock_quantity);

        if ($stockQuantity === 0) {
            return redirect()->back()->with('bag_status', 'This size is currently out of stock.');
        }

        $availableByStock = max(0, $stockQuantity - $existingQuantity);
        $availableByLimit = max(0, $maxPerItem - $existingQuantity);
        $allowedToAdd = min($availableByStock, $availableByLimit);

        if ($allowedToAdd <= 0) {
            return redirect()->back()->with('bag_status', 'You already added the maximum available quantity for this size.');
        }

        $addedQuantity = min($requestedQuantity, $allowedToAdd);
        $newQuantity = $existingQuantity + $addedQuantity;

        $items[$sizeKey] = ['quantity' => $newQuantity];

        $this->saveStoredItems($items);

        if ($addedQuantity < $requestedQuantity) {
            return redirect()->back()->with('bag_status', 'Only available quantity was added for this size.');
        }

        return redirect()->back()->with('bag_status', 'Product added to bag.');
    }

    public function update(Request $request, int $sizeId): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $items = $this->getStoredItems();
        $sizeKey = (string) $sizeId;

        if (!array_key_exists($sizeKey, $items)) {
            return redirect()->route('bag');
        }

        $size = ProductVariantSize::query()->find($sizeId);

        if (!$size) {
            unset($items[$sizeKey]);
            $this->saveStoredItems($items);

            return redirect()->route('bag');
        }

        $newQuantity = (int) $validated['quantity'];

        $stockQuantity = max(0, (int) $size->stock_quantity);

        if ($stockQuantity === 0) {
            unset($items[$sizeKey]);
            $this->saveStoredItems($items);

            return redirect()->route('bag')->with('bag_status', 'This size is out of stock and was removed from your bag.');
        }

        if ($newQuantity > $stockQuantity) {
            $newQuantity = $stockQuantity;
            $items[$sizeKey]['quantity'] = max(1, $newQuantity);
            $this->saveStoredItems($items);

            return redirect()->route('bag')->with('bag_status', 'Quantity updated to the maximum available for this size.');
        }

        $items[$sizeKey]['quantity'] = max(1, $newQuantity);
        $this->saveStoredItems($items);

        return redirect()->route('bag');
    }

    public function remove(int $sizeId): RedirectResponse
    {
        $items = $this->getStoredItems();
        unset($items[(string) $sizeId]);
        $this->saveStoredItems($items);

        return redirect()->route('bag');
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

    private function saveStoredItems(array $items): void
    {
        if (!Auth::check()) {
            session(['bag.items' => $items]);

            return;
        }

        $bagId = $this->getOrCreateUserBagId((int) Auth::id());

        DB::table('bag_items')->where('bag_id', $bagId)->delete();

        if ($items === []) {
            return;
        }

        $rows = [];

        foreach ($items as $sizeId => $item) {
            $rows[] = [
                'bag_id' => $bagId,
                'variant_size_id' => (int) $sizeId,
                'quantity' => max(1, min(99, (int) ($item['quantity'] ?? 1))),
            ];
        }

        DB::table('bag_items')->insert($rows);
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
