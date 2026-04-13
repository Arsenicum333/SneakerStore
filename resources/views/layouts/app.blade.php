<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SneakerStore')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white min-h-screen">

    <header class="w-full">
        <div class="~h-4/8 bg-gray-100 flex items-center justify-end ~p-4/6 text-xs">
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

        <div class="relative w-full bg-white flex items-center justify-end ~p-3/6 ~h-10/20">
            <div class="hidden md:block flex-1"></div>

            <div class="flex left-1/2 ~gap-2/5 font-semibold ~text-sm/base">
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

            <div class="flex-1 flex items-center justify-end ~gap-1/3">
                <div class="rounded-full bg-gray-100 ~h-5/10 flex items-center ~pl-2/3 ~gap-1/2">
                    <div class="flex items-center justify-center">
                        <img src="{{ asset('assets/lucide/search.svg') }}" class="~w-4/5 ~h-4/5 block">
                    </div>
                    <input type="text" placeholder="Search" class="outline-none ~text-sm/base ~w-12/24 text-gray-500 font-semibold bg-transparent">
                </div>

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

        <div class="~h-12/20 ~p-3/6 bg-gray-100 flex items-center justify-center">
            <span class="~text-lg/2xl text-gray-500 font-semibold">Where comfort meets style</span>
        </div>
    </header>

    @yield('content')

    <footer>
        <div class="~p-4/6 max-w-[1200px] mx-auto">
            <hr class="border-t-1 md:border-t-2 border-gray-300">
            <div class="flex items-center justify-start w-full">
                <div class="flex items-center justify-start w-1/2 ~mt-3/5">
                    <span class="text-black ~text-xs/sm">© 2026 Iken, Inc. All rights reserved</span>
                </div>
                <div class="flex items-center justify-end ~gap-2/3 w-1/2 ~mt-3/5">
                    <div class="flex items-center justify-center">
                        <img src="{{ asset('assets/lucide/planet.svg') }}" class="~w-4/5 ~h-4/5 block">
                    </div>
                    <span class="text-gray-400 ~text-xs/sm">Slovakia (Slovak Republic)</span>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>