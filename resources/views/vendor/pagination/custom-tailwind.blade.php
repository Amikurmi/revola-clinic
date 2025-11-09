@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination" class="flex items-center space-x-1">

    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
    <span class="px-3 py-2 text-[#C5B9A1] bg-[#F9F6F1] border border-[#E0D6C6] rounded-full cursor-not-allowed">
        <i class="fa-solid fa-angle-left"></i>
    </span>
    @else
    <a href="{{ $paginator->previousPageUrl() }}"
        class="px-3 py-2 text-[#4B3621] bg-white border border-[#E0D6C6] hover:bg-[#F9F6F1] hover:text-[#8B7355] rounded-full transition">
        <i class="fa-solid fa-angle-left"></i>
    </a>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
    {{-- "Three Dots" Separator --}}
    @if (is_string($element))
    <span class="px-3 py-2 text-gray-400">{{ $element }}</span>
    @endif

    {{-- Page Number Links --}}
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <span class="px-3 py-2 bg-[#8B7355] text-white border border-[#8B7355] rounded-full shadow font-semibold">
        {{ $page }}
    </span>
    @else
    <a href="{{ $url }}"
        class="px-3 py-2 bg-white text-[#4B3621] border border-[#E0D6C6] hover:bg-[#F9F6F1] hover:text-[#8B7355] rounded-full transition font-medium">
        {{ $page }}
    </a>
    @endif
    @endforeach
    @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}"
        class="px-3 py-2 text-[#4B3621] bg-white border border-[#E0D6C6] hover:bg-[#F9F6F1] hover:text-[#8B7355] rounded-full transition">
        <i class="fa-solid fa-angle-right"></i>
    </a>
    @else
    <span class="px-3 py-2 text-[#C5B9A1] bg-[#F9F6F1] border border-[#E0D6C6] rounded-full cursor-not-allowed">
        <i class="fa-solid fa-angle-right"></i>
    </span>
    @endif

</nav>
@endif