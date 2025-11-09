<section class="py-12 md:py-20 bg-white">
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="text-xs md-text-sm bg-[#e6dbc9] text-[#8b7760] px-4 py-1 rounded-full">
                {{ $label ?? 'Skin Treatments Portfolio' }}
            </span>
            <h2 class="px-4 md:px-0 text-2xl md:text-5xl font-semibold mt-4 text-[#3c2c20]">
                {{ $title ?? 'Skin Care Of Before & After' }}
            </h2>
            <p class="text-gray-600 mt-4 text-sm md:text-lg leading-relaxed">
                {{ $description ?? "Lorem Ipsum is simply dummy text." }}
            </p>
        </div>

        <!-- Carousel -->
        <div class="relative overflow-hidden group">
            <div class="flex transition-transform duration-500 ease-out carousel-inner mx-10">
                @foreach($items as $item)
                <div class="carousel-item flex-shrink-0 w-full md:w-1/2 pr-6">
                    <div class="relative w-full h-[400px] md:h-[550px] rounded-xl overflow-hidden border border-[#d9cdbb] shadow-sm hover:shadow-xl transition-all duration-500">
                        <img src="{{ asset($item['image']) }}" alt="Image"
                            class="w-full h-full object-cover scale-[1.03] hover:scale-110 transition-all duration-700" />
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Navigation -->
            <button
                class="nav-btn left-3 group-hover:left-0 prev-slide">
                <i class="fa-solid fa-chevron-left"></i>
            </button>

            <button
                class="nav-btn right-3 group-hover:right-0 next-slide">
                <i class="fa-solid fa-chevron-right"></i>
            </button>

            <!-- Luxury Dots -->
            <div class="carousel-dots flex justify-center mt-10 gap-3"></div>

        </div>
    </div>
</section>

<style>
    /* Dots */
    .carousel-dots .dot {
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: #d4ccc3;
        transition: all 0.35s ease;
        transform: scale(1);
        opacity: 0.7;
    }
    .carousel-dots .dot.medium {
        transform: scale(1.45);
        background: #c1b4a2;
        opacity: 0.9;
    }
    .carousel-dots .dot.active {
        transform: scale(2);
        background: #b18457;
        opacity: 1;
        box-shadow: 0 0 10px #b18457aa;
    }

    /* Sliding Navigation Buttons */
    .nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255,255,255,0.85);
        backdrop-filter: blur(6px);
        width: 48px;
        height: 48px;
        border-radius: 999px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 3px 12px rgba(0,0,0,0.18);
        transition: all .4s ease;
        opacity: 0;
        cursor: pointer;
    }
    .group:hover .nav-btn {
        opacity: 1;
    }
    .nav-btn:hover {
        transform: translateY(-50%) scale(1.18);
        background: white;
    }
    .nav-btn i {
        color: #c49a6c;
        font-size: 1.25rem;
        transition: transform .4s;
    }
    .nav-btn:hover i {
        transform: translateX(2px);
    }
    .prev-slide:hover i {
        transform: translateX(-2px);
    }
</style>

@once
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    const carouselInner = document.querySelector('.carousel-inner');
    const items = document.querySelectorAll('.carousel-item');
    const dotsContainer = document.querySelector('.carousel-dots');

    let currentIndex = 0;

    const getVisibleCount = () => window.innerWidth < 768 ? 1 : 2;
    const getDotWindowSize = () => window.innerWidth < 768 ? 5 : 7;

    const renderDots = () => {
        dotsContainer.innerHTML = '';
        const total = items.length;
        const windowSize = getDotWindowSize();
        const half = Math.floor(windowSize / 2);

        let start = currentIndex - half;
        let end = currentIndex + half;
        if (start < 0) { end += -start; start = 0; }
        if (end > total - 1) { start -= (end - (total - 1)); end = total - 1; }
        if (start < 0) start = 0;

        for (let i = start; i <= end; i++) {
            const dot = document.createElement('button');
            dot.classList.add('dot');
            dot.dataset.index = i;
            if (i === currentIndex) dot.classList.add('active');
            else if (i === currentIndex - 1 || i === currentIndex + 1) dot.classList.add('medium');
            dot.addEventListener('click', () => { currentIndex = i; updateCarousel(); });
            dotsContainer.appendChild(dot);
        }
    };

    const updateCarousel = () => {
        const visibleCount = getVisibleCount();
        const offset = -(currentIndex * (100 / visibleCount));
        carouselInner.style.transform = `translateX(${offset}%)`;
        renderDots();
    };

    document.querySelector('.next-slide').addEventListener('click', () => {
        const visibleCount = getVisibleCount();
        if (currentIndex < items.length - visibleCount) currentIndex++;
        updateCarousel();
    });

    document.querySelector('.prev-slide').addEventListener('click', () => {
        if (currentIndex > 0) currentIndex--;
        updateCarousel();
    });

    window.addEventListener('resize', updateCarousel);
    updateCarousel();
});
</script>
@endpush
@endonce
