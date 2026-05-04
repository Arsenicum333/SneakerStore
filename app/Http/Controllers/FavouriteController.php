<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavouriteController extends Controller
{
    public function index(): View
    {
        $storedItems = $this->getStoredItems();
        $variantIds = array_map('intval', $storedItems);

        $variants = ProductVariant::query()
            ->whereIn('id', $variantIds)
            ->with([
                'product',
                'images' => fn($query) => $query
                    ->orderByDesc('is_main')
                    ->orderBy('display_order'),
            ])
            ->get();

        $items = $variants->map(fn($variant) => [
            'variant_size_id'   => $variant->id,
            'product_id'   => $variant->product->id,
            'product_name' => $variant->product->name,
            'gender'       => $variant->product->gender,
            'sport'        => $variant->product->sport,
            'color'        => $variant->color,
            'price'        => (float) $variant->price,
            'image_url'    => $variant->images->first()?->image_url ?? 'assets/sneakers/sneakers1_1.avif',
        ]);

        $recommended = Product::query()
            ->whereNotIn('id', $variants->pluck('product_id')->all())
            ->with([
                'variants.images' => fn($query) => $query
                    ->orderByDesc('is_main')
                    ->orderBy('display_order'),
            ])
            ->inRandomOrder()
            ->limit(3)
            ->get()
            ->map(fn($product) => [
                'product_id'   => $product->id,
                'product_name' => $product->name,
                'gender'       => $product->gender,
                'price'        => (float) $product->variants->first()?->price ?? 0.0,
                'image_url'    => $product->variants->first()?->images->first()?->image_url ?? 'assets/sneakers/sneakers1_1.avif',
            ]);

        return view('favourites', [
            'items'       => $items,
            'recommended' => $recommended,
        ]);
    }

    public function toggle(Request $request): RedirectResponse
    {
        $request->validate([
            'variant_size_id' => ['required', 'integer', 'exists:product_variants,id'],
        ]);

        $variantId = (int) $request->input('variant_size_id');
        $items = $this->getStoredItems();

        if (in_array($variantId, $items)) {
            $items = array_values(array_filter($items, fn($id) => $id !== $variantId));
        } else {
            $items[] = $variantId;
        }

        $this->saveStoredItems($items);

        return redirect()->back()->with('favourite_status', 'Product added to favourites.');
    }

    public function remove(int $variantId): RedirectResponse
    {
        $items = $this->getStoredItems();
        $items = array_values(array_filter($items, fn($id) => $id !== $variantId));
        $this->saveStoredItems($items);

        return redirect()->route('favourites');
    }

    private function getStoredItems(): array
    {
        if (!Auth::check()) {
            return session('favourite.items', []);
        }

        $favouriteId = $this->getOrCreateFavouriteId((int) Auth::id());

        return DB::table('favourite_items')
            ->where('favourite_id', $favouriteId)
            ->pluck('variant_size_id')
            ->map(fn($id) => (int) $id)
            ->all();
    }

    private function saveStoredItems(array $items): void
    {
        if (!Auth::check()) {
            session(['favourite.items' => $items]);
            return;
        }

        $favouriteId = $this->getOrCreateFavouriteId((int) Auth::id());

        DB::table('favourite_items')->where('favourite_id', $favouriteId)->delete();

        if ($items === []) {
            return;
        }

        $rows = array_map(fn($variantId) => [
            'favourite_id' => $favouriteId,
            'variant_size_id'   => $variantId,
        ], $items);

        DB::table('favourite_items')->insert($rows);
    }

    private function getOrCreateFavouriteId(int $userId): int
    {
        $favouriteId = DB::table('favourites')
            ->where('user_id', $userId)
            ->value('id');

        if ($favouriteId) {
            DB::table('favourites')
                ->where('id', $favouriteId)
                ->update([
                    'session_token' => session()->getId(),
                ]);

            return (int) $favouriteId;
        }

        return (int) DB::table('favourites')->insertGetId([
            'user_id'       => $userId,
            'session_token' => session()->getId(),
        ]);
    }
}
