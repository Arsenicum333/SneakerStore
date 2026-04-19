@extends('layouts.app')

@section('title', 'SneakerStore')

@section('content')
<main class="~px-0/6 max-w-[1200px] mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 ~gap-2/5 ~mt-3/5 ~mb-3/5">

        <div class="md:col-span-2 relative" style="padding-bottom: 56%;">
            <img src="{{ asset('assets/images/block1.jpg') }}" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40"></div>
            <div class="absolute inset-0 flex items-end justify-start md:justify-center ~p-4/8 md:pl-8">
                <div class="text-left md:text-center text-white">
                    <h2 class="~text-xs/4xl font-bold ~mb-0.5/1">NIKE LEBRON</h2>
                    <p class="~text-sm/3xl ~mb-3/7 font-semibold">Be A King Of The Court</p>
                    <a href="/catalog">
                        <button class="bg-white text-black font-semibold ~px-4/6 ~py-1/3 rounded-full md:rounded-lg hover:bg-gray-100 transition">Shop</button>
                    </a>
                </div>
            </div>
        </div>

        <div class="relative" style="padding-bottom: 56%;">
            <img src="{{ asset('assets/images/block2.jpg') }}" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40"></div>
            <div class="absolute inset-0 flex items-end justify-start ~p-4/8">
                <div class="text-left text-white">
                    <h2 class="~text-xs/lg font-semibold ~mb-0.5/1">Air Max 95</h2>
                    <p class="~text-sm/3xl ~mb-3/7 font-semibold">Be Cool</p>
                    <a href="/catalog">
                        <button class="bg-white text-black font-semibold ~px-4/6 ~py-1/3 rounded-full md:rounded-lg hover:bg-gray-100 transition">Shop</button>
                    </a>
                </div>
            </div>
        </div>

        <div class="relative" style="padding-bottom: 56%;">
            <img src="{{ asset('assets/images/block3.jpg') }}" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40"></div>
            <div class="absolute inset-0 flex items-end justify-start ~p-4/8">
                <div class="text-left text-white">
                    <h2 class="~text-xs/lg font-semibold ~mb-0.5/1">Nike Mercurial Superfly 10 Elite</h2>
                    <p class="~text-sm/3xl ~mb-3/7 font-semibold">All Grit No Brakes</p>
                    <a href="/catalog">
                        <button class="bg-white text-black font-semibold ~px-4/6 ~py-1/3 rounded-full md:rounded-lg hover:bg-gray-100 transition">Shop</button>
                    </a>
                </div>
            </div>
        </div>

        <div class="relative" style="padding-bottom: 56%;">
            <img src="{{ asset('assets/images/block4.jpg') }}" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40"></div>
            <div class="absolute inset-0 flex items-end justify-start ~p-4/8">
                <div class="text-left text-white">
                    <h2 class="~text-xs/lg font-semibold ~mb-0.5/1">Nike Running</h2>
                    <p class="~text-sm/3xl ~mb-3/7 font-semibold">Fast Pack</p>
                    <a href="/catalog">
                        <button class="bg-white text-black font-semibold ~px-4/6 ~py-1/3 rounded-full md:rounded-lg hover:bg-gray-100 transition">Shop</button>
                    </a>
                </div>
            </div>
        </div>

        <div class="relative" style="padding-bottom: 56%;">
            <img src="{{ asset('assets/images/block5.jpg') }}" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40"></div>
            <div class="absolute inset-0 flex items-end justify-start ~p-4/8">
                <div class="text-left text-white">
                    <h2 class="~text-xs/lg font-semibold ~mb-0.5/1">Nike Lift</h2>
                    <p class="~text-sm/3xl ~mb-3/7 font-semibold">No Pain No Gain</p>
                    <a href="/catalog">
                        <button class="bg-white text-black font-semibold ~px-4/6 ~py-1/3 rounded-full md:rounded-lg hover:bg-gray-100 transition">Shop</button>
                    </a>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection
