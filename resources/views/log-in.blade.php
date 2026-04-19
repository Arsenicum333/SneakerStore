@extends('layouts.guest')

@section('title', 'Log In')

@section('content')
<main>
<div class="flex flex-col items-start justify-start max-w-[500px] mx-auto min-h-screen px-8 py-16 gap-8">

    <header>
      <h1 class="~text-2xl/3xl font-medium mb-/4">
        Now let's make you an Iken Member.
      </h1>
    </header>

    <div class="w-full">

      <form action="{{ route('register') }}" method="POST" class="flex flex-col gap-7">
        @csrf

        @if($errors->any())
            <div class="p-4 rounded-lg bg-red-50 text-red-700 border border-red-200">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="relative">
          <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email*" class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
          <label for="email" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
            Email*
          </label>
        </div>

        <div class="relative">
          <input type="password" name="password" id="password" placeholder="Password*" class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
          <label for="password" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
            Password*
          </label>
        </div>

        <div class="relative">
          <input type="password" name="password_confirmation" id="confirm-password" placeholder="Confirm Password*" class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
          <label for="confirm-password" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
            Confirm Password*
          </label>
        </div>

        <div class="flex gap-4 w-full">

            <div class="relative flex-1">
                <input type="text" name="first_name" id="firstName" value="{{ old('first_name') }}" placeholder="First Name*"
                    class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                <label for="firstName"
                    class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                First Name*
                </label>
            </div>

            <div class="relative flex-1">
                <input type="text" name="last_name" id="lastName" value="{{ old('last_name') }}" placeholder="Last Name*"
                    class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                <label for="lastName"
                    class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                Last Name*
                </label>
            </div>

        </div>

        <div>

            <p class="~text-sm/base font-medium text-gray-500 mb-3">
                Date of Birth
            </p>

            <div class="flex gap-4 w-full">

                <div class="relative flex-1">
                    <input type="number" name="dob_day" id="Day" min="1" max="31" value="{{ old('dob_day') }}" placeholder="Day*"
                        class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg text-center focus:border-black outline-none transition-all peer placeholder-transparent">
                    <label for="Day"
                        class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                        Day*
                    </label>
                </div>

                <div class="relative flex-1">
                    <input type="number" name="dob_month" id="Month" min="1" max="12" value="{{ old('dob_month') }}" placeholder="Month*"
                        class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg text-center focus:border-black outline-none transition-all peer placeholder-transparent">
                    <label for="Month"
                        class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                        Month*
                    </label>
                </div>

                <div class="relative flex-1">
                    <input type="number" name="dob_year" id="Year" min="1900" max="2026" value="{{ old('dob_year') }}" placeholder="Year*"
                        class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg text-center focus:border-black outline-none transition-all peer placeholder-transparent">
                    <label for="Year"
                        class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                        Year*
                    </label>
                </div>

            </div>

        </div>

        <style>
            .custom-checkbox:checked + .checkbox-visual {
                background-color: black;
                border-color: black;
            }

            .custom-checkbox:checked + .checkbox-visual .check-mark {
                display: block !important;
            }
        </style>

        <label class="flex items-start gap-3 cursor-pointer group py-2">
            <input type="checkbox" class="custom-checkbox hidden">

            <div class="checkbox-visual w-5 h-5 shrink-0 mt-0.5 border-2 border-gray-300 rounded flex items-center justify-center transition-all">
                <span class="check-mark hidden text-white text-[12px] font-bold leading-none select-none">
                    &#10003;
                </span>
            </div>

            <p class="text-sm text-gray-500 leading-relaxed">
                I agree to Iken's
                <a href="#" class="underline font-medium">Terms of Use</a>
                and
                <a href="#" class="underline font-medium">Privacy Policy</a>.
            </p>
        </label>

        <div class="flex justify-center">
          <button type="submit" class="w-full bg-black text-white px-6 ~py-4/3 rounded-full font-medium hover:bg-zinc-800 transition-colors duration-200">
            Create Account
          </button>
        </div>
      </form>

    </div>

  </div>
</main>
@endsection
