@extends('layouts.app')

@section('title', 'Favourites')

@section('content')
<main class="max-w-[1100px] mx-auto ~mt-5/8 px-4">

        <!-- Page Title -->
        <div class="~mb-5/8">
            <h1 class="text-3xl font-semibold">Favourites</h1>
        </div>

        <section>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

                <div class="relative flex flex-col bg-gray-100 rounded-lg">
                    <img src="{{ asset('assets/sneakers/sneakers7.avif') }}" class="w-full h-full object-cover bg-gray-300 rounded-lg">
                    <button class="absolute top-4 right-4 ~w-6/8 ~h-6/8 bg-white rounded-full flex items-center justify-center shadow hover:bg-gray-100 transition">
                        <img src="{{ asset('assets/lucide/heart.svg') }}" class="w-4 h-4">
                    </button>
                    <div class="p-4">
                        <h3 class="font-semibold text-sm">Nike Dunk Low SE 'LNY'</h3>
                        <p class="text-gray-500 text-xs">Men's Shoes</p>
                        <span class="font-semibold mt-1">119,99 $</span>
                    </div>
                </div>

                <div class="relative flex flex-col bg-gray-100 rounded-lg">
                    <img src="{{ asset('assets/sneakers/sneakers8.avif') }}" class="w-full h-full object-cover bg-gray-300 rounded-lg">
                    <button class="absolute top-4 right-4 ~w-6/8 ~h-6/8 bg-white rounded-full flex items-center justify-center shadow hover:bg-gray-100 transition">
                        <img src="{{ asset('assets/lucide/heart.svg') }}" class="w-4 h-4">
                    </button>
                    <div class="p-4">
                        <h3 class="font-semibold text-sm">Nike Dunk Low Retro</h3>
                        <p class="text-gray-500 text-xs">Men's Shoes</p>
                        <span class="font-semibold mt-1">119,99 $</span>
                    </div>
                </div>

                <div class="relative flex flex-col bg-gray-100 rounded-lg">
                    <img src="{{ asset('assets/sneakers/sneakers12.avif') }}" class="w-full h-full object-cover bg-gray-300 rounded-lg">
                    <button class="absolute top-4 right-4 ~w-6/8 ~h-6/8 bg-white rounded-full flex items-center justify-center shadow hover:bg-gray-100 transition">
                        <img src="{{ asset('assets/lucide/heart.svg') }}" class="w-4 h-4">
                    </button>
                    <div class="p-4">
                        <h3 class="font-semibold text-sm">Nike Vomero Plus</h3>
                        <p class="text-gray-500 text-xs">Men's Road Running Shoes</p>
                        <span class="font-semibold mt-1">174,99 $</span>
                    </div>
                </div>

            </div>
        </section>

        <section class="mt-24">
            <div class="flex items-center w-full">
                <h2 class="font-semibold text-3xl mb-4 w-1/2">Find Your Next Favourite</h2>
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

