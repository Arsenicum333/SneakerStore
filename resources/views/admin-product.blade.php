@extends('layouts.app')

@section('title', 'Admin — Products')

@section('content')
<main class="max-w-[1000px] mx-auto ~px-4/6 ~mt-5/8">

    <div class="flex items-center justify-between ~mb-6/10">
        <h1 class="~text-xl/3xl font-semibold">Products</h1>
        <a href="{{ route('admin.products.create') }}" class="bg-black text-white px-6 py-2.5 rounded-full text-sm font-medium hover:bg-zinc-800 transition-colors duration-200">
            Add Product
        </a>
    </div>

    @if (session('status'))
        <p class="mb-4 text-sm text-green-600">{{ session('status') }}</p>
    @endif

    @if ($products->isEmpty())
        <p class="text-gray-400 text-sm">No products yet.</p>
    @else
        <div class="flex flex-col divide-y divide-gray-100">
            @foreach ($products as $product)
                @php
                    $firstVariant = $product->variants->first();
                    $imageUrl = $firstVariant?->images->first()?->image_url ?? 'assets/sneakers/sneakers1_1.avif';
                @endphp

                <div class="flex items-center flex-wrap ~gap-3/5 ~py-3/5">

                    <div class="~w-14/20 ~h-14/20 rounded-md overflow-hidden bg-gray-100 flex-shrink-0">
                        <img src="{{ asset($imageUrl) }}" class="w-full h-full object-cover">
                    </div>

                    <div class="flex-1">
                        <p class="font-semibold ~text-sm/base text-gray-900">{{ $product->name }}</p>
                        <p class="text-xs text-gray-400">{{ $product->gender }}'s {{ $product->sport }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">
                            {{ $product->variants->count() }} {{ Str::plural('variant', $product->variants->count()) }}
                        </p>
                    </div>

                    <div class="flex-shrink-0">
                        <p class="font-semibold ~text-sm/base text-gray-900 text-right">
                            {{ number_format((float) $firstVariant?->price, 2, ',', ' ') }} $
                        </p>
                    </div>

                    <div class="flex ~gap-2/3 flex-shrink-0">
                        <a href="{{ route('admin.products.edit', $product) }}"
                            class="px-4 py-2 border rounded-full text-sm font-medium hover:border-black transition-colors duration-200">
                            Edit
                        </a>

                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-2 border border-red-300 text-red-400 rounded-full text-sm font-medium hover:border-red-600 hover:text-red-600 transition-colors duration-200"
                                onclick="return confirm('Delete {{ $product->name }}?')">
                                Delete
                            </button>
                        </form>
                    </div>

                </div>
            @endforeach
        </div>
    @endif

</main>
@endsection
