@extends('layouts.guest')

@section('title', 'Log Out')

@section('content')
<main>
<div class="flex flex-col items-start justify-start max-w-[500px] mx-auto min-h-screen px-6 pt-16 gap-8">

    <header>
      <h1 class="~text-2xl/3xl font-medium mb-1">
        Log out from your account.
      </h1>

      <span class="text-gray-500 ~text-xs/sm font-medium">@auth{{ Auth::user()->email }}@else Guest @endauth</span>
    </header>

    <div class="w-full">

      <form action="{{ route('logout.perform') }}" method="POST" class="flex flex-col gap-7">
        @csrf
        <div class="flex justify-center">
          <button type="submit" class="w-full bg-black text-white px-6 ~py-4/3 rounded-full font-medium hover:bg-zinc-800 transition-colors duration-200">
            Log Out
          </button>
        </div>
      </form>

    </div>

  </div>
</main>
@endsection


