@props(['image', 'title', 'label', 'description', 'button', 'link', 'mt' => 0])

<div class="group w-full" data-aos="fade-up">
    <div
        class="relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 mt-0 md:mt-{{ $mt }}">

        <!-- Treatment Image -->
        <img src="{{ $image }}" alt="{{ $title }}"
            class="w-full h-[400px] md:h-[500px] lg:h-[550px] object-cover transform transition duration-700 group-hover:scale-105">

        <!-- Hover Overlay -->
        <div
            class="absolute inset-0 bg-gradient-to-t from-[#3c2c20]/90 via-[#3c2c20]/40 to-transparent opacity-100 md:opacity-0 md:group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-6 text-white">

            @if($label)
            <span class="text-xs sm:text-sm uppercase tracking-widest opacity-90">{{ $label }}</span>
            @endif

            <h3 class="text-xl sm:text-2xl font-semibold mt-1">{{ $title }}</h3>

            @if($description)
            <p class="text-sm sm:text-base mt-2 leading-snug line-clamp-3">
                {!! Str::limit(strip_tags($description), 100) !!}
            </p>
            @endif

            @if($link)
            <a href="{{ $link }}"
                class="bg-[#b18457] hover:bg-[#8b6f47] text-white text-center mt-4 rounded-full text-sm sm:text-base font-semibold px-5 py-2 inline-block shadow-md transition-all duration-300">
                View Services
            </a>
            @endif
        </div>
    </div>

    <!-- Static Title Below (for desktop hover effect) -->
    <div
        class="hidden md:block w-full bg-white/90 text-[#7a5a3a] text-left md:text-lg font-medium py-3 pl-5 transition-opacity duration-500 group-hover:opacity-0">
        {{ $title }}
    </div>
</div>