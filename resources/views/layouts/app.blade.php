<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SneakerStore')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .search-input {
            width: 100px;
            transition: width 0.3s ease;
        }
        .search-input:focus {
            width: 220px !important;
        }
        .search-input[value]:not([value=""]) {
            width: 220px;
        }

        .size-button {
            transition: all 0.2s ease;
        }
        .size-button:hover {
            transform: scale(1.05);
            border-color: #000;
        }
        .size-checkbox:checked + .size-button {
            background-color: #000;
            color: #fff;
            border-color: #000;
        }
    </style>
</head>

<body class="bg-white min-h-screen">

    <header class="w-full">
        <!-- Top bar -->
        <div class="bg-gray-100 flex items-center justify-end ~px-4/6 ~py-1/2 text-xs">
            <div class="flex ~gap-2/3 font-bold">
                <a href="/help" class="hover:underline">Help</a>
                <span class="text-black">|</span>
                @auth
                    <a href="{{ route('profile') }}" class="hover:underline">Profile</a>
                    <span class="text-black">|</span>
                    <form action="{{ route('logout.perform') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="hover:underline">Logout</button>
                    </form>
                @else
                    <a href="{{ route('register') }}" class="hover:underline">Join Us</a>
                    <span class="text-black">|</span>
                    <a href="{{ route('login') }}" class="hover:underline">Sign In</a>
                @endauth
            </div>
        </div>

        <!-- Main nav bar -->
        <div class="relative w-full bg-white flex items-center ~px-3/6 ~h-10/20">

            <!-- Hamburger button (mobile only) -->
            <button id="mobile-menu-btn" class="md:hidden p-2 -ml-1 rounded-full hover:bg-gray-100 mr-auto" aria-label="Open menu" aria-expanded="false">
                <svg id="icon-menu" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="18" y2="18"/>
                </svg>
                <svg id="icon-close" class="hidden" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18"/><path d="m6 6 12 12"/>
                </svg>
            </button>

            <!-- Desktop: left spacer -->
            <div class="hidden md:block flex-1"></div>

            <!-- Desktop nav links -->
            <div class="hidden md:flex ~gap-2/5 font-semibold ~text-sm/base">
                <a href="/"
                   class="hover:border-b-2 hover:border-gray-400 border-b-2 {{ request()->routeIs('home') ? 'border-black' : 'border-transparent' }}">
                    New
                </a>
                <a href="{{ route('catalog') }}"
                   class="hover:border-b-2 hover:border-gray-400 border-b-2 {{ request()->routeIs('catalog') && !request('gender') && !request('sport') && !request('sport_not') ? 'border-black' : 'border-transparent' }}">
                    All
                </a>
                <a href="{{ route('catalog', ['gender' => 'Men']) }}"
                   class="hover:border-b-2 hover:border-gray-400 border-b-2 {{ request('gender') == 'Men' ? 'border-black' : 'border-transparent' }}">
                    Men
                </a>
                <a href="{{ route('catalog', ['gender' => 'Women']) }}"
                   class="hover:border-b-2 hover:border-gray-400 border-b-2 {{ request('gender') == 'Women' ? 'border-black' : 'border-transparent' }}">
                    Women
                </a>
                <a href="{{ route('catalog', ['sport_not' => 'Lifestyle']) }}"
                   class="hover:border-b-2 hover:border-gray-400 border-b-2 {{ request('sport_not') == 'Lifestyle' ? 'border-black' : 'border-transparent' }}">
                    Sport
                </a>
            </div>

            <!-- Right: desktop search + icons -->
            <div class="flex-1 flex items-center justify-end ~gap-1/3">
                <!-- Search (desktop only) -->
                <form method="GET" action="{{ route('catalog') }}" class="hidden md:flex rounded-full bg-gray-100 ~h-5/10 items-center ~pl-2/3 ~gap-1/2">
                    <div class="flex items-center justify-center">
                        <img src="{{ asset('assets/lucide/search.svg') }}" class="~w-4/5 ~h-4/5 block">
                    </div>
                    <input type="text" name="search" placeholder="Search" value="{{ request('search') }}" class="search-input outline-none ~text-sm/base text-gray-500 font-semibold bg-transparent">
                    @if(request('search'))
                        <a href="{{ route('catalog') }}" class="mr-2 text-gray-400 hover:text-gray-600">✕</a>
                    @endif
                </form>

                <a href="/favourites" class="hover:bg-gray-300 p-2 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"/>
                    </svg>
                </a>

                <a href="/bag" class="hover:bg-gray-300 p-2 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2.048 18.566A2 2 0 0 0 4 21h16a2 2 0 0 0 1.952-2.434l-2-9A2 2 0 0 0 18 8H6a2 2 0 0 0-1.952 1.566z"/>
                        <path d="M8 11V6a4 4 0 0 1 8 0v5"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Mobile menu (hidden by default, shown when hamburger is toggled) -->
        <nav id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 ~px-4/6 py-5 flex flex-col gap-1">
            <a href="/" class="font-semibold text-base py-2 border-b border-gray-100 {{ request()->routeIs('home') ? 'text-black' : 'text-gray-600' }} hover:text-black">New</a>
            <a href="{{ route('catalog') }}" class="font-semibold text-base py-2 border-b border-gray-100 {{ request()->routeIs('catalog') && !request('gender') && !request('sport') && !request('sport_not') ? 'text-black' : 'text-gray-600' }} hover:text-black">All</a>
            <a href="{{ route('catalog', ['gender' => 'Men']) }}" class="font-semibold text-base py-2 border-b border-gray-100 {{ request('gender') == 'Men' ? 'text-black' : 'text-gray-600' }} hover:text-black">Men</a>
            <a href="{{ route('catalog', ['gender' => 'Women']) }}" class="font-semibold text-base py-2 border-b border-gray-100 {{ request('gender') == 'Women' ? 'text-black' : 'text-gray-600' }} hover:text-black">Women</a>
            <a href="{{ route('catalog', ['sport_not' => 'Lifestyle']) }}" class="font-semibold text-base py-2 border-b border-gray-100 {{ request('sport_not') == 'Lifestyle' ? 'text-black' : 'text-gray-600' }} hover:text-black">Sport</a>
            <form method="GET" action="{{ route('catalog') }}" class="mt-3 flex rounded-full bg-gray-100 h-10 items-center pl-3 gap-2">
                <img src="{{ asset('assets/lucide/search.svg') }}" class="w-4 h-4 block flex-shrink-0">
                <input type="text" name="search" placeholder="Search" value="{{ request('search') }}" class="flex-1 outline-none text-sm text-gray-500 font-semibold bg-transparent min-w-0">
                @if(request('search'))
                    <a href="{{ route('catalog') }}" class="mr-3 text-gray-400 hover:text-gray-600">✕</a>
                @endif
            </form>
        </nav>

        <!-- Tagline bar -->
        <div class="~h-12/20 ~p-3/6 bg-gray-100 flex items-center justify-center">
            <span class="~text-lg/2xl text-gray-500 font-semibold">Where comfort meets style</span>
        </div>
    </header>

    <div class="pt-8">
        @yield('content')
    </div>

    <footer class="mt-12">
        <div class="~px-4/6 ~py-3/5 max-w-[1200px] mx-auto">
            <hr class="border-t border-gray-300">
            <div class="flex items-center justify-between w-full ~mt-3/5 flex-wrap ~gap-2/3">
                <span class="text-black ~text-xs/sm">© 2026 Iken, Inc. All rights reserved</span>
                <div class="flex items-center justify-end ~gap-2/3">
                    <div class="flex items-center justify-center">
                        <img src="{{ asset('assets/lucide/planet.svg') }}" class="~w-4/5 ~h-4/5 block">
                    </div>
                    <span class="text-gray-400 ~text-xs/sm">Slovakia (Slovak Republic)</span>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const iconMenu = document.getElementById('icon-menu');
        const iconClose = document.getElementById('icon-close');

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', () => {
                const isOpen = !mobileMenu.classList.contains('hidden');
                mobileMenu.classList.toggle('hidden');
                iconMenu.classList.toggle('hidden');
                iconClose.classList.toggle('hidden');
                mobileMenuBtn.setAttribute('aria-expanded', String(!isOpen));
            });
        }
    </script>
</body>
</html>
