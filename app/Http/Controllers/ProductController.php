<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::query()
            ->with([
                'variants' => fn ($q) => $q
                    ->with(['images', 'sizes'])
                    ->orderBy('id'),
            ]);

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->has('sport') && is_array($request->sport)) {
            $query->whereIn('sport', $request->sport);
        } elseif ($request->filled('sport')) {
            $query->where('sport', $request->sport);
        }

        if ($request->filled('price_min')) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->where('price', '>=', (float) $request->price_min);
            });
        }

        if ($request->filled('price_max')) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->where('price', '<=', (float) $request->price_max);
            });
        }

        if ($request->has('color') && is_array($request->color)) {
            $colors = $request->color;
            $query->whereHas('variants', function ($q) use ($colors) {
                foreach ($colors as $color) {
                    $q->where('color', 'LIKE', "%{$color}%");
                }
            });
        }

        if ($request->has('size') && is_array($request->size)) {
            $sizes = $request->size;
            $query->whereHas('variants.sizes', function ($q) use ($sizes) {
                $q->whereIn('size', $sizes);
            });
        }

        if ($request->filled('sport_not')) {
            $query->where('sport', '!=', $request->sport_not);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'LIKE', "%{$search}%");
        }

        $realProducts = $query->get();

        $genders = Product::distinct()->pluck('gender')->filter();
        $sports = Product::distinct()->pluck('sport')->filter();
        $colors = ProductVariant::distinct()->pluck('color')->filter()->sort();
        $minPrice = ProductVariant::min('price') ?? 0;
        $maxPrice = ProductVariant::max('price') ?? 1000;

        if ($realProducts->isEmpty()) {
            $products = new LengthAwarePaginator(
                collect([]),
                0,
                12,
                1,
                ['path' => request()->url(), 'query' => request()->query()]
            );

            return view('all-products', [
                'products' => $products,
                'genders' => $genders,
                'sports' => $sports,
                'colors' => $colors,
                'minPrice' => $minPrice,
                'maxPrice' => $maxPrice,
            ]);
        }

        $sort = $request->get('sort', 'default');

        switch ($sort) {
            case 'price_asc':
                $realProducts = $realProducts->sortBy(function ($product) {
                    return $product->variants->min('price');
                })->values();
                break;

            case 'price_desc':
                $realProducts = $realProducts->sortByDesc(function ($product) {
                    return $product->variants->min('price');
                })->values();
                break;

            default:
                $realProducts = $realProducts->sortBy('id')->values();
                break;
        }

        $page = request()->get('page', 1);
        $perPage = 12;
        $currentPageItems = $realProducts->slice(($page - 1) * $perPage, $perPage)->values();

        $products = new LengthAwarePaginator(
            $currentPageItems,
            $realProducts->count(),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        return view('all-products', [
            'products' => $products,
            'genders' => $genders,
            'sports' => $sports,
            'colors' => $colors,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
        ]);
    }

    public function showFirst(): RedirectResponse
    {
        $firstProduct = Product::query()->orderBy('id')->firstOrFail();

        return redirect()->route('product.show', ['product' => $firstProduct->id]);
    }

    public function show(Request $request, Product $product): View
    {
        $product->load([
            'variants' => fn ($query) => $query
                ->with([
                    'images' => fn ($imageQuery) => $imageQuery
                        ->orderByDesc('is_main')
                        ->orderBy('display_order'),
                    'sizes' => fn ($sizeQuery) => $sizeQuery->orderBy('size'),
                ])
                ->orderBy('id'),
        ]);

        $selectedVariant = $this->resolveSelectedVariant($request, $product);

        $descriptionSections = $this->splitDescription($product->description);

        return view('product', [
            'product' => $product,
            'selectedVariant' => $selectedVariant,
            'descriptionParagraphs' => $descriptionSections['paragraphs'],
            'descriptionHighlights' => $descriptionSections['highlights'],
        ]);
    }

    private function resolveSelectedVariant(Request $request, Product $product): ProductVariant
    {
        $variantId = (int) $request->integer('variant');

        $variant = $product->variants->firstWhere('id', $variantId);

        return $variant ?? $product->variants->firstOrFail();
    }

    private function splitDescription(string $description): array
    {
        $sections = preg_split('/\R{2,}/', trim($description)) ?: [];

        $paragraphs = [];
        $highlights = [];

        foreach ($sections as $section) {
            $lines = array_values(array_filter(array_map('trim', preg_split('/\R/', $section) ?: [])));

            if ($lines !== [] && collect($lines)->every(fn (string $line) => str_starts_with($line, '- '))) {
                $highlights = array_map(fn (string $line) => trim(substr($line, 2)), $lines);
                continue;
            }

            $paragraphs[] = $section;
        }

        return [
            'paragraphs' => $paragraphs,
            'highlights' => $highlights,
        ];
    }
}