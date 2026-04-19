@extends('layouts.app')

@section('title', 'Bag')

@section('content')
<main class="max-w-[1100px] mx-auto ~mt-5/8 px-4">
    <div class="~mb-5/8">
        <h1 class="text-3xl font-semibold">Bag</h1>
        @if (session('bag_status'))
            <p class="text-sm text-green-700 mt-2">{{ session('bag_status') }}</p>
        @endif
    </div>

    @if (count($items) === 0)
        <div class="p-6">
            <p class="text-gray-600">Your bag is empty.</p>
            <a href="{{ route('catalog') }}" class="inline-block mt-4 bg-black text-white px-5 py-3 rounded-full font-semibold hover:bg-zinc-800 transition-colors">Go to Catalog</a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-[2fr_1fr] gap-6">
            <div class="flex flex-col gap-6">
                @foreach ($items as $item)
                    <div class="flex gap-4">
                        <div class="flex flex-col items-center gap-1">
                            <img src="{{ asset($item['image_url']) }}" alt="{{ $item['product_name'] }}" class="w-40 h-40 bg-gray-200 rounded-lg object-cover">

                            <div class="flex items-center gap-2 mt-2">
                                <form action="{{ route('bag.items.remove', ['sizeId' => $item['size_id']]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 border rounded-full hover:bg-gray-100">
                                        <img src="{{ asset('assets/lucide/trash.svg') }}" class="w-4 h-4" alt="Remove">
                                    </button>
                                </form>

                                <div class="border rounded-full flex items-center px-1">
                                    <form action="{{ route('bag.items.update', ['sizeId' => $item['size_id']]) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="quantity" value="{{ max(1, $item['quantity'] - 1) }}">
                                        <button type="submit" class="p-2 rounded-full hover:bg-gray-100" aria-label="Decrease quantity">
                                            <img src="{{ asset('assets/lucide/minus.svg') }}" class="w-4 h-4" alt="Minus">
                                        </button>
                                    </form>

                                    <input
                                        type="number"
                                        min="1"
                                        max="99"
                                        value="{{ $item['quantity'] }}"
                                        class="no-spinner w-12 text-center font-semibold outline-none bg-transparent"
                                        form="bag-item-{{ $item['size_id'] }}"
                                        name="quantity"
                                        onchange="this.form.submit()"
                                        aria-label="Quantity"
                                    >

                                    <form action="{{ route('bag.items.update', ['sizeId' => $item['size_id']]) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="quantity" value="{{ min(99, $item['quantity'] + 1) }}">
                                        <button type="submit" class="p-2 rounded-full hover:bg-gray-100" aria-label="Increase quantity">
                                            <img src="{{ asset('assets/lucide/plus.svg') }}" class="w-4 h-4" alt="Plus">
                                        </button>
                                    </form>
                                </div>

                                <form action="{{ route('bag.items.update', ['sizeId' => $item['size_id']]) }}" method="POST" id="bag-item-{{ $item['size_id'] }}" class="hidden">
                                    @csrf
                                    @method('PATCH')
                                </form>
                            </div>
                        </div>

                        <div class="flex-1 flex flex-col-reverse sm:flex-row sm:items-start gap-1 sm:gap-4">
                            <div class="flex-1 flex flex-col">
                                <h2 class="font-semibold text-lg">{{ $item['product_name'] }}</h2>
                                <p class="text-gray-500 text-base">{{ $item['gender'] }}'s {{ $item['sport'] }} Shoes</p>
                                <p class="text-gray-500 text-base">{{ $item['color'] }}</p>
                                <a href="{{ route('product.show', ['product' => $item['product_id'], 'variant' => $item['variant_id']]) }}" class="text-gray-500 text-lg font-semibold underline underline-offset-4 decoration-2">Size {{ $item['size'] }}</a>
                            </div>

                            <div class="font-semibold text-lg whitespace-nowrap">
                                {{ number_format($item['line_total'], 2, ',', ' ') }} $
                            </div>
                        </div>
                    </div>

                    <hr class="my-2">
                @endforeach
            </div>

            <div class="border p-6 rounded-lg flex flex-col gap-4 h-fit">
                <h2 class="font-semibold text-2xl mb-4">Summary</h2>
                <div class="flex justify-between text-gray-500 gap-6">
                    <span>Subtotal</span>
                    <span>{{ number_format($subtotal, 2, ',', ' ') }} $</span>
                </div>
                <div class="flex justify-between text-gray-500 gap-6">
                    <span>Estimated Delivery & Handling</span>
-                    <span>Calculated at checkout</span>
                </div>
                <hr class="my-2">
                <div class="flex justify-between font-semibold text-lg gap-6">
                    <span>Total</span>
                    <span>{{ number_format($subtotal, 2, ',', ' ') }} $</span>
                </div>
                <a href="{{ route('payment') }}" class="flex justify-center w-full bg-black text-white py-4 rounded-full font-semibold hover:bg-zinc-800 transition-colors duration-200 mt-4">
                    Buy Now
                </a>
            </div>
        </div>
    @endif
</main>
@endsection
