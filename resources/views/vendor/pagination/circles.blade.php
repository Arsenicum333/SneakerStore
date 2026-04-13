@if ($paginator->hasPages())
    <div class="flex items-center justify-center ~gap-1/2 ~mt-8/12 ~mb-4/6">
        @if ($paginator->onFirstPage())
            <span class="border rounded-full border-gray-300 ~w-7/9 ~h-7/9 flex items-center justify-center opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="~w-3/4 ~h-3/4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="border rounded-full border-gray-300 ~w-7/9 ~h-7/9 flex items-center justify-center hover:border-black transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="~w-3/4 ~h-3/4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="border rounded-full border-gray-300 ~w-7/9 ~h-7/9 flex items-center justify-center ~text-xs/sm font-semibold">...</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="border rounded-full border-black bg-black text-white ~w-7/9 ~h-7/9 flex items-center justify-center ~text-xs/sm font-semibold">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="border rounded-full border-gray-300 ~w-7/9 ~h-7/9 flex items-center justify-center ~text-xs/sm font-semibold hover:border-black transition-colors">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="border rounded-full border-gray-300 ~w-7/9 ~h-7/9 flex items-center justify-center hover:border-black transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="~w-3/4 ~h-3/4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        @else
            <span class="border rounded-full border-gray-300 ~w-7/9 ~h-7/9 flex items-center justify-center opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="~w-3/4 ~h-3/4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </span>
        @endif
    </div>
@endif