<section class="bg-white py-8 md:py-16 px-6 sm:px-12 overflow-hidden">
    <div class="text-center mb-12">
        <span
            class="inline-block bg-[#e7d8c9] text-[#8b6f47] px-6 py-2 rounded-full font-medium text-xs md:text-sm mb-4">
            Special Feedback
        </span>
        <h2 class="text-2xl sm:text-4xl font-semibold text-[#3c2c20] mt-2">Customer Reviews</h2>
        <p class="text-gray-600 mt-4 max-w-2xl md:text-lg mx-auto leading-relaxed text-sm sm:text-lg">
            Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry. Lorem Ipsum Has Been
        </p>
    </div>

    <div class="max-w-7xl mx-auto relative">
        <!-- Carousel Wrapper -->
        <div id="review-carousel" class="overflow-hidden">
            <div id="review-track" class="flex transition-transform duration-700 ease-in-out">
                @foreach ($reviews as $index => $review)
                <div class="min-w-full sm:min-w-[50%] lg:min-w-[33.333%] px-4">
                    <div class="relative pt-16">
                        <!-- Profile Image -->
                        <div class="absolute top-10 left-1/2 transform -translate-x-1/2 -translate-y-8">
                            <img src="{{ asset($review['image']) }}" alt="{{ $review['name'] }}"
                                class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-lg">
                        </div>

                        <!-- Card Content -->
                        <div
                            class="bg-{{ $index === 1 ? '[#8b6f47]' : '[#f1e9dd]' }} p-8  pt-16 rounded-2xl shadow-md text-center h-full">
                            <!-- Stars -->
                            <div
                                class="flex justify-center gap-1 mb-4 text-{{ $index === 1 ? 'white' : '[#8b6f47]' }}">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < ($review['rating'] ?? 5))
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                    <path
                                        d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    @else
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"
                                            fill="none" stroke="currentColor" stroke-width="1" />
                                    </svg>
                                    @endif
                                    @endfor
                            </div>

                            <!-- Review Text -->
                            <p class="text-{{ $index === 1 ? 'white' : 'gray-700' }} text-sm leading-relaxed mb-6">
                                {{ $review['text'] }}
                            </p>

                            <!-- Divider -->
                            <div class="border-t border-{{ $index === 1 ? 'white/20' : 'gray-400' }} mb-4"></div>

                            <!-- Name and Designation -->
                            <h4
                                class="font-semibold text-lg text-{{ $index === 1 ? 'white' : '[#3c2c20]' }}">
                                {{ $review['name'] }}
                            </h4>
                            <span
                                class="text-sm text-{{ $index === 1 ? 'white/80' : 'gray-500' }}">{{ $review['designation'] }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-center gap-4 mt-8">
            <button id="prevBtn"
                class="w-12 h-12 rounded-lg border border-gray-300 flex items-center justify-center hover:bg-gray-100 transition-colors">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button id="nextBtn"
                class="w-12 h-12 rounded-lg border border-gray-300 flex items-center justify-center hover:bg-gray-100 transition-colors">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const track = document.getElementById("review-track");
        const prevBtn = document.getElementById("prevBtn");
        const nextBtn = document.getElementById("nextBtn");

        let currentIndex = 0;
        const slides = document.querySelectorAll("#review-track > div");
        const totalSlides = slides.length;

        function getVisibleSlides() {
            if (window.innerWidth >= 1024) return 3;
            if (window.innerWidth >= 768) return 2;
            return 1;
        }

        function updateCarousel() {
            const visible = getVisibleSlides();
            const maxIndex = totalSlides - visible;
            if (currentIndex < 0) currentIndex = maxIndex;
            if (currentIndex > maxIndex) currentIndex = 0;
            const slideWidth = slides[0].offsetWidth;
            track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
        }

        prevBtn.addEventListener("click", () => {
            currentIndex--;
            updateCarousel();
        });

        nextBtn.addEventListener("click", () => {
            currentIndex++;
            updateCarousel();
        });

        window.addEventListener("resize", updateCarousel);
        updateCarousel();

        // Optional autoplay
        setInterval(() => {
            currentIndex++;
            updateCarousel();
        }, 6000);
    });
</script>
@endpush