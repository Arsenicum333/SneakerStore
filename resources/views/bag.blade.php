@extends('layouts.app')

@section('title', 'Bag')

@section('content')
<main class="max-w-[1100px] mx-auto ~mt-5/8 px-4">

        <!-- Page Title -->
        <div class="~mb-5/8">
            <h1 class="text-3xl font-semibold">Bag</h1>
        </div>

        <!-- Bag + Summary -->
        <div class="grid grid-cols-1 md:grid-cols-[2fr_1fr] gap-6">

            <!-- Bag Items -->
            <div class="flex flex-col gap-6">

                <!-- Item -->
                <div class="flex gap-4">

                    <!-- Left: Image + Buttons -->
                    <div class="flex flex-col items-center gap-1">
                        <img src="{{ asset('assets/sneakers/bagsneakers1.avif') }}" class="w-40 h-40 bg-gray-200 rounded-lg object-cover">

                        <div class="flex items-center gap-2 mt-2">
                            <button class="p-2 border rounded-full hover:bg-gray-100">
                                <img src="{{ asset('assets/lucide/trash.svg') }}" class="w-4 h-4">
                            </button>

                            <div class="border rounded-full flex items-center">
                                <button class="p-2 rounded-full hover:bg-gray-100">
                                    <img src="{{ asset('assets/lucide/minus.svg') }}" class="w-4 h-4">
                                </button>
                                <span class="font-semibold px-2">1</span>
                                <button class="p-2 rounded-full hover:bg-gray-100">
                                    <img src="{{ asset('assets/lucide/plus.svg') }}" class="w-4 h-4">
                                </button>
                            </div>

                            <button class="p-2 border rounded-full hover:bg-gray-100">
                                <img src="{{ asset('assets/lucide/heart.svg') }}" class="w-4 h-4">
                            </button>
                        </div>
                    </div>

                    <!-- Right: Description + Price -->
                    <div class="flex-1 flex flex-col-reverse sm:flex-row sm:items-start gap-1 sm:gap-4">

                        <div class="flex-1 flex flex-col">
                            <h2 class="font-semibold text-lg">Nike Air Force 1 '07 LV8</h2>
                            <p class="text-gray-500 text-base">Men's Shoes</p>
                            <p class="text-gray-500 text-base">Plum Eclipse/Metallic Silver</p>
                            <a href="#" class="text-gray-500 text-lg font-semibold underline underline-offset-4 decoration-2">Size 43</a>
                        </div>

                        <div class="font-semibold text-lg whitespace-nowrap">
                            119,99 $
                        </div>

                    </div>
                </div>

                <hr class="my-2">

                <!-- Item -->
                <div class="flex gap-4">

                    <!-- Left: Image + Buttons -->
                    <div class="flex flex-col items-center gap-1">
                        <img src="{{ asset('assets/sneakers/bagsneakers2.avif') }}" class="w-40 h-40 bg-gray-200 rounded-lg object-cover">

                        <div class="flex items-center gap-2 mt-2">
                            <button class="p-2 border rounded-full hover:bg-gray-100">
                                <img src="{{ asset('assets/lucide/trash.svg') }}" class="w-4 h-4">
                            </button>

                            <div class="border rounded-full flex items-center">
                                <button class="p-2 rounded-full hover:bg-gray-100">
                                    <img src="{{ asset('assets/lucide/minus.svg') }}" class="w-4 h-4">
                                </button>
                                <span class="font-semibold px-2">2</span>
                                <button class="p-2 rounded-full hover:bg-gray-100">
                                    <img src="{{ asset('assets/lucide/plus.svg') }}" class="w-4 h-4">
                                </button>
                            </div>

                            <button class="p-2 border rounded-full hover:bg-gray-100">
                                <img src="{{ asset('assets/lucide/heart.svg') }}" class="w-4 h-4">
                            </button>
                        </div>
                    </div>

                    <!-- Right: Description + Price -->
                    <div class="flex-1 flex flex-col-reverse sm:flex-row sm:items-start gap-1 sm:gap-4">

                        <div class="flex-1 flex flex-col">
                            <h2 class="font-semibold text-lg">Nike Air Max 95 Big Bubble</h2>
                            <p class="text-gray-500 text-base">Men's Shoes</p>
                            <a href="#" class="text-gray-500 text-lg font-semibold underline underline-offset-4 decoration-2">Size 43</a>
                        </div>

                        <div class="font-semibold text-lg whitespace-nowrap">
                            199,99 $
                        </div>

                    </div>
                </div>

            </div>

            <!-- Summary -->
            <div class="border p-6 rounded-lg flex flex-col gap-4 h-fit">
                <h2 class="font-semibold text-2xl mb-4">Summary</h2>
                <div class="flex justify-between text-gray-500 gap-6">
                    <span>Subtotal</span>
                    <span>319,98 $</span>
                </div>
                <div class="flex justify-between text-gray-500 gap-6">
                    <span>Estimated Delivery & Handling</span>
                    <span>Free</span>
                </div>
                <hr class="my-2">
                <div class="flex justify-between font-semibold text-lg gap-6">
                    <span>Total</span>
                    <span>319,98 $</span>
                </div>
                <a href="/payment" class="flex justify-center w-full bg-black text-white py-4 rounded-full font-semibold hover:bg-zinc-800 transition-colors duration-200 mt-4">
                    Buy Now
                </a>
            </div>

        </div>

        <!-- You Might Also Like -->
        <section class="mt-24">
            <div class="flex items-center w-full">
                <h2 class="font-semibold text-3xl mb-4 w-1/2">You Might Also Like</h2>
                <div class="hidden md:flex gap-2 w-1/2 justify-end">
                        <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow hover:bg-gray-100 transition">
                            <img src="{{ asset('assets/lucide/chevron-left.svg') }}" class="~w-4/5 ~h-4/5">
                        </button>

                        <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow hover:bg-gray-100 transition">
                            <img src="{{ asset('assets/lucide/chevron-right.svg') }}" class="~w-4/5 ~h-4/5">
                        </button>

                    </div>
                </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

                <a href="/product" class="flex flex-col bg-gray-100 rounded-lg">
                    <img src="{{ asset('assets/sneakers/bagsneakers3.avif') }}" class="w-full h-full object-cover bg-gray-300 rounded-lg">
                    <div class="p-4">
                        <h3 class="font-semibold text-sm">Nike Dunk Low SE 'LNY'</h3>
                        <p class="text-gray-500 text-xs">Men's Shoes</p>
                        <span class="font-semibold mt-1">119,99 $</span>
                    </div>
                </a>

                <a href="/product" class="flex flex-col bg-gray-100 rounded-lg">
                    <img src="{{ asset('assets/sneakers/bagsneakers4.avif') }}" class="w-full h-full object-cover bg-gray-300 rounded-lg">
                    <div class="p-4">
                        <h3 class="font-semibold text-sm">Nike Dunk Low Retro</h3>
                        <p class="text-gray-500 text-xs">Men's Shoes</p>
                        <span class="font-semibold mt-1">119,99 $</span>
                    </div>
                </a>

                <a href="/product" class="flex flex-col bg-gray-100 rounded-lg">
                    <img src="{{ asset('assets/sneakers/bagsneakers5.avif') }}" class="w-full h-full object-cover bg-gray-300 rounded-lg">
                    <div class="p-4">
                        <h3 class="font-semibold text-sm">Nike Vomero Plus</h3>
                        <p class="text-gray-500 text-xs">Men's Road Running Shoes</p>
                        <span class="font-semibold mt-1">174,99 $</span>
                    </div>
                </a>

            </div>
        </section>

    </main>
@endsection

