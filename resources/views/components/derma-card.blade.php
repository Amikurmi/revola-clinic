<section class="bg-gray-50 py-12">
    <div class="px-4">
        {{-- Logo Slider --}}
        <div class="overflow-hidden relative">
            <div id="logoSlider" class="flex gap-[100px]">
                @for($i = 1; $i <= 9; $i++)
                    <img src="/images/logo{{ $i }}.jpg" alt="Logo {{ $i }}" class="h-16">
                    @endfor
                    @for($i = 1; $i <= 9; $i++)
                        <img src="/images/logo{{ $i }}.jpg" alt="Logo {{ $i }}" class="h-16">
                        @endfor
                        @for($i = 1; $i <= 9; $i++)
                            <img src="/images/logo{{ $i }}.jpg" alt="Logo {{ $i }}" class="h-16">
                            @endfor
                            @for($i = 1; $i <= 9; $i++)
                                <img src="/images/logo{{ $i }}.jpg" alt="Logo {{ $i }}" class="h-16">
                                @endfor
            </div>
        </div>

        {{-- Derma Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6 py-12">

            {{-- Card 1 - Financial Planning --}}
            <div class="rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 relative bg-color text-stone-600">
                <div class="mt-6 flex p-6 justify-start mb-3">
                    <button
                        class="px-6 py-2 rounded-full text-sm md:text-lg font-semibold border text-stone-600 border-current bg-transparent hover:bg-current hover:text-white transition">
                        Drama
                    </button>
                </div>
                <div class="flex flex-col px-6">
                    <div class="flex space-x-2">
                        <img src="/images/katkar2.jpg" alt="Financial Planning" class="w-[60%] h-40 mt-10 object-cover rounded-lg shadow-md mb-4">
                        <img src="/images/katkar2.jpg" alt="Financial Planning" class="w-[40%] h-40 object-cover rounded-lg shadow-md mb-4">
                    </div>
                    <div class="mt-3">
                        <p class="text-sm md:text-lg text-[#75583c] ">Talk About</p>
                        <h3 class="text-lg md:text-xl text-[#75583c] font-bold">Financial Planning</h3>
                    </div>
                </div>
            </div>

            {{-- Card 2 - Quote Card --}}
            <div class="h-full rounded-2xl p-6 shadow-md hover:shadow-xl transition-all duration-300 relative bg-color1 text-white">
                <div class="mt-6 flex justify-start mb-8">
                    <button
                        class="px-6 py-2 rounded-full text-sm md:text-lg font-semibold border text-white border-current bg-transparent hover:bg-current hover:text-white transition">
                        Drama
                    </button>
                </div>
                <div class="flex flex-col justify-between h-[200px] md:h-[280px]">
                    <p class=" text-sm md:text-lg">&ldquo;Saving is the gap between your ego and your income&rdquo;</p>
                    <p class="mt-2 font-semibold text-lg md:text-xl text-end">M. Murugan Housel</p>
                </div>
            </div>

            {{-- Card 3 - Quote Card --}}
            <div class="h-full rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 relative bg-color text-stone-600">
                <div class="mt-6 flex justify-start mb-1 p-6">
                    <button
                        class="px-6 py-2 rounded-full text-sm md:text-lg font-semibold border text-stone-600 border-current bg-transparent hover:bg-current hover:text-white transition">
                        Drama
                    </button>
                </div>
                <div class="flex flex-col  space-y-2">
                    <p class="text-[#75583c] px-8  text-sm md:text-lg">&ldquo;Saving is the gap between your ego and your income&rdquo;</p>
                    <p class="text-[#75583c] px-8 text-sm md:text-lg">&ldquo;Saving is the gap between your ego and your income&rdquo;</p>
                    <img src="/images/katkar2.jpg" alt="Financial Planning" class="w-full h-48 mt-10 object-cover rounded-2xl shadow-md mb-4">
                </div>
            </div>

            {{-- Card 4 - Treatment --}}
            <div class="rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 relative bg-color1 text-white">
                <img src="/images/katkar2.jpg" alt="Financial Planning" class="w-full h-52  object-cover rounded-2xl shadow-md mb-4">
                <div class="mt-6 p-6 flex justify-start mb-3">
                    <button
                        class="px-6 py-2 rounded-full text-sm md:text-lg font-semibold border text-white border-current bg-transparent hover:bg-current hover:text-white transition">
                        Care
                    </button>
                </div>
                <div class="flex p-6 flex-col">
                    <p class="text-sm md:text-lg  px-2  text-gray-200">Talk About</p>
                    <h3 class="text-lg md:text-xl px-2 font-bold">Treatment</h3>
                </div>
            </div>

            {{-- Card 5 - Quote Card --}}
            <div class="h-full rounded-2xl p-6 shadow-md hover:shadow-xl transition-all duration-300 relative bg-color text-stone-600">
                <div class=" mt-6 flex justify-start mb-8">
                    <button
                        class="px-6 py-2 rounded-full text-sm md:text-lg font-semibold border text-stone-600 border-current bg-transparent hover:bg-current hover:text-white transition">
                        Drama
                    </button>
                </div>
                <div class=" flex flex-col justify-between text-[#75583c] h-[200px] md:h-[280px]">
                    <p class="text-sm md:text-lg">&ldquo;Saving is the gap between your ego and your income&rdquo;</p>
                    <p class="mt-2 font-semibold text-lg md:text-xl text-end">M. Murugan Housel</p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Smooth Infinite Logo Slider --}}
<script>
    const slider = document.getElementById('logoSlider');
    let scrollPos = 0;
    const speed = 1;

    function smoothScroll() {
        scrollPos += speed;
        if (scrollPos >= slider.scrollWidth / 2) scrollPos = 0;
        slider.style.transform = `translateX(-${scrollPos}px)`;
        requestAnimationFrame(smoothScroll);
    }

    smoothScroll();
</script>

<style>
    #logoSlider {
        display: flex;
        gap: 2rem;
        transition: transform 0.1s linear;
    }

    #logoSlider img {
        flex-shrink: 0;
    }

    /* Custom Backgrounds */
    .bg-color {
        background-color: #e1dac7;
        /* Warm beige */
    }

    .bg-color1 {
        background-color: #7a5f42;
        /* Dark coffee brown */
    }
</style>