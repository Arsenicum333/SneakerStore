@extends('layouts.guest')

@section('title', 'Sign In')

@section('content')
<main>
<div class="flex flex-col items-start justify-start max-w-[500px] mx-auto min-h-screen px-6 pt-16 gap-8">

    <header>
      <h1 class="~text-2xl/3xl font-medium mb-4">
        Enter your email and password to sign in.
      </h1>

      <span class="text-gray-500 text-sm">Slovakia (Slovak Republic)</span>
    </header>

    <div class="w-full">

      <form action="{{ route('login') }}" method="POST" class="flex flex-col gap-7">
        @csrf
        @php
          $authRedirect = old('redirect', $redirectTarget ?? request('redirect'));
        @endphp
        @if (!empty($authRedirect))
          <input type="hidden" name="redirect" value="{{ $authRedirect }}">
        @endif

        @if($errors->any())
            <div class="p-4 rounded-lg bg-red-50 text-red-700 border border-red-200">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="relative">
          <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email*" class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg text-lg focus:border-black outline-none transition-all peer placeholder-transparent">
          <label for="email" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
            Email*
          </label>
        </div>

        <div class="relative">
          <input type="password" name="password" id="password" placeholder="Password*" class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg text-lg focus:border-black outline-none transition-all peer placeholder-transparent">
          <label for="password" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
            Password*
          </label>
        </div>

        <p class="text-sm text-gray-500 leading-relaxed">
            By continuing, I agree to Iken's
            <a href="#" class="underline font-medium">Terms of Use</a>
            and
            <a href="#" class="underline font-medium">Privacy Policy</a>.
        </p>

        <div class="flex justify-center">
          <button type="submit" class="w-full bg-black text-white px-6 ~py-4/3 rounded-full font-medium hover:bg-zinc-800 transition-colors duration-200">
            Sign In
          </button>
        </div>

        <p class="text-sm text-gray-500 text-center">
          Don&apos;t have an account?
          <a
            href="{{ route('register', !empty($authRedirect) ? ['redirect' => $authRedirect] : []) }}"
            class="underline font-medium text-gray-700 hover:text-black"
          >
            Join Us
          </a>
        </p>
      </form>

    </div>

  </div>
</main>
@endsection
