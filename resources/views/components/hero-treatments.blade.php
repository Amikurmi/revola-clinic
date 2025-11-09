<section class="flex flex-col lg:flex-row w-full">
    <!-- Left Card (40%) -->
    <div class="lg:w-[40%] w-full relative group overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300">
        <img src="{{ $image1 }}"
            alt="{{ $title1 }}"
            class="w-full h-[300px] sm:h-[400px] md:h-[500px] lg:h-[600px] object-cover">
        <div class="absolute bottom-4 left-4 bg-[#7a5a3a] text-white px-4  py-2 rounded text-xs sm:text-base">
            {{ $subtitle1 }}
        </div>
        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>
    </div>

    <!-- Right Section (60%) -->
    <div class="lg:w-[60%] w-full flex flex-col justify-between h-auto lg:h-[600px] mt-8 lg:mt-0 space-y-8 lg:space-y-0">
        <!-- ✅ Top Right Card -->
        <div class="flex flex-col items-start bg-[#fffaf6] rounded-lg shadow-md hover:shadow-lg transition-all duration-300 px-6 sm:px-10 md:px-12 py-2 sm:py-8 lg:text-left">
            <x-button bg="" color="#b18457" class="text-xs sm:text-sm px-4 py-2 mb-3">{{ $buttonText3 }}</x-button>
            <h3 class="text-xl sm:text-3xl px-4 py-2 md:text-4xl lg:text-5xl text-black font-semibold leading-sung md:leading-relaxed mb-0">
                {{ $title2 }}
            </h3>
            <x-button
                bg=""
                color="black"
                class="text-sm px-4 underline hover:decoration-2 hover:underline-offset-4 transition-all duration-200">
                {{ $buttonText2 }}
            </x-button>
        </div>

        <!-- ✅ Bottom Right Card -->
        @if($image3)
        <div class="flex flex-col lg:flex-row  bg-[#fffaf6] rounded-lg shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden">
            <!-- Text Content -->
            <div class="lg:w-1/2 w-full flex flex-col items-start text-left px-6 sm:px-10 py-2 sm:py-8">
                <x-button bg="" color="#b18457" class="text-xs sm:text-sm px-4 py-2 ">{{ $buttonText3 }}</x-button>
                <h3 class="text-xl sm:text-3xl px-4 py-2 md:text-4xl text-black font-semibold leading-sung md:leading-relaxed mb-0">
                    {{ $title3 }}
                </h3>
                <x-button
                    bg=""
                    color="black"
                    class="text-sm px-4 underline hover:decoration-2 hover:underline-offset-4 transition-all duration-200">
                    {{ $buttonText2 }}
                </x-button>
            </div>

            <!-- Image -->
            <div class="lg:w-1/2 w-full h-[250px] sm:h-[300px] lg:h-full">
                <img src="{{ $image3 }}"
                    alt="{{ $title3 }}"
                    class="w-full h-full object-cover">
            </div>
        </div>
        @endif
    </div>
</section>