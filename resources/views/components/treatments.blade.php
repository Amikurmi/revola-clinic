@props(['services' => collect()])

<section class="py-12 md:py-20 bg-white px-4 md:px-8">
    <div class="container mx-auto">

        <!-- Header -->
        <div class="flex flex-col lg:flex-row justify-between items-center lg:items-start gap-6 md:gap-10 mb-12 text-center lg:text-left">
            <div class="flex-1 max-w-2xl">
                <span class="inline-block text-xs sm:text-sm bg-[#e6dbc9] text-[#8b7760] px-4 py-1.5 rounded-full font-medium">
                    Healthy Skin & Natural
                </span>
                <h2 class="text-2xl sm:text-4xl lg:text-5xl font-bold mt-4 text-[#3c2c20] leading-snug sm:leading-tight">
                    What We Treat In Centre
                </h2>
            </div>

            <div class="flex-1 max-w-2xl text-gray-600 text-sm sm:text-base lg:text-lg">
                <p class="leading-relaxed">
                    We specialize in a wide range of skincare, haircare, and cosmetic treatments using advanced techniques
                    to help you look and feel your best.
                </p>
                <a href="{{ route('services.index') }}"
                    class="text-[#b18457] underline mt-4 inline-block hover:text-[#8b7760] transition-colors duration-200">
                    Browse All Skincare Treatments
                </a>
            </div>
        </div>
    </div>

    <!-- Treatments Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 md:gap-10">
        @forelse($services as $index => $service)
        @php
        $isArray = is_array($service);
        $title = $isArray ? ($service['title'] ?? '') : ($service->title ?? '');
        $image = $isArray ? ($service['image'] ?? '') : ($service->image ?? '');
        $label = $isArray ? ($service['label'] ?? '') : ($service->label ?? '');
        $description = $isArray ? ($service['description'] ?? '') : ($service->description ?? '');
        $slug = $isArray ? ($service['slug'] ?? '') : ($service->slug ?? '');
        @endphp

        <x-treatment-card
            :image="asset($image)"
            :title="$title"
            :label="$label"
            :description="$description"
            :link="route('services.show', $slug)"
            :mt="$index % 2 === 1 ? 8 : 0" />
        @empty
        <p class="text-gray-500 text-center col-span-full">No services available at the moment.</p>
        @endforelse
    </div>
</section>