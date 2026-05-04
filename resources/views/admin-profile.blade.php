@extends('layouts.app')

@section('title', 'Admin Profile')

@section('content')
<main class="max-w-[1000px] mx-auto ~px-4/6 ~mt-5/8">

    <div class="flex flex-col ~gap-6/10">
        <h1 class="~text-xl/3xl font-semibold">My profile</h1>

        <div class="flex items-center ~gap-3/5">
            <div class="~w-14/20 ~h-14/20 rounded-full bg-gray-200 flex-shrink-0"></div>
            <div>
                <p class="~text-lg/2xl font-bold text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</p>
                <p class="~text-xs/sm text-gray-400">Administrator</p>
            </div>
        </div>

        <div class="border-b-2 border-gray-200 pb-5">
            <div class="flex items-center ~gap-2/3">
                <img src="{{ asset('assets/lucide/letter.svg') }}" class="~w-4/5 ~h-4/5 block">
                <span class="~text-xs/sm text-gray-700">{{ $user->email }}</span>
            </div>
        </div>

        <div class="border-b-2 border-gray-200 pb-5">
            <div class="flex items-center ~gap-2/3">
                <img src="{{ asset('assets/lucide/lock.svg') }}" class="~w-4/5 ~h-4/5 block">
                <span class="~text-xs/sm text-gray-700 tracking-widest">••••••••</span>
            </div>
        </div>

        <div class="flex w-full ~gap-4/8">
            <a href="{{ route('admin.products.create') }}" class="w-1/2 border py-4 rounded-full font-semibold transition flex items-center justify-center gap-2 hover:border-black">
                Add Product
            </a>

            <a href="{{ route('admin.products') }}" class="w-1/2 border py-4 rounded-full font-semibold transition flex items-center justify-center gap-2 hover:border-black">
                All Products
            </a>
        </div>
        <form class="w-full" action="{{ route('logout.perform') }}" method="POST" class="w-1/2">
            @csrf
            <button type="submit" class="w-full bg-black text-white px-6 ~py-4/3 rounded-full font-medium hover:bg-zinc-800 transition-colors duration-200">
                Log Out
            </button>
        </form>
    </div>

</main>
@endsection