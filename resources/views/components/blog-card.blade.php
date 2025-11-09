<a href="{{ $link }}">
    <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition duration-300">
        <div class="w-full aspect-[16/9] overflow-hidden">
            <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
        </div>
        <div class="p-4">
            <p class="text-xs md:text-sm text-gray-400">{{ $date }}</p>
            <h3 class="font-semibold text-lg md:text-xl mb-2 line-clamp-1">{{ $title }}</h3>
            <p class="text-gray-600 text-sm md:text-lg line-clamp-2">{{ $excerpt }}</p>
        </div>
    </div>
</a>