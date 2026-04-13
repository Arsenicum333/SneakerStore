@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<main class="max-w-[1200px] mx-auto ~mt-4/8 ~p-4/6">
    @php
        $user = auth()->user();
    @endphp

        <div class="flex flex-col lg:flex-row ~gap-8/16">
            <div class="flex-1 flex flex-col ~gap-4/6">
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
                        <p class="~text-lg/2xl font-bold text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</p>
                        <p class="~text-xs/sm text-gray-400">Iken Member Since {{ $user->created_at?->format('F Y') }}</p>
                    </div>
                </div>

                <div class="border-b-2 border-gray-200 pb-5">
                    <div class="flex items-center justify-between ">
                        <div class="flex items-center ~gap-2/3">
                            <img src="{{ asset('assets/lucide/letter.svg') }}" class="~w-4/5 ~h-4/5 block">
                            <span class="~text-xs/sm text-gray-700">{{ $user->email }}</span>
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
                            <img src="{{ asset('assets/lucide/map.svg') }}" class="~w-4/5 ~h-4/5 block">
                            <span class="~text-xs/sm text-gray-700">Vinohradiv, Maliovnica str.</span>
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

                 <div class="border-b-2 border-gray-200 pb-5">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center ~gap-2/3">
                                <img src="{{ asset('assets/lucide/calender.svg') }}" class="~w-4/5 ~h-4/5 block">
                                    <span class="~text-xs/sm text-gray-700">{{ $user->date_of_birth?->format('Y - m - d') }}</span>
                            </div>
                            <a href="#" class="~text-xs/sm text-gray-700 font-medium flex items-center gap-0.5 hover:text-gray-900">
                                Edit
                                <img src="{{ asset('assets/lucide/chevron-right.svg') }}" class="~w-4/5 ~h-4/5 block">
                            </a>
                        </div>
                 </div>
                 <form action="{{ route('logout.perform') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-black text-white px-6 ~py-4/3 rounded-full font-medium hover:bg-zinc-800 transition-colors duration-200">
                        Log Out
                    </button>
                </form>
            </div>

            <div class="lg:w-80 flex-shrink-0">
                <div class="~mb-5/8">
                    <h1 class="~text-xl/3xl font-semibold text-gray-900">My orders</h1>
                </div>

                <div class="flex flex-col ~gap-4/8">
                    <div class="flex flex-row ~gap-3/5">
                        <div class="bg-gray-100 rounded-md flex-shrink-0">
                                <img src="{{ asset('assets/sneakers/sneakers1.avif') }}" class="~w-16/40 ~h-16/40 block rounded-md">
                        </div>
                        <div class="flex flex-col ~gap-0.5/1">
                                <div class="flex flex-col ~gap-0.5/1">
                                    <h2 class="font-semibold text-base">Nike Air Force 1 '07 LV8</h2>
                                    <p class="text-gray-500 text-base font-semibold">$119,99</p>
                                </div>
                                <div class="flex flex-col gap-0.5">
                                    <p class="text-red-500 text-sm">On the way</p>
                                    <p class="text-gray-500 text-sm">10 march, 2026</p>
                                    <p class="text-gray-500 text-sm">№544672</p>
                                </div>
                        </div>
                    </div>

                     <div class="flex flex-row ~gap-3/5">
                        <div class="bg-gray-100 rounded-md flex-shrink-0">
                                <img src="{{ asset('assets/sneakers/sneakers4.avif') }}" class="~w-16/40 ~h-16/40 block rounded-md">
                        </div>
                        <div class="flex flex-col ~gap-0.5/1">
                                <div class="flex flex-col ~gap-0.5/1">
                                    <h2 class="font-semibold text-base">Nike Air Force 1 '07 LV8</h2>
                                    <p class="text-gray-500 text-base font-semibold">$119,99</p>
                                </div>
                                <div class="flex flex-col gap-0.5">
                                    <p class="text-green-500 text-sm">Delivered</p>
                                    <p class="text-gray-500 text-sm">10 march, 2026</p>
                                    <p class="text-gray-500 text-sm">№544672</p>
                                </div>
                        </div>
                    </div>

                    <div class="flex flex-row ~gap-3/5">
                        <div class="bg-gray-100 rounded-md flex-shrink-0">
                                <img src="{{ asset('assets/sneakers/sneakers11.avif') }}" class="~w-16/40 ~h-16/40 block rounded-md">
                        </div>
                        <div class="flex flex-col ~gap-0.5/1">
                            <div class="flex flex-col ~gap-0.5/1">
                                <h2 class="font-semibold text-base">Nike Air Force 1 '07 LV8</h2>
                                <p class="text-gray-500 text-base font-semibold">$119,99</p>
                            </div>
                            <div class="flex flex-col gap-0.5">
                                <p class="text-green-500 text-sm">Delivered</p>
                                <p class="text-gray-500 text-sm">10 march, 2026</p>
                                <p class="text-gray-500 text-sm">№544672</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

