@extends('layouts.app')

@section('title', 'Favourites')

@section('content')
<main class="max-w-[1100px] mx-auto px-4 ~mt-4/8">

    <div class="~mb-5/8">
        <h1 class="text-3xl font-semibold">Favourites</h1>
    </div>

    <section>
        @if ($items->isEmpty())
            <p class="text-gray-400 text-sm">No favourites yet.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($items as $item)
                    <div class="relative flex flex-col bg-gray-100 rounded-lg">
                        <a href="{{ route('product.show', $item['product_id']) }}">
                            <img src="{{ asset($item['image_url']) }}" class="w-full aspect-square object-cover rounded-t-lg">
                        </a>

                        <form action="{{ route('favourites.remove', $item['variant_id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="absolute top-4 right-4 ~w-6/8 ~h-6/8 bg-white rounded-full flex items-center justify-center shadow hover:bg-gray-100 transition">
                                <img src="{{ asset('assets/lucide/heart-filled.svg') }}" class="w-4 h-4">
                            </button>
                        </form>

                        <div class="p-4">
                            <h3 class="font-semibold text-sm">{{ $item['product_name'] }}</h3>
                            <p class="text-gray-500 text-xs">{{ $item['gender'] }}'s {{ $item['sport'] }} Shoes</p>
                            <span class="font-semibold mt-1 block">{{ number_format($item['price'], 2, ',', ' ') }} $</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    <section class="mt-24">
        <div class="flex items-center w-full">
            <h2 class="font-semibold text-3xl mb-4 w-1/2">Find Your Next Favourite</h2>
        </div>

        @if ($recommended->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($recommended as $item)
                    <a href="{{ route('product.show', $item['product_id']) }}" class="flex flex-col bg-gray-100 rounded-lg">
                        <img src="{{ asset($item['image_url']) }}" class="w-full aspect-square object-cover rounded-t-lg">
                        <div class="p-4">
                            <h3 class="font-semibold text-sm">{{ $item['product_name'] }}</h3>
                            <p class="text-gray-500 text-xs">{{ $item['gender'] }}'s Shoes</p>
                            <span class="font-semibold mt-1 block">{{ number_format($item['price'], 2, ',', ' ') }} $</span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </section>

</main>
@endsection