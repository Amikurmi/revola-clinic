<section class="py-8 md:py-16 px-6 sm:px-12">
    <div class="container mx-auto">
        <div
            class="grid grid-cols-1 md:grid-cols-[40%_60%] bg-white rounded-2xl overflow-hidden shadow-lg">

            <!-- Left Side - Image (40%) -->
            <div class="relative">
                <img src="{{ asset('images/katkar2.jpg') }}"
                    alt="Specialist Appointment"
                    class="w-full h-[250px] sm:h-[300px] md:h-[370px] object-cover">
            </div>

            <!-- Right Side - Text (60%) -->
            <div
                class="bg-[#e7d8c9] flex flex-col justify-center items-center text-center px-6 sm:px-10 md:px-[100px] py-4 md:py-16 space-y-2 md:space-y-6">

                <!-- Icon + Heading -->
                <div class="flex flex-col items-center space-y-4">
                    <div class="flex items-center gap-6"> <!-- Use gap instead of leading -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="#8b6f47"
                            class="w-20 h-20 md:w-36 md:h-36">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.5 8.25h9m-9 3h9m-9 3h5.25M4.5 6a2.25 2.25 0 012.25-2.25h10.5A2.25 2.25 0 0119.5 6v12a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 18V6z" />
                        </svg>

                        <h2
                            class="text-xl sm:text-3xl md:text-5xl font-bold text-[#3c2c20] leading-snug sm:leading-[1.4]">
                            Get Appointment <br class="hidden sm:block">
                            From Our Specialist
                        </h2>
                    </div>
                </div>

                <!-- Button -->
                <x-button onclick="window.location.href='{{ url('/user/appointments') }}'"
                    bg="#7a5a3a" color="white" class="py-3 text-sm sm:text-base">
                    <i class="fa-solid fa-phone-volume mr-1 md:mr-2"></i> Book Now
                </x-button>
            </div>


        </div>
    </div>
</section>