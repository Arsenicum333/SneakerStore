@extends('layouts.app')

@section('title', 'Payment')

@section('content')
<main class="max-w-[1200px] mx-auto ~px-4/6">
    @if (session('payment_success'))
        <div class="mb-6 rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
            <h2 class="text-lg font-bold text-gray-900">Payment successful</h2>
            <p class="mt-2 text-sm text-gray-500">Your order #{{ session('payment_order_id') }} has been placed successfully.</p>
            <p class="mt-1 text-sm text-gray-500">Total paid: {{ number_format((float) session('payment_total', 0), 2, ',', ' ') }} $</p>
            <div class="mt-5 flex flex-wrap gap-3">
                <a href="{{ route('catalog') }}" class="inline-flex items-center justify-center rounded-full bg-black px-6 py-3 font-semibold text-white hover:bg-zinc-800 transition-colors duration-200">Continue shopping</a>
                <a href="{{ route('bag') }}" class="inline-flex items-center justify-center rounded-full border border-gray-300 px-6 py-3 font-semibold text-gray-900 hover:border-gray-900 transition-colors duration-200">Back to bag</a>
            </div>
        </div>
    @elseif (count($items) === 0)
        <div class="rounded-2xl border border-gray-200 p-8 text-center">
            <h2 class="text-2xl font-bold text-gray-900">Your bag is empty</h2>
            <p class="mt-3 text-gray-500">Add products to your bag before going to payment.</p>
            <a href="{{ route('catalog') }}" class="inline-flex mt-6 items-center justify-center rounded-full bg-black px-6 py-3 font-semibold text-white hover:bg-zinc-800 transition-colors duration-200">Go to Catalog</a>
        </div>
    @else
        <form method="POST" action="{{ route('payment.perform') }}">
            @csrf
            <div class="flex flex-col lg:flex-row ~gap-8/16">
                <div class="flex-1 flex flex-col ~gap-6/10">
                    @if (! $isAuthenticated)
                        <div class="rounded-2xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-900">
                            You can review the order here, but you need to sign in before placing it.
                            <a href="{{ route('login', ['redirect' => route('payment')]) }}" class="font-semibold underline underline-offset-4">Sign in</a>
                        </div>
                    @endif

                    <div>
                        <h2 class="~text-lg/2xl font-bold text-gray-900 ~mb-3/5">Delivery</h2>
                        <div class="flex flex-col ~gap-3/4">
                            <div class="relative">
                                <input type="email" name="email" value="{{ auth()->user()?->email ?? old('email') }}" placeholder="Email*" class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                                <label for="email" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">Email*</label>
                                @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div class="relative flex-1">
                                <input type="text" name="first_name" value="{{ old('first_name', auth()->user()?->first_name ?? '') }}" placeholder="First Name*" class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                                <label for="first_name" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">First Name*</label>
                                @error('first_name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div class="relative flex-1">
                                <input type="text" name="last_name" value="{{ old('last_name', auth()->user()?->last_name ?? '') }}" placeholder="Last Name*" class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                                <label for="last_name" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">Last Name*</label>
                                @error('last_name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div class="relative flex-1">
                                <input type="text" name="address" value="{{ old('address', auth()->user()?->address ?? '') }}" placeholder="Your Address*" class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                                <label for="address" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">Your Address*</label>
                                @error('address')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div class="relative flex-1">
                                <input type="text" name="phone_number" value="{{ old('phone_number') }}" placeholder="Your Phone Number*" class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                                <label for="phone_number" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">Your Phone Number*</label>
                                @error('phone_number')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <div>
                        <h2 class="~text-lg/2xl font-bold text-gray-900 ~mb-3/5">Shipping</h2>
                        <div class="flex flex-col ~gap-2/3">
                            <label class="flex items-center justify-between w-full border border-gray-200 rounded-md ~px-3/4 ~py-2/3 cursor-pointer hover:border-gray-900">
                                <div class="flex items-center ~gap-2/3">
                                    <input type="radio" name="shipping_method" value="extra_fast" {{ old('shipping_method', 'extra_fast') === 'extra_fast' ? 'checked' : '' }} class="accent-gray-900 ~w-3/4 ~h-3/4" data-shipping-fee="19.99">
                                    <span class="~text-xs/sm text-gray-900 font-medium">Extra Fast</span>
                                </div>
                                <span class="~text-xs/sm text-gray-900 font-semibold">19,99 $</span>
                            </label>

                            <label class="flex items-center justify-between w-full border border-gray-200 rounded-md ~px-3/4 ~py-2/3 cursor-pointer hover:border-gray-900">
                                <div class="flex items-center ~gap-2/3">
                                    <input type="radio" name="shipping_method" value="nova_poshta" {{ old('shipping_method') === 'nova_poshta' ? 'checked' : '' }} class="accent-gray-900 ~w-3/4 ~h-3/4" data-shipping-fee="0">
                                    <span class="~text-xs/sm text-gray-900 font-medium">Nova Poshta</span>
                                </div>
                                <span class="~text-xs/sm text-gray-500 font-semibold">Free</span>
                            </label>
                            @error('shipping_method')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div>
                        <h2 class="~text-lg/2xl font-bold text-gray-900 ~mb-3/5">Payment</h2>
                        <div class="flex flex-col ~gap-2/3">
                            <label class="flex items-center ~gap-2/3 w-full border border-gray-200 rounded-md ~px-3/4 ~py-2/3 cursor-pointer hover:border-gray-900">
                                <input type="radio" name="payment_method" value="card" {{ old('payment_method', 'card') === 'card' ? 'checked' : '' }} class="accent-gray-900 ~w-3/4 ~h-3/4">
                                <img src="{{ asset('assets/lucide/credit-card.svg') }}" class="~w-4/5 ~h-4/5" alt="Card">
                                <span class="~text-xs/sm text-gray-900 font-medium">Credit or Debit Card</span>
                            </label>

                            <label class="flex items-center ~gap-2/3 w-full border border-gray-200 rounded-md ~px-3/4 ~py-2/3 cursor-pointer hover:border-gray-900">
                                <input type="radio" name="payment_method" value="paypal" {{ old('payment_method') === 'paypal' ? 'checked' : '' }} class="accent-gray-900 ~w-3/4 ~h-3/4">
                                <span class="~text-xs/sm text-gray-900 font-medium">PayPal</span>
                            </label>

                            <label class="flex items-center ~gap-2/3 w-full border border-gray-200 rounded-md ~px-3/4 ~py-2/3 cursor-pointer hover:border-gray-900">
                                <input type="radio" name="payment_method" value="google_pay" {{ old('payment_method') === 'google_pay' ? 'checked' : '' }} class="accent-gray-900 ~w-3/4 ~h-3/4">
                                <span class="~text-xs/sm text-gray-900 font-medium">Google Pay</span>
                            </label>
                            @error('payment_method')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror

                            <p class="~text-xs/sm text-gray-400 ~mt-1/2">Enter your payment details</p>

                            <div class="relative flex-1">
                                <input type="text" name="card_name" value="{{ old('card_name') }}" placeholder="Name on Card*" class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                                <label for="card_name" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">Name on Card*</label>
                                @error('card_name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div class="relative flex-1">
                                <input type="text" name="card_number" value="{{ old('card_number') }}" placeholder="Card Number*" class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                                <label for="card_number" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">Card Number*</label>
                                @error('card_number')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <div class="flex ~gap-2/3">
                                <div class="relative flex-1 w-1/2">
                                    <input type="text" name="card_expiry" value="{{ old('card_expiry') }}" placeholder="MM/YY*" class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                                    <label for="card_expiry" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">MM/YY*</label>
                                    @error('card_expiry')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </div>
                                <div class="relative flex-1 w-1/2">
                                    <input type="text" name="card_cvv" value="{{ old('card_cvv') }}" placeholder="Security Code*" class="w-full px-4 ~py-3/3.5 border-2 border-gray-300 rounded-lg ~text-base/lg focus:border-black outline-none transition-all peer placeholder-transparent">
                                    <label for="card_cvv" class="absolute left-4 ~-top-2/2.5 bg-white px-1 text-xs text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:-top-2.5 peer-focus:text-xs">Security Code*</label>
                                    @error('card_cvv')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <button type="submit" class="flex justify-center bg-black hover:bg-zinc-800 transition-colors duration-200 text-white font-semibold ~text-xs/sm ~py-3/4 rounded-full ~mt-2/4 cursor-pointer {{ $isAuthenticated ? '' : 'opacity-50 cursor-not-allowed' }}" {{ $isAuthenticated ? '' : 'disabled' }}>
                                Pay Now
                            </button>
                        </div>
                    </div>
                </div>

                <div class="lg:w-80 flex-shrink-0">
                    <h2 class="~text-lg/2xl font-bold text-gray-900 ~mb-3/5">Order Summary</h2>
                    <div class="flex justify-between ~text-xs/sm text-gray-700 ~mb-1/2">
                        <span>Subtotal</span>
                        <span>{{ number_format($subtotal, 2, ',', ' ') }} $</span>
                    </div>
                    <div class="flex justify-between ~text-xs/sm text-gray-500 ~mb-3/5">
                        <span>Estimated Delivery & Handling</span>
                        <span id="shipping-fee-label">{{ number_format($shippingFee, 2, ',', ' ') }} $</span>
                    </div>

                    <hr class="border-gray-200 ~mb-3/5">

                    <div class="flex justify-between ~text-xs/sm font-bold text-gray-900 ~mb-5/8">
                        <span>Total</span>
                        <span id="payment-total-label">{{ number_format($subtotal + $shippingFee, 2, ',', ' ') }} $</span>
                    </div>

                    <hr class="border-gray-200 ~mb-4/6">

                    <div class="flex flex-col ~gap-3/5">
                        @foreach ($items as $item)
                            <div class="flex ~gap-3/4">
                                <div class="bg-gray-100 rounded-md flex-shrink-0 overflow-hidden">
                                    <img src="{{ asset($item['image_url']) }}" alt="{{ $item['product_name'] }}" class="~w-16/40 ~h-16/40 block object-cover">
                                </div>
                                <div class="flex flex-col ~gap-0.5/1">
                                    <p class="~text-xs/sm font-semibold text-gray-900 leading-tight">{{ $item['product_name'] }}</p>
                                    <p class="text-xs text-gray-400">{{ $item['gender'] }}'s {{ $item['sport'] }} Shoes</p>
                                    <p class="text-xs text-gray-400">{{ $item['color'] }}</p>
                                    <p class="text-xs text-gray-400">Size {{ $item['size'] }}</p>
                                    <p class="text-xs text-gray-400">Qty {{ $item['quantity'] }}</p>
                                    <p class="~text-xs/sm font-semibold text-gray-900">{{ number_format($item['line_total'], 2, ',', ' ') }} $</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </form>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const subtotal = {{ json_encode((float) $subtotal) }};
            const shippingFeeLabel = document.getElementById('shipping-fee-label');
            const totalLabel = document.getElementById('payment-total-label');
            const shippingInputs = document.querySelectorAll('input[name="shipping_method"]');

            if (!shippingFeeLabel || !totalLabel || shippingInputs.length === 0) {
                return;
            }

            const formatPrice = (value) => {
                return value
                    .toFixed(2)
                    .replace('.', ',')
                    + ' $';
            };

            const updateSummary = () => {
                const selected = document.querySelector('input[name="shipping_method"]:checked');
                const fee = selected ? Number.parseFloat(selected.dataset.shippingFee || '0') : 0;
                const normalizedFee = Number.isNaN(fee) ? 0 : fee;

                shippingFeeLabel.textContent = formatPrice(normalizedFee);
                totalLabel.textContent = formatPrice(subtotal + normalizedFee);
            };

            shippingInputs.forEach((input) => {
                input.addEventListener('change', updateSummary);
            });

            updateSummary();
        });
    </script>
@endsection
