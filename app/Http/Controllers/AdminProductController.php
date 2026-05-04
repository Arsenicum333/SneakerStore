<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantSize;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('variants.sizes', 'variants.images')->get();
        return view('admin-product', compact('products'));
    }

    public function create()
    {
        return view('admin-add-product');
    }

    public function store(Request $request)
    {
        $photos = $request->file('photos') ?? [];
        $validPhotos = array_filter($photos, fn($p) => $p && $p->isValid());

        if (count($validPhotos) < 2) {
            return back()->withErrors(['photos' => 'Please upload at least 2 photos'])->withInput();
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:100',
            'gender' => 'required|string|max:50',
            'sport' => 'nullable|string|max:100',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|min:10',
            'sizes' => 'array',
            'sizes.*' => 'string',
            'stock' => 'array',
        ]);

        $product = Product::create([
            'name' => $validated['name'],
            'gender' => $validated['gender'],
            'sport' => $validated['sport'],
            'description' => $validated['description'],
        ]);

        $variant = ProductVariant::create([
            'product_id' => $product->id,
            'color' => $validated['color'],
            'price' => $validated['price'],
        ]);

        foreach ($validated['sizes'] ?? [] as $size) {
            ProductVariantSize::create([
                'variant_id' => $variant->id,
                'size' => $size,
                'stock_quantity' => $validated['stock'][$size] ?? 0,
            ]);
        }

        foreach ($validPhotos as $index => $photo) {
            $filename = time() . '_' . $index . '_' . Str::random(10) . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('products', $filename, 'public');

            ProductImage::create([
                'variant_id' => $variant->id,
                'image_url' => Storage::url($path),
                'is_main' => $index === 0,
                'display_order' => $index,
            ]);
        }

        return redirect()->route('admin.products')->with('success', 'Product created!');
    }

    public function edit(Product $product)
    {
        return view('admin-edit-product', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:100',
            'gender' => 'required|string|max:50',
            'sport' => 'nullable|string|max:100',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|min:10',
            'sizes' => 'array',
            'sizes.*' => 'string',
            'stock' => 'array',
            'stock.*' => 'integer|min:0',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $product->update([
            'name' => $validated['name'],
            'gender' => $validated['gender'],
            'sport' => $validated['sport'],
            'description' => $validated['description'],
        ]);

        $variant = $product->variants()->first();

        if (!$variant) {
            $variant = ProductVariant::create([
                'product_id' => $product->id,
                'color' => $validated['color'],
                'price' => $validated['price'],
            ]);
        } else {
            $variant->update([
                'color' => $validated['color'],
                'price' => $validated['price'],
            ]);
        }

        // sizes
        $existingSizes = $variant->sizes->keyBy('size');

        foreach ($validated['sizes'] ?? [] as $size) {
            if ($existingSizes->has($size)) {
                $existingSizes[$size]->update([
                    'stock_quantity' => $validated['stock'][$size] ?? 0,
                ]);
            } else {
                ProductVariantSize::create([
                    'variant_id' => $variant->id,
                    'size' => $size,
                    'stock_quantity' => $validated['stock'][$size] ?? 0,
                ]);
            }
        }

        foreach ($existingSizes as $size => $model) {
            if (!in_array($size, $validated['sizes'] ?? [])) {
                $model->delete();
            }
        }

        // photos
        $photos = $request->file('photos') ?? [];
        $validPhotos = array_filter($photos, fn($p) => $p && $p->isValid());

        foreach ($validPhotos as $index => $photo) {
            $filename = time() . '_' . $index . '_' . Str::random(10) . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('products', $filename, 'public');

            ProductImage::create([
                'variant_id' => $variant->id,
                'image_url' => Storage::url($path),
                'is_main' => $variant->images()->count() === 0 && $index === 0,
                'display_order' => $variant->images()->count() + $index,
            ]);
        }

        return redirect()->route('admin.products')->with('success', 'Product updated!');
    }

    public function destroy(Product $product)
    {
        foreach ($product->variants as $variant) {
            foreach ($variant->images as $image) {
                $path = str_replace('/storage/', '', $image->image_url);
                Storage::disk('public')->delete($path);
                $image->delete();
            }
            $variant->sizes()->delete();
            $variant->delete();
        }
        
        $product->delete();
        
        return redirect()->route('admin.products')->with('success', 'Product deleted!');
    }
}