@extends('layouts.app')

@section('title', 'Catalog')

@section('content')
<main>
    <div class="w-full ~p-4/6 mx-auto ~mt-3/5">
        <div class="flex items-center justify-center w-full ~mb-3/5">
            <h1 class="flex items-center ~text-xl/3xl font-bold justify-start w-1/2">
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
                @endphp
                {{ $title }}
            </h1>
            <div class="flex items-center justify-end w-1/2 ~gap-5/10">
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

                    <div id="sort-dropdown" class="absolute right-0 hidden bg-white shadow-lg rounded-md mt-2 py-2 z-10 min-w-48 border border-gray-200">
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
            <aside id="filters-sidebar" class="hidden md:block w-44 flex-shrink-0 ~text-xs/sm sticky top-0 self-start">
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
        function toggleFilters() {
            const sidebar = document.getElementById('filters-sidebar');
            const buttonText = document.getElementById('filters-btn-text');
            const buttonIcon = document.getElementById('filters-btn-icon');

            if (sidebar.style.display === 'none') {
                sidebar.style.display = 'block';
                buttonText.textContent = 'Hide Filters';
                buttonIcon.src = "{{ asset('assets/lucide/settings.svg') }}";
            } else {
                sidebar.style.display = 'none';
                buttonText.textContent = 'Show Filters';
                buttonIcon.src = "{{ asset('assets/lucide/settings.svg') }}";
            }
        }

        function toggleSortDropdown() {
            const dropdown = document.getElementById('sort-dropdown');
            if (dropdown) {
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            }
        }

        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('sort-dropdown');
            const button = event.target.closest('button');
            if (button && button.textContent.includes('Sort By')) {
                return;
            }
            if (dropdown) {
                dropdown.style.display = 'none';
            }
        });
    </script>
</main>
@endsection
