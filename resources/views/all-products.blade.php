@extends('layouts.app')

@section('title', 'Catalog')

@section('content')
<main>
    <div class="w-full ~p-4/6 mx-auto ~mt-3/5">
        <div class="flex items-center justify-center w-full ~mb-3/5">
            <h1 class="flex items-center ~text-xl/3xl font-bold justify-start w-1/2">
                All
            </h1>
            <div class="flex items-center justify-end w-1/2 ~gap-5/10">
                <div class="flex items-center justify-end gap-1 ~mt-3/5">
                    <span class="text-black ~text-sm/base">Hide Filters</span>
                    <div class="flex items-center justify-center">
                        <img src="{{ asset('assets/lucide/settings.svg') }}" class="~w-4/5 ~h-4/5 block">
                    </div>
                </div>

                <div class="flex items-center justify-end gap-1 ~mt-3/5">
                    <span class="text-black ~text-sm/base">Sort By</span>
                    <div class="flex items-center justify-center">
                        <img src="{{ asset('assets/lucide/arrow.svg') }}" class="~w-4/5 ~h-4/5 block">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex ~gap-4/8 ">
            <aside class="hidden md:block w-44 flex-shrink-0 ~text-xs/sm sticky top-0 self-start">
                <div class="border-b-2 border-gray-200 pb-5">
                    <div class="flex items-center justify-between w-full gap-1 ~mt-3/5">
                        <span class="justify-start text-black ~text-sm/base font-semibold">Gender</span>
                        <div class="flex items-center justify-end">
                            <img src="{{ asset('assets/lucide/arrow.svg') }}" class="~w-4/5 ~h-4/5 block">
                        </div>
                    </div>
                </div>

                <div class="border-b-2 border-gray-200 pb-5">
                    <div class="flex items-center justify-between w-full gap-1 ~mt-3/5">
                        <span class="justify-start text-black ~text-sm/base font-semibold">Shop by Price</span>
                        <div class="flex items-center justify-end">
                            <img src="{{ asset('assets/lucide/arrow.svg') }}" class="~w-4/5 ~h-4/5 block">
                        </div>
                    </div>
                </div>

                <div class="border-b-2 border-gray-200 pb-5">
                    <div class="flex items-center justify-between w-full gap-1 ~mt-3/5">
                        <span class="justify-start text-black ~text-sm/base font-semibold">Size</span>
                        <div class="flex items-center justify-end">
                            <img src="{{ asset('assets/lucide/arrow.svg') }}" class="~w-4/5 ~h-4/5 block">
                        </div>
                    </div>
                </div>

                <div class="border-b-2 border-gray-200 pb-5">
                    <div class="flex items-center justify-between w-full gap-1 ~mt-3/5">
                        <span class="justify-start text-black ~text-sm/base font-semibold">Colour</span>
                        <div class="flex items-center justify-end">
                            <img src="{{ asset('assets/lucide/arrow.svg') }}" class="~w-4/5 ~h-4/5 block">
                        </div>
                    </div>
                </div>

                <div class="border-b-2 border-gray-200 pb-5">
                    <div class="flex items-center justify-between w-full gap-1 ~mt-3/5">
                        <span class="justify-start text-black ~text-sm/base font-semibold">Sports</span>
                        <div class="flex items-center justify-end">
                            <img src="{{ asset('assets/lucide/arrow.svg') }}" class="~w-4/5 ~h-4/5 block">
                        </div>
                    </div>
                </div>
            </aside>

            <div class="flex-1 min-w-0">
                <div class="grid grid-cols-2 lg:grid-cols-3 ~gap-3/5">
                    @foreach ($products as $product)
                        @php
                            $primaryVariant = $product->variants->first();
                            $mainImage = $primaryVariant?->images->first();
                        @endphp

                        <a href="{{ route('product.show', ['product' => $product->id]) }}" class="block">
                            <div class="overflow-hidden bg-gray-100 aspect-square">
                                <img
                                    src="{{ asset($mainImage?->image_url ?? 'assets/sneakers/sneakers1.avif') }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-cover"
                                >
                            </div>
                            <div class="mt-2 ~text-xs/sm">
                                <p class="text-gray-400 text-xs">{{ $product->gender }}'s {{ $product->sport }} Shoes</p>
                                <p class="font-semibold text-gray-900 leading-tight">{{ $product->name }}</p>
                                <p class="text-gray-500">{{ number_format((float) ($primaryVariant?->price ?? 0), 2, ',', ' ') }} $</p>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $products->links('vendor.pagination.circles') }}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
