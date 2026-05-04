@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<main class="max-w-[1000px] mx-auto ~px-4/6 ~mt-5/8">

    <div class="~mb-6/10">
        <a href="{{ route('admin.products') }}" class="text-sm text-gray-400 hover:text-gray-900">← Back to products</a>
        <h1 class="~text-xl/3xl font-semibold mt-2">Edit Product</h1>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-4 border border-red-300 rounded-lg text-sm text-red-500">
            <ul class="list-disc pl-4 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $variant = $product->variants->first();
        $sizes = $variant?->sizes->keyBy('size') ?? collect();
    @endphp

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="flex flex-col ~gap-4/6">

            <div class="relative">
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" placeholder="Product Name*"
                    class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                <label for="name" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                    Product Name*
                </label>
            </div>

            <div class="relative">
                <input type="text" id="colour" name="color" value="{{ old('color', $variant?->color) }}" placeholder="Colour*"
                    class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                <label for="colour" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                    Colour Name*
                </label>
            </div>

            <div class="flex ~gap-2/3 w-full">
                <div class="relative flex-1">
                    <input type="text" id="gender" name="gender" value="{{ old('gender', $product->gender) }}" placeholder="Gender*"
                        class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                    <label for="gender" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                        Gender*
                    </label>
                </div>
                <div class="relative flex-1">
                    <input type="text" id="sport" name="sport" value="{{ old('sport', $product->sport) }}" placeholder="Sport*"
                        class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                    <label for="sport" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                        Sport
                    </label>
                </div>
            </div>

            <div class="relative">
                <input type="text" id="price" name="price" value="{{ old('price', $variant?->price) }}" placeholder="Price*"
                    class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                <label for="price" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                    Price*
                </label>
            </div>

            <div>
                <p class="~text-xs/sm text-gray-400 ~mb-1/2">Available Sizes & Stock</p>
                <div class="grid grid-cols-3 gap-2">
                    @foreach (['35','36','37','38','39','40','41','42','43','44','45','46','47','48','49'] as $size)
                        @php $existingSize = $sizes->get($size); @endphp
                        <label class="flex flex-col items-center border rounded-md py-2 px-1 cursor-pointer hover:border-black transition-colors {{ $existingSize ? 'border-black font-semibold' : '' }}">
                            <input type="checkbox" name="sizes[]" value="{{ $size }}" class="sr-only" {{ $existingSize ? 'checked' : '' }}>
                            <span class="text-sm">EU {{ $size }}</span>
                            <input type="number" name="stock[{{ $size }}]"
                                value="{{ $existingSize?->stock_quantity ?? 0 }}"
                                min="0"
                                class="mt-1 w-14 text-center text-xs border rounded outline-none focus:border-black {{ !$existingSize ? 'opacity-30' : '' }}">
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="relative">
                <textarea id="description" name="description" rows="6"
                    class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all resize-none min-h-[200px]">{{ old('description', $product->description) }}</textarea>
                <label for="description" class="absolute left-4 -top-2.5 bg-white px-1 text-xs text-gray-500">
                    Description (minimum 250 symbols)*
                </label>
            </div>

            @if ($variant?->images->isNotEmpty())
                <div>
                    <p class="~text-xs/sm text-gray-400 ~mb-1/2">Current Photos</p>
                    <div class="grid grid-cols-3 ~gap-2/3">
                        @foreach ($variant->images as $image)
                            <div class="aspect-square rounded-lg overflow-hidden border-2 border-gray-200">
                                <img src="{{ asset($image->image_url) }}" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div>
                <p class="~text-xs/sm text-gray-400 ~mb-1/2">Add New Photos</p>
                <div class="grid grid-cols-3 ~gap-2/3">
                    @for ($i = 0; $i < 3; $i++)
                        <label class="aspect-square border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center cursor-pointer hover:border-gray-900 transition-colors group">
                            <input type="file" name="photos[]" accept="image/*" class="hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-gray-300 group-hover:text-gray-600 transition-colors mb-1">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                <polyline points="17 8 12 3 7 8"/>
                                <line x1="12" x2="12" y1="3" y2="15"/>
                            </svg>
                            <span class="text-xs text-gray-300 group-hover:text-gray-600 transition-colors">Add Photo</span>
                        </label>
                    @endfor
                </div>
            </div>

            <div class="flex gap-4 mt-4">
                <button type="submit" class="flex-1 bg-black text-white py-3 rounded-full">
                    Save Changes
                </button>
            </div>
            </form>

            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="mt-4">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="w-full border-2 border-red-400 text-red-400 py-3 rounded-full"
                    onclick="return confirm('Delete {{ $product->name }}?')">
                    Delete Product
                </button>
            </form>

        <script>
            document.querySelectorAll('input[type="file"]').forEach(input => {
                input.addEventListener('change', function () {
                    const label = this.closest('label');

                    if (this.files && this.files[0]) {
                        const reader = new FileReader();

                        reader.onload = function (e) {
                            label.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover rounded-lg">`;
                        };

                        reader.readAsDataURL(this.files[0]);
                    }
                });
            });
            </script>

</main>
@endsection
