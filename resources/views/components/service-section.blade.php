<section class="bg-[#8b6f47] text-white py-10 md:py-16 px-4 sm:px-8 lg:px-20">
    <div class="container mx-auto">
        <!-- Main Grid -->
        <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-start">

            <!-- LEFT SIDE -->
            <div>
                <!-- Tagline -->
                <span class="inline-block text-xs sm:text-sm uppercase tracking-widest text-white/90 bg-black/10 px-3 sm:px-4 py-1.5 sm:py-2 rounded-full">
                    Healthy Skin and Natural
                </span>

                <!-- Title -->
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-semibold mt-4 mb-3 leading-snug sm:leading-tight">
                    How We Provide Services
                </h2>

                <!-- Subtitle -->
                <p class="text-white/80 mb-6 sm:mb-8 text-sm sm:text-base md:text-lg max-w-xl">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </p>

                <!-- Accordion -->
                <div class="space-y-4 mb-2 md:mb-8">
                    @foreach ($services as $service)
                    <div class="accordion-item rounded-2xl p-1.5 md:p-3 cursor-pointer transition-all duration-300 backdrop-blur-sm 
                                {{ $service['active'] ? 'active bg-black/15' : 'bg-transparent hover:bg-black/10' }}">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-3 sm:gap-4">
                                <div class="bg-white text-[#8b6f47] w-7 h-7 sm:w-8 sm:h-8 md:w-10 md:h-10 rounded-full flex items-center justify-center font-bold text-sm sm:text-base flex-shrink-0">
                                    {{ $service['id'] }}
                                </div>
                                <h3 class="font-semibold text-sm sm:text-base md:text-lg">{{ $service['title'] }}</h3>
                            </div>
                            <svg class="accordion-icon w-5 h-5 sm:w-6 sm:h-6 text-white/60 transition-transform {{ $service['active'] ? 'rotate-180' : '' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                        <p class="accordion-content text-xs sm:text-sm md:text-base text-white/70 mt-1 md:mt-2 ml-8 md:ml-12 leading-relaxed {{ $service['active'] ? 'block' : 'hidden' }}">
                            {{ $service['desc'] }}
                        </p>
                    </div>
                    @endforeach
                </div>

                <!-- Book Now Button -->
                <div class="flex justify-center lg:justify-end mb-0 pt-4 md:pt-0 md:mb-8">
                    <x-button onclick="window.location.href='{{ url('/user/appointments') }}'"
                        bg="#7a5a3a" color="white" class="py-3 text-sm sm:text-base border border-white">
                        <i class="fa-solid fa-phone-volume mr-1 md:mr-2"></i> Book Now
                    </x-button>
                </div>
            </div>

            <!-- RIGHT SIDE (Image) -->
            <div class="flex justify-center lg:justify-end">
                <div class="relative w-full max-w-xl sm:max-w-2xl">
                    <img src="{{ asset('images/katkar1.jpg') }}"
                        alt="Healthcare Professional Providing Treatment"
                        class="rounded-3xl shadow-2xl w-full object-cover h-[370px] md:h-[750px]">
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-6 md:gap-10 lg:gap-20 mt-12 pt-8 border-t border-white/20 text-center md:text-left">
            <div>
                <h3 class="text-xl sm:text-2xl md:text-4xl font-bold mb-1">42+</h3>
                <p class="text-xs sm:text-sm md:text-base font-semibold mb-2">Insurance Covered</p>
                <hr class="border-[#e7d8c9] my-3 sm:my-4">
                <p class="text-xs sm:text-sm text-white/70 leading-relaxed">
                    Successfully finished projects with creativity.
                </p>
            </div>
            <div>
                <h3 class="text-xl sm:text-2xl md:text-4xl font-bold mb-1">02K</h3>
                <p class="text-xs sm:text-sm md:text-base font-semibold mb-2">Realized Projects</p>
                <hr class="border-[#e7d8c9] my-3 sm:my-4">
                <p class="text-xs sm:text-sm text-white/70 leading-relaxed">
                    Successfully finished projects with creativity.
                </p>
            </div>
            <div>
                <h3 class="text-xl sm:text-2xl md:text-4xl font-bold mb-1">22K</h3>
                <p class="text-xs sm:text-sm md:text-base font-semibold mb-2">Satisfied Clients</p>
                <hr class="border-[#e7d8c9] my-3 sm:my-4">
                <p class="text-xs sm:text-sm text-white/70 leading-relaxed">
                    Successfully finished projects with creativity.
                </p>
            </div>
            <div>
                <h3 class="text-xl sm:text-2xl md:text-4xl font-bold mb-1">15K</h3>
                <p class="text-xs sm:text-sm md:text-base font-semibold mb-2">Positive Reviews</p>
                <hr class="border-[#e7d8c9] my-3 sm:my-4">
                <p class="text-xs sm:text-sm text-white/70 leading-relaxed">
                    Successfully finished projects with creativity.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Accordion Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const accordionItems = document.querySelectorAll('.accordion-item');
        accordionItems.forEach(item => {
            item.addEventListener('click', () => {
                const currentlyActive = document.querySelector('.accordion-item.active');
                if (currentlyActive && currentlyActive !== item) {
                    currentlyActive.classList.remove('active');
                    currentlyActive.querySelector('.accordion-content').classList.add('hidden');
                    currentlyActive.querySelector('.accordion-icon').classList.remove('rotate-180');
                }

                const content = item.querySelector('.accordion-content');
                const icon = item.querySelector('.accordion-icon');
                content.classList.toggle('hidden');
                item.classList.toggle('active');
                icon.classList.toggle('rotate-180');
            });
        });
    });
</script>