<div class="relative group rounded-2xl overflow-hidden shadow-md cursor-pointer transition-all duration-500"
    style="background: {{ $bgColor }};">

    @if($image)
    <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-64 object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
    @endif

    <!-- Overlay -->
    <div class="absolute inset-0 bg-[#8b7355]/70 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col items-center justify-center text-white">
        <div class="flex gap-4 mb-3">
            @foreach(['facebook', 'twitter', 'instagram'] as $social)
            <a href="#" class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center hover:bg-white hover:text-[#8b7355] transition">
                @if($social === 'facebook')
                <i class="fab fa-facebook-f"></i>
                @elseif($social === 'twitter')
                <i class="fab fa-x-twitter"></i>
                @elseif($social === 'instagram')
                <i class="fab fa-instagram"></i>
                @endif
            </a>
            @endforeach
        </div>
        <h3 class="text-xl font-semibold">{{ $title }}</h3>
    </div>

    <!-- Title (Visible when not hovered) -->
    <div class="absolute inset-0 flex items-center justify-center text-[#3c2c20] font-semibold text-xl group-hover:opacity-0 transition-opacity duration-500">
        {{ $title }}
    </div>
</div>