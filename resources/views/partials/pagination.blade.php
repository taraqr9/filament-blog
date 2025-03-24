@if ($paginator->hasPages())
    <div class="mt-10 flex justify-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md mx-1">Prev</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 bg-blue-600 text-white rounded-md mx-1 hover:bg-blue-500">Prev</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md mx-1">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-4 py-2 bg-blue-600 text-white rounded-md mx-1">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-4 py-2 bg-gray-500 text-white rounded-md mx-1 hover:bg-gray-400">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 bg-blue-600 text-white rounded-md mx-1 hover:bg-blue-500">Next</a>
        @else
            <span class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md mx-1">Next</span>
        @endif
    </div>
@endif
