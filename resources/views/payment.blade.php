@extends('layouts.app')

@section('title', 'Payment')

@section('content')
<input type="checkbox" id="success-overlay" class="peer hidden">
<main class="max-w-[1200px] mx-auto ~p-4/6 ~mt-4/8">
        <div class="flex flex-col lg:flex-row ~gap-8/16">
            <div class="flex-1 flex flex-col ~gap-6/10">
                <div>
                    <h2 class="~text-lg/2xl font-bold text-gray-900 ~mb-3/5">Delivery</h2>
                    <div class="flex flex-col ~gap-2/3">
                        <div class="relative">
                        <input type="email" id="email" placeholder="Email*" class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                        <label for="email" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                            Email*
                        </label>
                        </div>
                    <p class="~text-xs/sm text-gray-400">Enter your name and address</p>
                    <div class="relative flex-1">
                        <input type="text" id="firstName" placeholder="Last Name*"
                            class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                        <label for="firstName"
                            class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                            First Name*
                        </label>
                    </div>
                    <div class="relative flex-1">
                        <input type="text" id="lastName" placeholder="Last Name*"
                            class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                        <label for="lastName"
                            class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                            Last Name*
                        </label>
                    </div>
                    <div class="relative flex-1">
                        <input type="text" id="address" placeholder="Last Name*"
                            class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                        <label for="address"
                            class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                            Your Address*
                        </label>
                    </div>
                        <a href="#" class="~text-xs/sm text-gray-500 underline hover:text-gray-900">Enter your address manually</a>
                    <div class="relative flex-1">
                        <input type="text" id="phoneNumber" placeholder="Last Name*"
                            class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                        <label for="phoneNumber"
                            class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                            Your Phone Number*
                        </label>
                    </div>
                    </div>
                </div>

                <div>
                    <h2 class="~text-lg/2xl font-bold text-gray-900 ~mb-3/5">Shipping</h2>
                    <div class="flex flex-col ~gap-2/3">

                        <label class="flex items-center justify-between w-full border border-gray-200 rounded-md ~px-3/4 ~py-2/3 cursor-pointer hover:border-gray-900">
                            <div class="flex items-center ~gap-2/3">
                                <input type="radio" name="shipping" checked class="accent-gray-900 ~w-3/4 ~h-3/4">
                                <span class="~text-xs/sm text-gray-900 font-medium">Extra Fast</span>
                            </div>
                            <span class="~text-xs/sm text-gray-900 font-semibold">19,99 $</span>
                        </label>

                        <label class="flex items-center justify-between w-full border border-gray-200 rounded-md ~px-3/4 ~py-2/3 cursor-pointer hover:border-gray-900">
                            <div class="flex items-center ~gap-2/3">
                                <input type="radio" name="shipping" class="accent-gray-900 ~w-3/4 ~h-3/4">
                                <span class="~text-xs/sm text-gray-900 font-medium">Nova Poshta</span>
                            </div>
                            <span class="~text-xs/sm text-gray-500 font-semibold">Free</span>
                        </label>
                    </div>
                </div>

                <div>
                    <h2 class="~text-lg/2xl font-bold text-gray-900 ~mb-3/5">Payment</h2>
                    <div class="flex flex-col ~gap-2/3">

                        <label class="flex items-center ~gap-2/3 w-full border border-gray-200 rounded-md ~px-3/4 ~py-2/3 cursor-pointer hover:border-gray-900">
                            <input type="radio" name="payment" checked class="accent-gray-900 ~w-3/4 ~h-3/4">
                            <img src="{{ asset('assets/lucide/credit-card.svg') }}" class="~w-4/5 ~h-4/5">
                            <span class="~text-xs/sm text-gray-900 font-medium">Credit or Debit Card</span>
                        </label>

                        <label class="flex items-center ~gap-2/3 w-full border border-gray-200 rounded-md ~px-3/4 ~py-2/3 cursor-pointer hover:border-gray-900">
                            <input type="radio" name="payment" class="accent-gray-900 ~w-3/4 ~h-3/4">
                            <span class="~text-xs/sm text-gray-900 font-medium">PayPal</span>
                        </label>

                        <label class="flex items-center ~gap-2/3 w-full border border-gray-200 rounded-md ~px-3/4 ~py-2/3 cursor-pointer hover:border-gray-900">
                            <input type="radio" name="payment" class="accent-gray-900 ~w-3/4 ~h-3/4">
                            <span class="~text-xs/sm text-gray-900 font-medium">Google Pay</span>
                        </label>

                        <p class="~text-xs/sm text-gray-400 ~mt-1/2">Enter your payment details</p>

                        <div class="relative flex-1">
                            <input type="text" id="lastName" placeholder="Last Name*"
                                class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                            <label for="lastName"
                                class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                                Name ob Card*
                            </label>
                        </div>
                        <div class="relative flex-1">
                            <input type="text" id="lastName" placeholder="Last Name*"
                                class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                            <label for="lastName"
                                class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                                Card Number*
                            </label>
                        </div>

                        <div class="flex ~gap-2/3">
                            <div class="relative flex-1 w-1/2">
                                <input type="text" id="lastName" placeholder="Last Name*"
                                    class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                                <label for="lastName"
                                    class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                                    MM/YY*
                                </label>
                            </div>
                            <div class="relative flex-1 w-1/2">
                                <input type="text" id="lastName" placeholder="Last Name*"
                                    class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                                <label for="lastName"
                                    class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">
                                    Security Code*
                                </label>
                            </div>
                        </div>

                        <label for="success-overlay" class="flex justify-center bg-black hover:bg-zinc-800 transition-colors duration-200 text-white font-semibold ~text-xs/sm ~py-3/4 rounded-full ~mt-2/4 cursor-pointer">
                            Pay Now
                        </label>
                    </div>

                </div>
            </div>

            <div class="lg:w-80 flex-shrink-0">
                <h2 class="~text-lg/2xl font-bold text-gray-900 ~mb-3/5">Order Summary</h2>
                <div class="flex justify-between ~text-xs/sm text-gray-700 ~mb-1/2">
                    <span>Subtotal</span>
                    <span>200,98 $</span>
                </div>
                <div class="flex justify-between ~text-xs/sm text-gray-500 ~mb-3/5">
                    <span>Estimated Delivery & Handling</span>
                    <span>Free</span>
                </div>

                <hr class="border-gray-200 ~mb-3/5">

                <div class="flex justify-between ~text-xs/sm font-bold text-gray-900 ~mb-5/8">
                    <span>Total</span>
                    <span>200,98 $</span>
                </div>

                <hr class="border-gray-200 ~mb-4/6">

                <div class="flex flex-col ~gap-3/5">

                    <div class="flex ~gap-3/4">
                        <div class="bg-gray-100 rounded-md flex-shrink-0">
                            <img src="{{ asset('assets/sneakers/sneakers1.avif') }}" class="~w-16/40 ~h-16/40 block">
                        </div>
                        <div class="flex flex-col ~gap-0.5/1">
                            <p class="~text-xs/sm font-semibold text-gray-900 leading-tight">Nike Air Force 1 '07 LV8</p>
                            <p class="text-xs text-gray-400">Men's 1 Colour</p>
                            <p class="text-xs text-gray-400">Flare Colyne/Metallic Silver</p>
                            <p class="text-xs text-gray-400">Size 43</p>
                            <p class="~text-xs/sm font-semibold text-gray-900">100,99 $</p>
                        </div>
                    </div>

                    <div class="flex ~gap-3/4">
                        <div class="bg-gray-100 rounded-md flex-shrink-0 ~w-16/40 ~h-16/40">
                            <img src="{{ asset('assets/sneakers/sneakers12.avif') }}" class="~w-16/40 ~h-16/40 block">
                        </div>
                        <div class="flex flex-col ~gap-0.5/1">
                            <p class="~text-xs/sm font-semibold text-gray-900 leading-tight">Nike Air Max 10 Big Bubble</p>
                            <p class="text-xs text-gray-400">Men's 1 Colour</p>
                            <p class="text-xs text-gray-400">Size 43</p>
                            <p class="~text-xs/sm font-semibold text-gray-900">99,99 $</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </main>

    <div class="hidden peer-checked:flex fixed inset-0 z-50 items-center justify-center bg-black/60 px-4">
        <div class="w-full max-w-md rounded-2xl bg-white p-8 text-center shadow-2xl">
            <h3 class="~text-lg/2xl font-bold text-gray-900">Payment successful</h3>
            <p class="mt-3 text-gray-500">Your order has been placed successfully.</p>
            <div class="mt-6">
                <a href="/" class="inline-flex cursor-pointer items-center justify-center rounded-full bg-black px-6 py-3 font-semibold text-white hover:bg-zinc-800 transition-colors duration-200">
                    Close
                </a>
            </div>
        </div>
    </div>
@endsection
