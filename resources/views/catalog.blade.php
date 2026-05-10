@extends('layouts.app')

@section('title', 'Catalog')

@section('content')
<main>
    <div class="w-full ~px-4/6 mx-auto">
        <div class="flex items-center justify-between w-full ~mb-3/5 flex-wrap ~gap-2/3">
            <h1 class="~text-xl/3xl font-bold">
                @php
                    $gender = request('gender');
                    $sportNot = request('sport_not');
                    $title = 'All';

                    if ($gender == 'Men') {
                        $title = "Men's Shoes";
                    } elseif ($gender == 'Women') {
                        $title = "Women's Shoes";
                    } elseif ($sportNot == 'Lifestyle') {
                        $title = "Sport Shoes";
                    }

                    $colors = ['Red', 'Blue', 'Green', 'Black', 'White', 'Gray', 'Pink', 'Brown', 'Orange'];
                    $selectedColors = (array) request('color');
                @endphp
                {{ $title }}
            </h1>
            <div class="flex items-center justify-end ~gap-3/10 flex-shrink-0">
                <div class="flex items-center justify-end gap-1 ~mt-3/5 cursor-pointer" onclick="toggleFilters()">
                    <span id="filters-btn-text" class="text-black ~text-sm/base">Hide Filters</span>
                    <div class="flex items-center justify-center">
                        <img id="filters-btn-icon" src="{{ asset('assets/lucide/settings.svg') }}" class="~w-4/5 ~h-4/5 block">
                    </div>
                </div>

                <div class="relative">
                    <button onclick="toggleSortDropdown()"
                            class="flex items-center justify-end gap-1 ~mt-3/5">
                        <span class="text-black ~text-sm/base">
                            Sort By
                            @if(request('sort') == 'price_asc') (Price: Low to High)
                            @elseif(request('sort') == 'price_desc') (Price: High to Low)
                            @endif
                        </span>
                        <div class="flex items-center justify-center">
                            <img src="{{ asset('assets/lucide/arrow.svg') }}" class="~w-4/5 ~h-4/5 block">
                        </div>
                    </button>

                    <div id="sort-dropdown" class="absolute right-0 hidden bg-white shadow-lg rounded-md mt-2 py-2 z-10 min-w-[10rem] border border-gray-200">
                        <a href="{{ route('catalog', array_merge(request()->except('sort'), ['sort' => 'default'])) }}"
                        class="block px-4 py-2 hover:bg-gray-100 {{ request('sort') == 'default' || !request('sort') ? 'bg-gray-100 font-semibold' : '' }}">
                            Default
                        </a>
                        <a href="{{ route('catalog', array_merge(request()->except('sort'), ['sort' => 'price_asc'])) }}"
                        class="block px-4 py-2 hover:bg-gray-100 {{ request('sort') == 'price_asc' ? 'bg-gray-100 font-semibold' : '' }}">
                            Price: Low to High
                        </a>
                        <a href="{{ route('catalog', array_merge(request()->except('sort'), ['sort' => 'price_desc'])) }}"
                        class="block px-4 py-2 hover:bg-gray-100 {{ request('sort') == 'price_desc' ? 'bg-gray-100 font-semibold' : '' }}">
                            Price: High to Low
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex ~gap-4/8 ">
            <aside id="filters-sidebar" class="hidden w-44 flex-shrink-0 ~text-xs/sm sticky top-0 self-start max-h-screen overflow-y-auto">
                <form method="GET" action="{{ route('catalog') }}" id="filter-form">

                    <div class="border-b-2 border-gray-200 pb-5">
                        <div class="flex items-center justify-between w-full gap-1 ~mt-3/5">
                            <span class="justify-start text-black ~text-sm/base font-semibold">Gender</span>
                        </div>
                        <div class="mt-2 space-y-1">
                            <label class="flex items-center gap-2">
                                <input type="radio" name="gender" value="Men" {{ request('gender') == 'Men' ? 'checked' : '' }} onchange="this.form.submit()"> Men
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="radio" name="gender" value="Women" {{ request('gender') == 'Women' ? 'checked' : '' }} onchange="this.form.submit()"> Women
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="radio" name="gender" value="Unisex" {{ request('gender') == 'Unisex' ? 'checked' : '' }} onchange="this.form.submit()"> Unisex
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="radio" name="gender" value="" {{ !request('gender') ? 'checked' : '' }} onchange="this.form.submit()"> All
                            </label>
                        </div>
                    </div>

                    <div class="border-b-2 border-gray-200 pb-5">
                        <div class="flex items-center justify-between w-full gap-1 ~mt-3/5">
                            <span class="justify-start text-black ~text-sm/base font-semibold">Price</span>
                        </div>
                        <div class="mt-2 flex gap-2 items-center">
                            <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="Min" class="w-full border rounded p-1 ~text-xs" onchange="this.form.submit()">
                            <span>-</span>
                            <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="Max" class="w-full border rounded p-1 ~text-xs" onchange="this.form.submit()">
                        </div>
                    </div>

                    <div class="border-b-2 border-gray-200 pb-5">
                        <div class="flex items-center justify-between w-full gap-1 ~mt-3/5">
                            <span class="justify-start text-black ~text-sm/base font-semibold">Size</span>
                        </div>
                        <div class="mt-2 ml-1 flex flex-wrap gap-3">
                            @php
                                $sizes = ['37', '37.5', '38', '38.5', '39', '39.5', '40', '40.5', '41', '41.5', '42', '42.5', '43', '43.5', '44', '44.5', '45'];
                                $selectedSizes = (array) request('size');
                            @endphp

                            @foreach($sizes as $size)
                                <label class="size-label">
                                    <input type="checkbox" name="size[]" value="{{ $size }}"
                                        class="size-checkbox hidden"
                                        {{ in_array($size, $selectedSizes) ? 'checked' : '' }}
                                        onchange="this.form.submit()">
                                    <div class="size-button {{ in_array($size, $selectedSizes) ? 'bg-black text-white border-black' : 'bg-white text-black border-gray-300' }} 
                                                w-10 h-10 rounded-full flex items-center justify-center text-sm font-medium border hover:border-black cursor-pointer transition-all">
                                        {{ $size }}
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="border-b-2 border-gray-200 pb-5">
                        <div class="flex items-center justify-between w-full gap-1 ~mt-3/5">
                            <span class="justify-start text-black ~text-sm/base font-semibold">Colour</span>
                        </div>
                        <div class="mt-2 space-y-1">
                            @foreach($colors as $color)
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="color[]" value="{{ $color }}"
                                        {{ in_array($color, $selectedColors) ? 'checked' : '' }}
                                        onchange="this.form.submit()">
                                    <span class="w-3 h-3 rounded-full inline-block"
                                        style="background-color: {{ strtolower($color) }};"></span>
                                    {{ $color }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="border-b-2 border-gray-200 pb-5">
                        <div class="flex items-center justify-between w-full gap-1 ~mt-3/5">
                            <span class="justify-start text-black ~text-sm/base font-semibold">Sports</span>
                        </div>
                        <div class="mt-2 space-y-1">
                            @foreach($sports as $sport)
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="sport[]" value="{{ $sport }}"
                                        {{ in_array($sport, (array)request('sport')) ? 'checked' : '' }}
                                        onchange="this.form.submit()">
                                    {{ $sport }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('catalog') }}" class="text-sm text-red-500 hover:underline">
                            Clear all filters
                        </a>
                    </div>
                </form>
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

    <script>
        const filtersSidebar = document.getElementById('filters-sidebar');
        const filtersBtnText = document.getElementById('filters-btn-text');

        function initFilters() {
            if (window.innerWidth >= 768) {
                filtersSidebar.classList.remove('hidden');
                filtersBtnText.textContent = 'Hide Filters';
            } else {
                filtersSidebar.classList.add('hidden');
                filtersBtnText.textContent = 'Show Filters';
            }
        }

        function toggleFilters() {
            filtersSidebar.classList.toggle('hidden');
            filtersBtnText.textContent = filtersSidebar.classList.contains('hidden') ? 'Show Filters' : 'Hide Filters';
        }

        document.addEventListener('DOMContentLoaded', initFilters);
        window.addEventListener('resize', initFilters);

        function toggleSortDropdown() {
            const dropdown = document.getElementById('sort-dropdown');
            if (dropdown) {
                dropdown.classList.toggle('hidden');
            }
        }

        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('sort-dropdown');
            const button = event.target.closest('button');
            if (button && button.textContent.includes('Sort By')) {
                return;
            }
            if (dropdown) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
</main>
@endsection
