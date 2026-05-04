@extends('layouts.app')

@section('title', 'Create Product')

@section('content')
<main class="max-w-[1000px] mx-auto ~px-4/6 ~mt-5/8">

    <div class="~mb-6/10">
        <a href="{{ route('admin.products') }}" class="text-sm text-gray-400 hover:text-gray-900">← Back to products</a>
        <h1 class="~text-xl/3xl font-semibold mt-2">Create New Product</h1>
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

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="product-form">
        @csrf
        <div class="flex flex-col ~gap-4/6">

            <div class="relative">
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Product Name*"
                    class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                <label for="name" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                    Product Name*
                </label>
            </div>

            <div class="relative">
                <input type="text" id="colour" name="color" value="{{ old('color') }}" placeholder="Colour*"
                    class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                <label for="colour" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                    Colour Name*
                </label>
            </div>

            <div class="flex ~gap-2/3 w-full">
                <div class="relative flex-1">
                    <input type="text" id="gender" name="gender" value="{{ old('gender') }}" placeholder="Gender*"
                        class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                    <label for="gender" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                        Gender*
                    </label>
                </div>
                <div class="relative flex-1">
                    <input type="text" id="sport" name="sport" value="{{ old('sport') }}" placeholder="Sport"
                        class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                    <label for="sport" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                        Sport
                    </label>
                </div>
            </div>

            <div class="relative">
                <input type="text" id="price" name="price" value="{{ old('price') }}" placeholder="Price*"
                    class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                <label for="price" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                    Price*
                </label>
            </div>

            <div>
                <p class="~text-xs/sm text-gray-400 ~mb-1/2">Available Sizes & Stock</p>
                <div class="grid grid-cols-3 gap-2">
                    @foreach (['35','36','37','38','39','40','41','42','43','44','45','46','47','48','49'] as $size)
                        <label class="flex flex-col items-center border rounded-md py-2 px-1 cursor-pointer hover:border-black transition-colors">
                            <input type="checkbox" name="sizes[]" value="{{ $size }}" class="sr-only size-checkbox">
                            <span class="text-sm">EU {{ $size }}</span>
                            <input type="number" name="stock[{{ $size }}]" value="0" min="0" disabled
                                class="stock-input mt-1 w-14 text-center text-xs border rounded outline-none focus:border-black bg-gray-100">
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="relative">
                <textarea id="description" name="description" rows="6"
                    class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all resize-none min-h-[200px]">{{ old('description') }}</textarea>
                <label for="description" class="absolute left-4 -top-2.5 bg-white px-1 text-xs text-gray-500">
                    Description (minimum 250 symbols)*
                </label>
            </div>

            <div>
                <p class="~text-xs/sm text-gray-400 ~mb-1/2">Photos (min 2)</p>
                <div class="grid grid-cols-4 ~gap-2/3" id="photos-container">
                    <label class="photo-label aspect-square border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center cursor-pointer hover:border-gray-900 transition-colors group">
                        <input type="file" name="photos[]" accept="image/*" class="hidden photo-input" onchange="previewImage(this)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-gray-300 group-hover:text-gray-600 transition-colors mb-1">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="17 8 12 3 7 8"/>
                            <line x1="12" x2="12" y1="3" y2="15"/>
                        </svg>
                        <span class="text-xs text-gray-300 group-hover:text-gray-600 transition-colors">Photo 1</span>
                    </label>
                    <label class="photo-label aspect-square border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center cursor-pointer hover:border-gray-900 transition-colors group">
                        <input type="file" name="photos[]" accept="image/*" class="hidden photo-input" onchange="previewImage(this)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-gray-300 group-hover:text-gray-600 transition-colors mb-1">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="17 8 12 3 7 8"/>
                            <line x1="12" x2="12" y1="3" y2="15"/>
                        </svg>
                        <span class="text-xs text-gray-300 group-hover:text-gray-600 transition-colors">Photo 2</span>
                    </label>
                </div>
                <button type="button" id="add-photo-btn" class="mt-3 text-sm text-gray-500 hover:text-black">+ Add more photo</button>
            </div>

            <div class="flex ~gap-3/5 ~mt-2/4">
                <button type="submit" class="flex-1 bg-black text-white ~py-3/4 rounded-full font-semibold ~text-sm/base hover:bg-zinc-800 transition-colors duration-200">
                    Create Product
                </button>
            </div>

        </div>
    </form>

</main>

<script>
function previewImage(input) {
    const label = input.closest('.photo-label');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            let img = label.querySelector('img');

            if (!img) {
                img = document.createElement('img');
                img.className = 'w-full h-full object-cover rounded-lg';
                label.appendChild(img);
            }

            img.src = e.target.result;
            label.style.border = '2px solid #000';
        };

        reader.readAsDataURL(input.files[0]);
    }
}

document.addEventListener('change', function(e) {
    if (e.target.classList.contains('photo-input')) {
        previewImage(e.target);
    }
});

document.addEventListener('DOMContentLoaded', function() {

    const sizeCheckboxes = document.querySelectorAll('.size-checkbox');

    sizeCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const stockInput = this.closest('label').querySelector('.stock-input');

            if (this.checked) {
                stockInput.disabled = false;
                stockInput.classList.remove('bg-gray-100');
                stockInput.classList.add('bg-white');

                if (stockInput.value === '0') {
                    stockInput.value = '';
                }
            } else {
                stockInput.disabled = true;
                stockInput.classList.add('bg-gray-100');
                stockInput.classList.remove('bg-white');
                stockInput.value = '0';
            }
        });
    });

    let photoCount = 2;
    const container = document.getElementById('photos-container');
    const addBtn = document.getElementById('add-photo-btn');

    if (addBtn) {
        addBtn.addEventListener('click', function() {
            photoCount++;

            const wrapper = document.createElement('div');
            wrapper.className = 'photo-item';

            wrapper.innerHTML = `
                <label class="photo-label aspect-square border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center cursor-pointer">
                    <input type="file" name="photos[]" class="hidden photo-input" accept="image/*">
                    <span class="text-xs text-gray-400">Photo ${photoCount}</span>
                </label>
            `;

            container.appendChild(wrapper);

            wrapper.querySelector('input').click();
        });
    }
});
</script>
@endsection