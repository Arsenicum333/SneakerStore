@extends('layouts.app')

@section('title', 'Help')

@section('content')
<main>
<div class="max-w-[1200px] mx-auto ~px-4/6 ~py-8/12 mt-5">

        <h1 class="~text-2xl/4xl font-bold ~mb-1/3 px-4">Quick Assists</h1>
        <h2 class="~text-base/xl font-normal ~mb-3/6 px-4 ~pb-4/6">Answers to our most frequently asked questions.</h2>
        <hr class="border-t-1 md:border-t-2 border-gray-300">

        <div class="grid grid-cols-1 md:grid-cols-3 ~gap-4/8 ~py-4/6">

            <div class="bg-gray-50 ~p-4/6 rounded-lg">
                <h2 class="text-2xl font-bold mb-4">Returns</h2>
                <div class="space-y-4 text-gray-600">
                    <div>
                        <p class="font-semibold">What is Iken's returns policy?</p>
                        <p class="text-sm">You can return any unused item within 30 days of delivery. The product must be in its original condition, with all tags and packaging included. Refunds are issued after the returned item is inspected.</p>
                    </div>
                    <div>
                        <p class="font-semibold">How do I return my Iken order?</p>
                        <p class="text-sm">To return an item, go to Your Orders, select the product you want to return, and follow the return instructions. Once your request is approved, you will receive return shipping details.</p>
                    </div>
                    <div>
                        <p class="font-semibold">Where is my refund?</p>
                        <p class="text-sm">Refunds are processed after we receive and inspect the returned item. It usually takes 5–10 business days for the refund to appear in your account depending on your payment provider.</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 p-6 rounded-lg">
                <h2 class="text-2xl font-bold mb-4">Orders & Payment</h2>
                <div class="space-y-4 text-gray-600">
                    <div>
                        <p class="font-semibold">Where is my Iken order?</p>
                        <p class="text-sm">After placing your order, you can track its status in Your Orders. Once shipped, you will receive a tracking number via email.</p>
                    </div>
                    <div>
                        <p class="font-semibold">Can I cancel or change my Iken order?</p>
                        <p class="text-sm">Orders can be canceled or modified before they are shipped. If your order has already been dispatched, you will need to return the item after delivery.</p>
                    </div>
                    <div>
                        <p class="font-semibold">What are Iken's payment options?</p>
                        <p class="text-sm">We accept major credit and debit cards, as well as popular online payment methods such as PayPal or Apple Pay (depending on your region).</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 p-6 rounded-lg">
                <h2 class="text-2xl font-bold mb-4">Dispatch & Delivery</h2>
                <div class="space-y-4 text-gray-600">
                    <div>
                        <p class="font-semibold">What are Iken's delivery options?</p>
                        <p class="text-sm">We offer standard and express shipping. Delivery times and prices may vary depending on your location.</p>
                    </div>
                    <div>
                        <p class="font-semibold">How do I get free delivery on Iken orders?</p>
                        <p class="text-sm">Free delivery is available for orders over a certain amount. You may also receive free shipping during special promotions or as part of a membership program.</p>
                    </div>
                    <div>
                        <p class="font-semibold">Can my Iken order be dispatched internationally?</p>
                        <p class="text-sm">Yes, we ship to many countries worldwide. Shipping costs and delivery times depend on the destination.</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 p-6 rounded-lg">
                <h2 class="text-2xl font-bold mb-4">Shopping</h2>
                <div class="space-y-4 text-gray-600">
                    <div>
                        <p class="font-semibold">How do I find the right size and fit?</p>
                        <p class="text-sm">Each product page includes a size guide to help you choose the correct size. If you are unsure, we recommend comparing the measurements with a pair of shoes you already own.</p>
                    </div>
                    <div>
                        <p class="font-semibold">Does Iken offer product advice?</p>
                        <p class="text-sm">Yes, our product pages include detailed descriptions, materials, and recommendations. You can also contact customer support for personalized advice.</p>
                    </div>
                    <div>
                        <p class="font-semibold">How do I use an Iken promo code?</p>
                        <p class="text-sm">Enter your promo code at checkout in the promo code field. The discount will be applied automatically if the code is valid.</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 p-6 rounded-lg">
                <h2 class="text-2xl font-bold mb-4">Iken Membership & Apps</h2>
                <div class="space-y-4 text-gray-600">
                    <div>
                        <p class="font-semibold">What is Iken Membership?</p>
                        <p class="text-sm">Iken Membership is a free program that provides members with exclusive offers, early access to new releases, and special promotions.</p>
                    </div>
                    <div>
                        <p class="font-semibold">How do I get Iken's newest sneaker releases?</p>
                        <p class="text-sm">Members receive notifications about new sneaker drops and limited releases through email or the mobile app.</p>
                    </div>
                    <div>
                        <p class="font-semibold">What are the birthday promo terms and conditions?</p>
                        <p class="text-sm">Members may receive a birthday discount code during their birthday month. The offer is valid for a limited time and may apply only to selected products.</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 p-6 rounded-lg">
                <h2 class="text-2xl font-bold mb-4">Company Info</h2>
                <div class="space-y-4 text-gray-600">
                    <div>
                        <p class="font-semibold">Do Iken shoes have a warranty?</p>
                        <p class="text-sm">Yes, all products are covered by a limited warranty against manufacturing defects. Normal wear and tear is not covered.</p>
                    </div>
                    <div>
                        <p class="font-semibold">What is the Iken By You personalisation policy?</p>
                        <p class="text-sm">Personalized products are made specifically for you and cannot be returned or exchanged, unless there is a manufacturing defect.</p>
                    </div>
                    <div>
                        <p class="font-semibold">Where can I learn more about Iken, Inc.?</p>
                        <p class="text-sm">You can learn more about our company on the About Us page, where we share our story, mission, and values.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection


