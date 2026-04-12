<?php

namespace App\Http\Controllers;

use App\Models\ProductVariantSize;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BagController extends Controller
{
    public function index(): View
    {
        $sessionItems = session('bag.items', []);
        $sizeIds = array_map('intval', array_keys($sessionItems));

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

        foreach ($sessionItems as $sizeId => $sessionItem) {
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

        $items = session('bag.items', []);
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

        session(['bag.items' => $items]);

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

        $items = session('bag.items', []);
        $sizeKey = (string) $sizeId;

        if (!array_key_exists($sizeKey, $items)) {
            return redirect()->route('bag');
        }

        $size = ProductVariantSize::query()->find($sizeId);

        if (!$size) {
            unset($items[$sizeKey]);
            session(['bag.items' => $items]);

            return redirect()->route('bag');
        }

        $newQuantity = (int) $validated['quantity'];

        $stockQuantity = max(0, (int) $size->stock_quantity);

        if ($stockQuantity === 0) {
            unset($items[$sizeKey]);
            session(['bag.items' => $items]);

            return redirect()->route('bag')->with('bag_status', 'This size is out of stock and was removed from your bag.');
        }

        if ($newQuantity > $stockQuantity) {
            $newQuantity = $stockQuantity;
            $items[$sizeKey]['quantity'] = max(1, $newQuantity);
            session(['bag.items' => $items]);

            return redirect()->route('bag')->with('bag_status', 'Quantity updated to the maximum available for this size.');
        }

        $items[$sizeKey]['quantity'] = max(1, $newQuantity);
        session(['bag.items' => $items]);

        return redirect()->route('bag');
    }

    public function remove(int $sizeId): RedirectResponse
    {
        $items = session('bag.items', []);
        unset($items[(string) $sizeId]);
        session(['bag.items' => $items]);

        return redirect()->route('bag');
    }
}
