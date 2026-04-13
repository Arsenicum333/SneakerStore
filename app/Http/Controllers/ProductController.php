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
    public function index(): View
    {
        $realProducts = Product::query()
            ->with([
                'variants' => fn ($query) => $query
                    ->with(['images', 'sizes'])
                    ->orderBy('id'),
            ])
            ->orderBy('id')
            ->get();

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
            ]);
        }


        $totalNeeded = 36;
        $virtualProducts = collect();
        
        while ($virtualProducts->count() < $totalNeeded) {
            $virtualProducts = $virtualProducts->concat($realProducts);
        }
 
        $virtualProducts = $virtualProducts->take($totalNeeded);

        $page = request()->get('page', 1);
        $perPage = 12;

        $currentPageItems = $virtualProducts->slice(($page - 1) * $perPage, $perPage)->values();

        $products = new LengthAwarePaginator(
            $currentPageItems,
            $virtualProducts->count(),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        return view('all-products', [
            'products' => $products,
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
