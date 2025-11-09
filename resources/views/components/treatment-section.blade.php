<section class="py-12 md:py-20 bg-[#f1e9dd] relative overflow-hidden">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs md:text-sm bg-[#e6dbc9] text-[#8b7760] px-5 py-1.5 rounded-full tracking-wide">
                Our Enlarging Treatments
            </span>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mt-5 text-[#3c2c20] leading-tight">
                Discover Our Advanced Skin & Beauty Treatments
            </h2>
            <p class="text-gray-700 mt-5 text-sm md:text-lg leading-relaxed">
                Our premium treatments are designed to rejuvenate your skin, enhance your natural glow,
                and provide long-lasting beauty with luxury care and precision.
            </p>
        </div>

        <!-- Treatments Grid -->
        @if ($treatments->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($treatments as $treatment)
            <div
                class="group bg-white border border-[#e6dbc9] rounded-2xl shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-500 overflow-hidden flex flex-col">
                <!-- Image -->
                <div class="overflow-hidden relative">
                    <img src="{{ asset($treatment->image) }}" alt="{{ $treatment->title }}"
                        class="w-full md:h-64  object-cover transition-transform duration-700 group-hover:scale-110">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-[#3c2c20]/70 via-transparent opacity-0 group-hover:opacity-100 transition duration-500">
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl md:text-2xl font-semibold text-[#3c2c20] mb-3 group-hover:text-[#b18457] transition">
                        {{ $treatment->title }}
                    </h3>
                    <p class="text-gray-600 text-sm md:text-base flex-grow">
                        {{ Str::limit($treatment->short_description, 120) }}
                    </p>

                    <!-- Buttons -->
                    <div class="mt-6 flex items-center justify-between">
                        <span
                            class="text-[#8b7760] text-sm font-medium border-b-2 border-[#b18457] pb-1 transition-all duration-300">
                            {{ $treatment->button ?? 'Learn More' }}
                        </span>
                        <a href="{{ route('treatments.show', $treatment->slug ?? '#') }}"
                            class="text-[#3c2c20] hover:text-[#b18457] flex items-center gap-2 transition-all duration-300 font-semibold text-sm md:text-base">
                            View Details
                            <i class="fa-solid fa-arrow-right-long text-[#b18457]"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if (method_exists($treatments, 'hasPages') && $treatments->hasPages())
        <div class="flex justify-center mt-10">
            <div class="inline-flex items-center space-x-2 bg-[#f9f6f1] border border-[#e0d6c6] shadow-md px-4 py-2 rounded-full">
                {{ $treatments->onEachSide(1)->links('vendor.pagination.custom-tailwind') }}
            </div>
        </div>
        @endif



        @else
        <div class="text-center py-12 text-gray-600 italic">
            No treatments available at the moment.
        </div>
        @endif
    </div>
</section>