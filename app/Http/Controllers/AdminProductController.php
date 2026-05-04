<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantSize;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index(): View
    {
        $products = Product::query()
            ->with([
                'variants.images' => fn($q) => $q->orderByDesc('is_main')->orderBy('display_order'),
                'variants.sizes',
            ])
            ->latest()
            ->get();

        return view('admin-product', ['products' => $products]);
    }

    public function create(): View
    {
        return view('admin-add-product');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'          => ['required', 'string', 'max:50'],
            'gender'        => ['required', 'string', 'max:20'],
            'sport'         => ['required', 'string', 'max:20'],
            'description'   => ['required', 'string', 'min:250'],
            'color'         => ['required', 'string', 'max:20'],
            'price'         => ['required', 'numeric', 'min:0'],
            'sizes'         => ['required', 'array', 'min:1'],
            'sizes.*'       => ['required', 'string', 'max:8'],
            'stock.*'       => ['required', 'integer', 'min:0'],
            'photos'        => ['required', 'array', 'min:2'],
            'photos.*'      => ['required', 'image'],
        ]);

        $product = Product::create([
            'name'        => $validated['name'],
            'gender'      => $validated['gender'],
            'sport'       => $validated['sport'],
            'description' => $validated['description'],
        ]);

        $variant = $product->variants()->create([
            'color' => $validated['color'],
            'price' => $validated['price'],
        ]);

        foreach ($validated['sizes'] as $index => $size) {
            $variant->sizes()->create([
                'size'           => $size,
                'stock_quantity' => (int) ($request->input('stock')[$index] ?? 0),
            ]);
        }

        foreach ($request->file('photos') as $i => $photo) {
            $path = $photo->store('sneakers', 'public');
            DB::table('product_images')->insert([
                'variant_id'    => $variant->id,
                'image_url'     => 'storage/' . $path,
                'is_main'       => $i === 0,
                'display_order' => $i,
            ]);
        }

        return redirect()->route('admin-product')->with('status', 'Product created.');
    }

    public function edit(Product $product): View
    {
        $product->load([
            'variants.images' => fn($q) => $q->orderByDesc('is_main')->orderBy('display_order'),
            'variants.sizes',
        ]);

        return view('admin-edit-product', ['product' => $product]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:50'],
            'gender'      => ['required', 'string', 'max:20'],
            'sport'       => ['required', 'string', 'max:20'],
            'description' => ['required', 'string', 'min:250'],
            'color'       => ['required', 'string', 'max:20'],
            'price'       => ['required', 'numeric', 'min:0'],
            'sizes'       => ['required', 'array', 'min:1'],
            'sizes.*'     => ['required', 'string', 'max:8'],
            'stock.*'     => ['required', 'integer', 'min:0'],
            'photos.*'    => ['nullable', 'image'],
        ]);

        $product->update([
            'name'        => $validated['name'],
            'gender'      => $validated['gender'],
            'sport'       => $validated['sport'],
            'description' => $validated['description'],
        ]);

        $variant = $product->variants->first();
        $variant->update([
            'color' => $validated['color'],
            'price' => $validated['price'],
        ]);

        $variant->sizes()->delete();
        foreach ($validated['sizes'] as $index => $size) {
            $variant->sizes()->create([
                'size'           => $size,
                'stock_quantity' => (int) ($request->input('stock')[$index] ?? 0),
            ]);
        }

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $i => $photo) {
                $path = $photo->store('sneakers', 'public');
                DB::table('product_images')->insert([
                    'variant_id'    => $variant->id,
                    'image_url'     => 'storage/' . $path,
                    'is_main'       => false,
                    'display_order' => DB::table('product_images')->where('variant_id', $variant->id)->max('display_order') + 1,
                ]);
            }
        }

        return redirect()->route('admin-product')->with('status', 'Product updated.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin-product')->with('status', 'Product deleted.');
    }
}