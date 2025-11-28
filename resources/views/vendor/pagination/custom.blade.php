@if ($paginator->hasPages())
    <nav class="flex items-center justify-center gap-2 mt-6">

        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 rounded-md bg-gray-200 text-gray-500">←</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">←</a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-3 py-1 text-gray-500">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1 rounded-md bg-[#FF9027] text-white font-medium">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-1 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">→</a>
        @else
            <span class="px-3 py-1 rounded-md bg-gray-200 text-gray-500">→</span>
        @endif

    </nav>
@endif
