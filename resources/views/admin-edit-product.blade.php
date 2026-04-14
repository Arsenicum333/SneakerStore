@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<main class="max-w-[1000px] mx-auto ~mt-4/8 ~p-4/6">

        <div class="flex-1 flex flex-col ~gap-8/10">
            <div>
                <h2 class="~text-lg/2xl font-bold text-gray-900 ~mb-3/5">Edit Product</h2>
                <div class="flex flex-col ~gap-2/3">
                    <div class="relative">
                        <input type="text" id="name" value="Nike Structure Plus" placeholder="Email*" class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                        <label for="name" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                            Add Name*
                        </label>
                    </div>
                    <div class="relative">
                        <input type="text" id="colour" value="Green" placeholder="Email*" class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                        <label for="colour" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                            Add Colour Name*
                        </label>
                    </div>
                    <div class="flex ~gap-2/3 w-full">
                        <div class="relative flex-1">
                            <input type="text" id="tag1" value="Men" placeholder="Add Gender*"
                                class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                            <label for="tag1"
                                class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                                Add Gender*
                            </label>
                        </div>
                        <div class="relative flex-1">
                            <input type="text" id="tag2" value="Running" placeholder="Add Sport*"
                                class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                            <label for="tag2"
                                class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                                Add Sport
                            </label>
                        </div>
                    </div>
                    <div class="relative flex-1">
                        <input type="text" id="price"value="119.99" placeholder="Add Price*"
                            class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                        <label for="price"
                            class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                            Add Price*
                        </label>
                    </div>
                    <p class="~text-xs/sm text-gray-400 ~mt-1/2">Add Available Sizes</p>
                    <div class="grid grid-cols-3 gap-2">
                        <button class="border rounded-md py-2 hover:border-black focus:border-black">EU 35</button>
                        <button class="border rounded-md py-2 hover:border-black focus:border-black">EU 36</button>
                        <button class="border rounded-md py-2 hover:border-black focus:border-black">EU 37</button>
                        <button class="border rounded-md py-2 hover:border-black focus:border-black">EU 38</button>
                        <button class="border rounded-md py-2 hover:border-black focus:border-black">EU 39</button>
                        <button class="border rounded-md py-2 hover:border-black focus:border-black">EU 40</button>
                        <button class="border rounded-md py-2 hover:border-black focus:border-black">EU 41</button>
                        <button class="border rounded-md py-2 hover:border-black focus:border-black">EU 42</button>
                        <button class="border rounded-md py-2 hover:border-black focus:border-black">EU 43</button>
                        <button class="border rounded-md py-2 hover:border-black focus:border-black">EU 44</button>
                        <button class="border rounded-md py-2 hover:border-black focus:border-black">EU 45</button>
                        <button class="border rounded-md py-2 hover:border-black focus:border-black">EU 46</button>
                        <button class="border rounded-md py-2 hover:border-black focus:border-black">EU 47</button>
                        <button class="border rounded-md py-2 hover:border-black focus:border-black">EU 48</button>
                        <button class="border rounded-md py-2 hover:border-black focus:border-black">EU 49</button>
                    </div>
                    <div class="relative flex-1">
                        <textarea id="description" rows="6" placeholder="Add Description*"
                            class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent resize-none min-h-[200px]">Built for comfort and stability on every run, the Nike Structure Plus is designed to support you from your first step to your last mile. Whether you're training daily or going for longer distances, these shoes provide a smooth and reliable ride.
    A responsive cushioning system helps absorb impact while maintaining energy return, keeping your stride efficient and comfortable. The engineered upper offers breathability and a secure fit, adapting naturally to your foot as you move.</textarea>
                        <label for="description"
                            class="absolute left-4 -top-2.5 bg-white px-1 text-xs text-gray-500">
                            Add Description (minimum 250 symbols)*
                        </label>
                    </div>
                    <div class="relative flex-1">
                        <input type="text" id="stock" value="35" placeholder="Add Stock Quantity*"
                            class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                        <label for="stock"
                            class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                            Add Stock Quantity*
                        </label>
                    </div>
                    <p class="~text-xs/sm text-gray-400 ~mt-1/2">Add Photos (minimum 2 photos)</p>
                    <div class="grid grid-cols-3 ~gap-2/3">

                        <label class="aspect-square border-2 border-dashed border-gray-300 rounded-lg overflow-hidden cursor-pointer hover:border-gray-900 transition-colors group">
                            <img src="{{ asset('assets/sneakers/sneakers9.avif') }}" class="w-full h-full object-cover">
                        </label>

                        <label class="aspect-square border-2 border-dashed border-gray-300 rounded-lg overflow-hidden cursor-pointer hover:border-gray-900 transition-colors group">
                            <img src="{{ asset('assets/sneakers/productsneakers5.avif') }}" class="w-full h-full object-cover">
                        </label>

                        <label class="aspect-square border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center cursor-pointer hover:border-gray-900 transition-colors group">
                            <input type="file" accept="image/*" class="hidden">
                            <img src="{{ asset('assets/lucide/plus.svg') }}">
                        </label>
                    </div>
                    <button type="button" class="w-full border px-6 ~py-4/3 rounded-full font-semibold transition flex items-center justify-center gap-2 hover:border-black">
                        Add New Variant
                    </button>
                    <a href="/admin/products" type="submit" class="w-full flex justify-center bg-black text-white px-6 ~py-4/3 rounded-full font-medium hover:bg-zinc-800 transition-colors duration-200">
                        Save Changes
                    </a href>
                </div>
            </div>
        </div>

    </main>
@endsection
