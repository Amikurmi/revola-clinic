<div class="relative rounded-2xl shadow-lg p-6" style="background: {{ $bgColor ?? '#f9f6f1' }}">

    <!-- Optional Social Icons -->
    <div class="absolute top-4 right-4 sm:top-6 sm:right-6 flex gap-2 sm:gap-3"></div>

    @if($isImageCard && $image)
    <!-- 🌆 Image Card Layout -->
    <div class="relative">
        <img
            src="{{ $image }}"
            alt="{{ $title }}"
            class="w-full h-64  md:h-[550px] lg:h-[550px] object-cover rounded-2xl">
        <div class="absolute inset-0 bg-black/30 rounded-2xl"></div>

        <!-- Text Overlay -->
        <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 text-center text-white z-10 w-full px-3 sm:px-6">
            <h3 class="text-lg sm:text-2xl font-bold">{{ $title }}</h3>
            <p class="text-base sm:text-lg opacity-90 mt-1">{{ $price }}</p>
            <a href="{{ $buttonUrl }}"
                class="mt-3 inline-flex items-center justify-center py-2 px-6 rounded-full border-2 border-white text-sm sm:text-base text-white font-medium hover:bg-white hover:text-gray-900 transition">
                {{ $buttonText }}
            </a>
        </div>
    </div>

    @else
    <!-- 🧴 Standard (Icon) Card Layout -->
    <div class="flex flex-col items-center text-center">

        <!-- Icon Circle -->
        <div class="flex items-center justify-center bg-[#8B7355] w-16 h-16 sm:w-20 sm:h-20 rounded-full mb-5 sm:mb-6 shadow-md">
            {!! $icon !!}
        </div>

        <!-- Title -->
        <h3 class="text-xl sm:text-2xl font-semibold mb-3 sm:mb-4 {{ $textColor ?? 'text-[#3c2c20]' }}">
            {{ $title }}
        </h3>

        <!-- Price & Duration -->
        @if($price)
        <div class="mb-5 sm:mb-6">
            <span class="text-3xl sm:text-4xl font-bold {{ $textColor ?? 'text-[#3c2c20]' }}">{{ $price }}</span>
            @if($duration)
            <span class="text-base sm:text-lg {{ $textColor ?? 'text-[#3c2c20]' }}">/ {{ $duration }}</span>
            @endif
        </div>
        @endif

        <!-- Features -->
        <ul class="space-y-2 sm:space-y-3 mb-6 text-left w-full max-w-xs mx-auto">
            @foreach($features as $feature)
            <li class="flex items-start gap-2 sm:gap-3">
                <svg
                    class="w-4 h-4 sm:w-5 sm:h-5 flex-shrink-0 {{ $textColor ?? 'text-gray-700' }}"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                </svg>
                <span class="text-xs md:text-sm {{ $textColor ?? 'text-gray-700' }}">{{ $feature }}</span>
            </li>
            @endforeach
        </ul>

        <!-- Button -->
        <a href="{{ $buttonUrl }}"
            class="block w-full py-2.5 sm:py-3 px-5 sm:px-6 rounded-full bg-[#8B7355] border border-[#f1e9dd] text-sm sm:text-base text-white font-medium text-center hover:bg-[#7b654b] transition duration-300">
            {{ $buttonText }}
        </a>
    </div>
    @endif
</div>