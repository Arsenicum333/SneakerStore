@extends('layouts.app')

@section('title', 'Product')

@section('content')
<main class="max-w-[1000px] mx-auto ~mt-5/8">
    <div class="grid grid-cols-1 md:grid-cols-[60%_40%]">
        <div class="flex gap-4 ~p-4/6 md:sticky md:top-0 md:h-screen md:items-start">
            <div class="flex flex-col gap-2 w-14 md:w-16 shrink-0 md:max-h-[calc(100vh-2rem)] md:overflow-y-auto md:pr-1">
                @foreach ($selectedVariant->images as $image)
                    <button class="aspect-square border border-transparent rounded-md overflow-hidden hover:border-black focus:border-black">
                        <img src="{{ asset($image->image_url) }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-md">
                    </button>
                @endforeach
            </div>

            <div class="relative flex-1 max-h-[600px] bg-gray-200 rounded-lg flex items-center justify-center overflow-hidden">
                <img src="{{ asset($selectedVariant->images->first()?->image_url ?? 'assets/sneakers/sneakers1.avif') }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            </div>
        </div>

        <div class="flex flex-col ~gap-3/5 ~p-4/6">
            <div class="mb-4">
                <h1 class="~text-lg/xl font-semibold">{{ $product->name }}</h1>
                <p class="text-gray-500 ~text-sm/base">{{ $product->gender }}'s {{ $product->sport }} Shoes</p>
                <p class="font-semibold ~text-base/lg mt-2">{{ number_format((float) $selectedVariant->price, 2, ',', ' ') }} $</p>
            </div>

            <div class="flex items-center gap-1.5">
                @foreach ($product->variants as $variant)
                    @php
                        $variantImage = $variant->images->first()?->image_url ?? 'assets/sneakers/sneakers1.avif';
                        $isSelected = $variant->id === $selectedVariant->id;
                    @endphp

                    <a
                        href="{{ route('product.show', ['product' => $product->id, 'variant' => $variant->id]) }}"
                        class="~w-12/16 ~h-12/16 border rounded-md overflow-hidden {{ $isSelected ? 'border-black' : 'border-transparent hover:border-black' }}"
                        title="{{ $variant->color }}"
                    >
                        <img src="{{ asset($variantImage) }}" alt="{{ $variant->color }}" class="w-full h-full object-cover">
                    </a>
                @endforeach
            </div>

            <div class="my-6">
                <p class="font-semibold ~text-sm/base mb-2">Select Size</p>

                <div class="grid grid-cols-3 gap-2">
                    @foreach ($selectedVariant->sizes as $size)
                        <button class="border rounded-md py-2 hover:border-black focus:border-black">
                            EU {{ $size->size }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="mb-2">
                <p class="font-semibold ~text-sm/base mb-2">Quantity</p>
                <div class="border rounded-full inline-flex items-center" data-quantity-control>
                    <button type="button" class="p-2 rounded-full hover:bg-gray-100" data-quantity-action="decrease" aria-label="Decrease quantity">
                        <img src="{{ asset('assets/lucide/minus.svg') }}" class="w-4 h-4" alt="Minus">
                    </button>

                    <input
                        type="number"
                        min="1"
                        step="1"
                        value="1"
                        inputmode="numeric"
                        class="no-spinner w-14 text-center font-semibold outline-none bg-transparent"
                        data-quantity-input
                        aria-label="Quantity"
                    >

                    <button type="button" class="p-2 rounded-full hover:bg-gray-100" data-quantity-action="increase" aria-label="Increase quantity">
                        <img src="{{ asset('assets/lucide/plus.svg') }}" class="w-4 h-4" alt="Plus">
                    </button>
                </div>
            </div>

            <button class="w-full bg-black text-white py-4 rounded-full font-semibold hover:bg-zinc-800 transition-colors duration-200">
                Add to Bag
            </button>

            <button class="w-full border py-4 rounded-full font-semibold transition flex items-center justify-center gap-2 hover:border-black">
                Favourite
                <img src="{{ asset('assets/lucide/heart.svg') }}" class="~w-4/5 ~h-4/5" alt="Favourite">
            </button>

            <div class="text-gray-600 text-sm mt-6 flex flex-col gap-4 leading-relaxed">
                @foreach ($descriptionParagraphs as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach

                @if ($descriptionHighlights)
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($descriptionHighlights as $highlight)
                            <li>{{ $highlight }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const wrapper = document.querySelector('[data-quantity-control]');
        if (!wrapper) {
            return;
        }

        const input = wrapper.querySelector('[data-quantity-input]');
        const min = 1;
        const max = 99;

        const normalize = (value) => {
            const numericValue = Number.parseInt(value, 10);

            if (Number.isNaN(numericValue)) {
                return min;
            }

            return Math.min(max, Math.max(min, numericValue));
        };

        wrapper.addEventListener('click', (event) => {
            const button = event.target.closest('button[data-quantity-action]');
            if (!button) {
                return;
            }

            const currentValue = normalize(input.value);
            const nextValue = button.dataset.quantityAction === 'increase'
                ? currentValue + 1
                : currentValue - 1;

            input.value = normalize(nextValue);
        });

        input.addEventListener('input', () => {
            input.value = input.value.replace(/[^0-9]/g, '');
        });

        input.addEventListener('blur', () => {
            input.value = normalize(input.value);
        });
    });
</script>
@endsection
