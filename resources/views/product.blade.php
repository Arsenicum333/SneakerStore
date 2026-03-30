@extends('layouts.app')

@section('title', 'Product')

@section('content')
<main class="max-w-[1000px] mx-auto ~mt-5/8">

        <div class="grid grid-cols-1 md:grid-cols-[60%_40%]">

            <!-- Left Part: Images -->
            <div class="flex gap-4 ~p-4/6 md:sticky md:top-0 md:h-screen">

                <!-- Thumbnails -->
                <div class="flex flex-col gap-2">

                    <button class="~w-12/16 ~h-12/16 border border-black rounded-md hover:border-black focus:border-black">
                        <img src="{{ asset('assets/sneakers/productsneakers1.avif') }}" class="w-full h-full object-cover rounded-md">
                    </button>

                    <button class="~w-12/16 ~h-12/16 border border-transparent rounded-md hover:border-black focus:border-black">
                        <img src="{{ asset('assets/sneakers/productsneakers2.avif') }}" class="w-full h-full object-cover rounded-md">
                    </button>

                    <button class="~w-12/16 ~h-12/16 border border-transparent rounded-md hover:border-black focus:border-black">
                        <img src="{{ asset('assets/sneakers/productsneakers3.avif') }}" class="w-full h-full object-cover rounded-md">
                    </button>

                    <button class="~w-12/16 ~h-12/16 border border-transparent rounded-md hover:border-black focus:border-black">
                        <img src="{{ asset('assets/sneakers/productsneakers4.avif') }}" class="w-full h-full object-cover rounded-md">
                    </button>

                    <button class="~w-12/16 ~h-12/16 border border-transparent rounded-md hover:border-black focus:border-black">
                        <img src="{{ asset('assets/sneakers/productsneakers5.avif') }}" class="w-full h-full object-cover rounded-md">
                    </button>

                    <button class="~w-12/16 ~h-12/16 border border-transparent rounded-md hover:border-black focus:border-black">
                        <img src="{{ asset('assets/sneakers/productsneakers6.avif') }}" class="w-full h-full object-cover rounded-md">
                    </button>

                    <button class="~w-12/16 ~h-12/16 border border-transparent rounded-md hover:border-black focus:border-black">
                        <img src="{{ asset('assets/sneakers/productsneakers7.avif') }}" class="w-full h-full object-cover rounded-md">
                    </button>

                    <button class="~w-12/16 ~h-12/16 border border-transparent rounded-md hover:border-black focus:border-black">
                        <img src="{{ asset('assets/sneakers/productsneakers8.avif') }}" class="w-full h-full object-cover rounded-md">
                    </button>

                </div>

                <!-- Main Image -->
                <div class="relative flex-1 max-h-[600px] bg-gray-200 rounded-lg flex items-center justify-center overflow-hidden">

                    <!-- Image -->
                    <img src="{{ asset('assets/sneakers/productsneakers1.avif') }}" class="w-full h-full object-cover">

                    <!-- Arrows -->
                    <div class="absolute bottom-4 right-4 flex gap-2">
                        <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow hover:bg-gray-100 transition">
                            <img src="{{ asset('assets/lucide/chevron-left.svg') }}" class="w-4 h-4">
                        </button>

                        <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow hover:bg-gray-100 transition">
                            <img src="{{ asset('assets/lucide/chevron-right.svg') }}" class="w-4 h-4">
                        </button>
                    </div>

                </div>

            </div>

            <!-- Right Part: Product Info -->
            <div class="flex flex-col ~gap-3/5 ~p-4/6">

                <div class="mb-4">
                    <h1 class="~text-lg/xl font-semibold">
                    Nike Structure Plus
                    </h1>
                    <p class="text-gray-500 ~text-sm/base">
                    Men's Road Running Shoes
                    </p>
                    <p class="font-semibold ~text-base/lg mt-2">
                    179,99 $
                    </p>
                </div>

                <!-- Color Buttons -->
                <div class="flex items-center gap-1.5">

                    <button class="~w-12/16 ~h-12/16 border border-black rounded-md hover:border-black focus:border-black">
                        <img src="{{ asset('assets/sneakers/productsneakers1.avif') }}" class="w-full h-full object-cover rounded-md">
                    </button>

                    <button class="~w-12/16 ~h-12/16 border border-transparent rounded-md hover:border-black focus:border-black">
                        <img src="{{ asset('assets/sneakers/productsneakers9.avif') }}" class="w-full h-full object-cover rounded-md">
                    </button>

                    <button class="~w-12/16 ~h-12/16 border border-transparent rounded-md hover:border-black focus:border-black">
                        <img src="{{ asset('assets/sneakers/productsneakers10.avif') }}" class="w-full h-full object-cover rounded-md">
                    </button>

                </div>

                <!-- Sizes -->
                <div class="my-6">
                    <p class="font-semibold ~text-sm/base mb-2">Select Size</p>

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
                </div>

                <!-- Action Buttons -->
                <button class="w-full bg-black text-white py-4 rounded-full font-semibold hover:bg-zinc-800 transition-colors duration-200">
                    Add to Bag
                </button>

                <button class="w-full border py-4 rounded-full font-semibold transition flex items-center justify-center gap-2 hover:border-black">
                    Favourite
                    <img src="{{ asset('assets/lucide/heart.svg') }}" class="~w-4/5 ~h-4/5">
                </button>

                <!-- Product Description -->
                <div class="text-gray-600 text-sm mt-6 flex flex-col gap-4 leading-relaxed">

                    <p>
                        Built for comfort and stability on every run, the Nike Structure Plus
                        is designed to support you from your first step to your last mile.
                        Whether you're training daily or going for longer distances, these
                        shoes provide a smooth and reliable ride.
                    </p>

                    <p>
                        A responsive cushioning system helps absorb impact while maintaining
                        energy return, keeping your stride efficient and comfortable.
                        The engineered upper offers breathability and a secure fit,
                        adapting naturally to your foot as you move.
                    </p>

                    <ul class="list-disc pl-5 space-y-1">
                        <li>Supportive design for stable road running</li>
                        <li>Responsive cushioning for all-day comfort</li>
                        <li>Breathable upper for improved airflow</li>
                        <li>Durable outsole for reliable traction</li>
                    </ul>

                    <p>
                        From short runs to long sessions, the Nike Structure Plus helps you
                        stay focused on your pace while delivering the support and comfort
                        you need to go further.
                    </p>

                </div>

            </div>

        </div>

    </main>
@endsection

