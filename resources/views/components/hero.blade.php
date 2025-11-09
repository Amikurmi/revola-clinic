<section class="bg-[#f1e9dd] relative overflow-hidden">
    <div class="container mx-auto flex flex-col md:flex-row items-center gap-10 lg:gap-20">

        <!-- Left Text -->
        <div class="md:w-1/2 px-6 sm:px-8 lg:px-16 py-4 lg:py-20 w-full space-y-6 md:space-y-10 text-center md:text-left">
            <h1 class="text-2xl sm:text-4xl lg:text-5xl font-semibold text-[#3c2c20] leading-relaxed sm:leading-snug lg:leading-tight">
                {{ $title }}
                <span class="inline-block mx-2">
                    <img src="{{ $leftImage }}" alt="icon" class="inline w-8 h-8 sm:w-10 sm:h-10 rounded-full border object-cover">
                </span>
                {{ $chat }} <br>
                <span class="text-[#b18457]">{{ $highlight }}</span>
                <span class="inline-block mx-2">
                    <img src="{{ $leftImage }}" alt="icon" class="inline w-8 h-8 sm:w-10 sm:h-10 rounded-full border object-cover">
                </span><br>
                <span class="block">Make An Appointment</span>
            </h1>

            <p class="text-gray-700 leading-relaxed max-w-md mx-auto md:mx-0 text-sm sm:text-lg">
                {{ $subtitle }}
            </p>

            <hr class="border-[#e7d8c9] my-4">

            <div class="grid grid-cols-3 sm:grid-cols-3 gap-6 sm:gap-10 justify-items-center md:justify-items-start">
                <x-stat number="24/7" label="Service Provided" />
                <x-stat number="25K" label="Recover Patient" />
                <x-stat number="15+" label="Market Experience" />
            </div>

            <hr class="border-[#e7d8c9] my-4">

            <x-enquiry-popup />
        </div>

        <!-- Right Image -->
        <div class="hidden md:flex md:w-1/2 pt-10 w-full h-full">
            <div class="w-full h-[800px] bg-[#f1e9dd] rounded-xl">
                <img src="{{ asset($rightImage) }}"
                    alt="Dermatologist visual"
                    class="w-full h-full rounded-xl object-cover">
            </div>
        </div>

    </div>
</section>