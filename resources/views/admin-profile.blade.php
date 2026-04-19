@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<main class="max-w-[1000px] mx-auto ~mt-4/8 ~p-4/6">

        <div class="flex flex-col lg:flex-col ~gap-8/16">
            <h1 class="~text-xl/3xl font-semibold">My profile</h1>
            <div class="flex items-center ~gap-3/5">
                <div class="~w-14/20 ~h-14/20 rounded-full bg-gray-200 flex-shrink-0"></div>

                <div class="relative">
                    <button class="absolute -top-1 -right-5 text-gray-400 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                    </button>
                    <p class="~text-lg/2xl font-bold text-gray-900">Vitalii Diurd</p>
                    <p class="~text-xs/sm text-gray-400">Administrator</p>
                </div>
            </div>

            <div class="border-b-2 border-gray-200 pb-5">
                <div class="flex items-center justify-between ">
                    <div class="flex items-center ~gap-2/3">
                        <img src="{{ asset('assets/lucide/letter.svg') }}" class="~w-4/5 ~h-4/5 block">
                        <span class="~text-xs/sm text-gray-700">youremail@gmail.com</span>
                    </div>
                    <a href="#" class="~text-xs/sm text-gray-700 font-medium flex items-center gap-0.5 hover:text-gray-900">
                        Edit
                            <img src="{{ asset('assets/lucide/chevron-right.svg') }}" class="~w-4/5 ~h-4/5 block">
                    </a>
                </div>
            </div>

            <div class="border-b-2 border-gray-200 pb-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center ~gap-2/3">
                        <img src="{{ asset('assets/lucide/lock.svg') }}" class="~w-4/5 ~h-4/5 block">
                        <span class="~text-xs/sm text-gray-700 tracking-widest">••••••••</span>
                    </div>
                    <a href="#" class="~text-xs/sm text-gray-700 font-medium flex items-center gap-0.5 hover:text-gray-900">
                        Edit
                        <img src="{{ asset('assets/lucide/chevron-right.svg') }}" class="~w-4/5 ~h-4/5 block">
                    </a>
                </div>
            </div>

            <div class="flex w-full ~gap-4/8">
                <a href="/admin/products/create" class="w-1/2 border py-4 rounded-full font-semibold transition flex items-center justify-center gap-2 hover:border-black">
                    Add Product
                </a>

                <button type="submit" class="w-1/2 bg-black text-white px-6 ~py-4/3 rounded-full font-medium hover:bg-zinc-800 transition-colors duration-200">
                    Log Out
                </button>
            </div>
        </div>

    </main>
@endsection
