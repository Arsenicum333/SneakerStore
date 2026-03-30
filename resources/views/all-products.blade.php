@extends('layouts.app')

@section('title', 'Catalog')

@section('content')
<main>
<div class="w-full ~p-4/6  mx-auto ~mt-3/5">
        <div class="flex items-center justify-center w-full ~mb-3/5">
            <h1 class="flex items-center ~text-xl/3xl font-bold justify-start w-1/2">
                All
            </h1>
            <div class="flex items-center justify-end w-1/2 ~gap-5/10">
                <div class="flex items-center justify-end gap-1 ~mt-3/5">
                    <span class="text-black ~text-sm/base">Hide Filters</span>
                    <div class="flex items-center justify-center">
                        <img src="{{ asset('assets/lucide/settings.svg') }}" class="~w-4/5 ~h-4/5 block">
                    </div>
                </div>

                <div class="flex items-center justify-end gap-1 ~mt-3/5">
                    <span class="text-black ~text-sm/base">Sort By</span>
                    <div class="flex items-center justify-center">
                        <img src="{{ asset('assets/lucide/arrow.svg') }}" class="~w-4/5 ~h-4/5 block">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex ~gap-4/8 ">

            <aside class="hidden md:block w-44 flex-shrink-0 ~text-xs/sm sticky top-0 self-start">
                 <div class="border-b-2 border-gray-200 pb-5">
                        <div class="flex items-center justify-between w-full gap-1 ~mt-3/5">
                            <span class="justify-start text-black ~text-sm/base font-semibold">Gender</span>
                            <div class="flex items-center justify-end">
                                <img src="{{ asset('assets/lucide/arrow.svg') }}" class="~w-4/5 ~h-4/5 block">
                            </div>
                        </div>
                 </div>

                 <div class="border-b-2 border-gray-200 pb-5">
                        <div class="flex items-center justify-between w-full gap-1 ~mt-3/5">
                            <span class="justify-start text-black ~text-sm/base font-semibold">Shop by Price</span>
                            <div class="flex items-center justify-end">
                                <img src="{{ asset('assets/lucide/arrow.svg') }}" class="~w-4/5 ~h-4/5 block">
                            </div>
                        </div>
                 </div>

                 <div class="border-b-2 border-gray-200 pb-5">
                        <div class="flex items-center justify-between w-full gap-1 ~mt-3/5">
                            <span class="justify-start text-black ~text-sm/base font-semibold">Size</span>
                            <div class="flex items-center justify-end">
                                <img src="{{ asset('assets/lucide/arrow.svg') }}" class="~w-4/5 ~h-4/5 block">
                            </div>
                        </div>
                 </div>

                 <div class="border-b-2 border-gray-200 pb-5">
                        <div class="flex items-center justify-between w-full gap-1 ~mt-3/5">
                            <span class="justify-start text-black ~text-sm/base font-semibold">Colour</span>
                            <div class="flex items-center justify-end">
                                <img src="{{ asset('assets/lucide/arrow.svg') }}" class="~w-4/5 ~h-4/5 block">
                            </div>
                        </div>
                 </div>

                 <div class="border-b-2 border-gray-200 pb-5">
                        <div class="flex items-center justify-between w-full gap-1 ~mt-3/5">
                            <span class="justify-start text-black ~text-sm/base font-semibold">Sports</span>
                            <div class="flex items-center justify-end">
                                <img src="{{ asset('assets/lucide/arrow.svg') }}" class="~w-4/5 ~h-4/5 block">
                            </div>
                        </div>
                 </div>
            </aside>

        <div class="flex-1 min-w-0">

            <div id="page-1" class="page">
                <div class="grid grid-cols-2 lg:grid-cols-3 ~gap-3/5">

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers3.avif') }}" class="w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 2 Colours</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Air Force 1 '07 LV8 EMT</p>
                            <p class="text-gray-500">129,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers7.avif') }}" class="  w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 1 Colour</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Air Force 1 '07 LXX</p>
                            <p class="text-gray-500">154,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers11.avif') }}" class="w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 1 Colour</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Air Force T Shoe Valentine's Day</p>
                            <p class="text-gray-500">134,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers1.avif') }}" class="w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 1 Colour</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Air Force 1 '07</p>
                            <p class="text-gray-500">104,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers9.avif') }}" class="w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 1 Colour</p>
                            <p class="font-semibold text-gray-900 leading-tight">Air 1 Max Boer</p>
                            <p class="text-gray-500">84,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers5.avif') }}" class="w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 2 Colours</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Air Max 10 Big Bubble</p>
                            <p class="text-gray-500">64,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers13.avif') }}" class="w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 1 Colour</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Vomero Plus</p>
                            <p class="text-gray-500">169,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers2.avif') }}" class="  w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 1 Colour</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Dunk Low SE 'LHT'</p>
                            <p class="text-gray-500">149,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers8.avif') }}" class="  w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 3 Colours</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Dunk Low Retro</p>
                            <p class="text-gray-500">119,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers4.avif') }}" class="  w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 1 Colour</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike SB BMB</p>
                            <p class="text-gray-500">64,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers12.avif') }}" class="  w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 1 Colour</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Vomero Plus</p>
                            <p class="text-gray-500">133,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers6.avif') }}" class="  w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 2 Colours</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Zoom Rival</p>
                            <p class="text-gray-500">119,99 €</p>
                        </div>
                    </a>

                </div>
            </div>

            <div id="page-2" class="page">
                <div class="grid grid-cols-2 lg:grid-cols-3 ~gap-3/5">

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers10.avif') }}" class="  w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 4 Colours</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Air Max 97</p>
                            <p class="text-gray-500">174,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers4.avif') }}" class="  w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 2 Colours</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Mercurial Superfly Plus</p>
                            <p class="text-gray-500">133,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers14.avif') }}" class="  w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 3 Colours</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Vapormax Flyknit</p>
                            <p class="text-gray-500">209,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers2.avif') }}" class="  w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 2 Colours</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike React Infinity Run</p>
                            <p class="text-gray-500">139,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers8.avif') }}" class="  w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 1 Colour</p>
                            <p class="font-semibold text-gray-900 leading-tight">Jordan 1 Mid</p>
                            <p class="text-gray-500">114,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers6.avif') }}" class="  w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 5 Colours</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Pegasus 40</p>
                            <p class="text-gray-500">129,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers12.avif') }}" class="  w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 2 Colours</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Blazer Mid '77</p>
                            <p class="text-gray-500">99,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers1.avif') }}" class="  w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 1 Colour</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Free Run 5.0</p>
                            <p class="text-gray-500">94,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers9.avif') }}" class="  w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 3 Colours</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Court Vision Low</p>
                            <p class="text-gray-500">74,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers3.avif') }}" class="  w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 1 Colour</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Air Zoom</p>
                            <p class="text-gray-500">159,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers11.avif') }}" class="  w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 2 Colours</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Zoom Fly</p>
                            <p class="text-gray-500">189,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers7.avif') }}" class="  w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 1 Colour</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Air Monarch</p>
                            <p class="text-gray-500">84,99 €</p>
                        </div>
                    </a>

                </div>
            </div>

            <div id="page-3" class="page">
                <div class="grid grid-cols-2 lg:grid-cols-3 ~gap-3/5">

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers5.avif') }}" class="  w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 2 Colours</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Waffle Debut</p>
                            <p class="text-gray-500">89,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers13.avif') }}" class="  w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 3 Colours</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Air Huarache</p>
                            <p class="text-gray-500">109,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers14.avif') }}" class="  w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 1 Colour</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Killshot 2</p>
                            <p class="text-gray-500">79,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers10.avif') }}" class="  w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 2 Colours</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Cortez</p>
                            <p class="text-gray-500">69,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers4.avif') }}" class="  w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 1 Colour</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Internationalist</p>
                            <p class="text-gray-500">94,99 €</p>
                        </div>
                    </a>

                    <a href="/product" class="block">
                        <div class="overflow-hidden bg-gray-100 aspect-square">
                            <img src="{{ asset('assets/sneakers/sneakers6.avif') }}" class="  w-full h-full object-cover">
                        </div>
                        <div class="mt-2 ~text-xs/sm">
                            <p class="text-gray-400 text-xs">Men's 4 Colours</p>
                            <p class="font-semibold text-gray-900 leading-tight">Nike Zoom Rival</p>
                            <p class="text-gray-500">119,99 €</p>
                        </div>
                    </a>

                </div>
            </div>


            <div class="pagination-wrap flex items-center justify-center ~gap-1/2 ~mt-8/12 ~mb-4/6">
                <a href="#page-1" class="pg border rounded-full border-gray-300 ~w-7/9 ~h-7/9 flex items-center justify-center ~text-xs/sm font-semibold hover:border-black transition-colors">1</a>
                <a href="#page-2" class="pg border rounded-full border-gray-300 ~w-7/9 ~h-7/9 flex items-center justify-center ~text-xs/sm font-semibold  hover:border-black transition-colors">2</a>
                <a href="#page-3" class="pg border rounded-full border-gray-300 ~w-7/9 ~h-7/9 flex items-center justify-center ~text-xs/sm font-semibold hover:border-black transition-colors">3</a>
                <a href="#page-2" class="pg border rounded-full border-gray-300 ~w-7/9 ~h-7/9 flex items-center justify-center ~text-xs/sm font-semibold hover:border-black transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

        </div>
    </div>
</main>
@endsection


