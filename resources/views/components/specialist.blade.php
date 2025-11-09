<section class="bg-white relative overflow-hidden py-4 md:py-20 px-6 md:px-16">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center py-10 gap-10 md:gap-[100px]">

        <!-- Left Image -->
        <div class="md:w-1/2 w-full flex justify-center">
            <img src="{{ asset($mainImage) }}"
                alt="Dermatologist"
                class="rounded-xl shadow-lg w-full h-[360px] md:h-[650px] object-cover">
        </div>

        <!-- Right Content -->
        <div class="md:w-1/2 w-full space-y-6 text-center md:text-left">

            <button class="bg-[#f5ebe0] text-[#7b5e3b] text-xs md:text-sm px-4 py-1 rounded-full">
                About Our Medical World
            </button>

            <h2 class="text-2xl sm:text-4xl md:text-5xl font-semibold text-[#3c2c20] leading-tight">
                {{ $title }}
            </h2>

            <p class="text-gray-600 leading-relaxed text-sm sm:text-lg">
                {{ $description }}
            </p>

            <!-- Treatments -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-800">

                @php
                $treatments = [
                'Organic Facial Treatments',
                'HydraFacial Skin Glow',
                'Acne & Scar Healing Therapy',
                'Anti-Aging & Wrinkle Lift',
                'Pigmentation & Brightening',
                'Laser Hair Reduction'
                ];
                @endphp

                @foreach ($treatments as $treatment)
                <div class="flex items-center space-x-2">
                    <i class="fa-solid fa-seedling text-[#7b5e3b]"></i>
                    <span class="text-sm md:text-lg">{{ $treatment }}</span>
                </div>
                @endforeach

            </div>

            <!-- Doctor -->
            <div class="flex mt-0 md:mt-2 flex-col sm:flex-row items-center justify-center md:justify-start space-y-3 sm:space-y-0 sm:space-x-3 border-t border-[#e7d8c9] pt-6">
                <img src="{{ asset($doctorImage) }}" alt="{{ $doctorName }}" class="w-12 h-12 rounded-full border">
                <div class="text-center sm:text-left">
                    <h4 class="font-semibold">{{ $doctorName }}</h4>
                    <p class="text-sm text-gray-500">{{ $doctorField }}</p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-center md:justify-start gap-4 pt-4">
                <x-button onclick="window.location.href='{{ url('/user/appointments') }}'"
                    bg="#7a5a3a" color="white" class="py-3 text-sm sm:text-base">
                    <i class="fa-solid fa-phone-volume mr-1 md:mr-2"></i> Book Now
                </x-button>
            </div>

        </div>
    </div>

    <!-- Bottom Section -->
    <!-- Bottom Section -->
    <div class="container mx-auto">
        <div class="bg-[#f5ebe0] mt-0 md:mt-16 p-6 sm:p-8 rounded-xl grid grid-cols-1 md:grid-cols-2 gap-8"> <!-- Left Content -->
            <div class="text-center md:text-left"> <button class="border-2 border-[#7b5e3b] text-[#7b5e3b] text-xs md:text-sm px-4 py-2 rounded-full mb-3"> Booking Our Specialist </button>
                <h3 class="text-2xl sm:text-3xl md:text-5xl pr-0 md:pr-10 leading-relaxed font-semibold text-gray-800 mb-1 md:mb-4 "> Let You Talk To Our Specialist </h3>
                <p class="text-gray-900 text-sm sm:text-lg mt-6 pr-0 md:pr-10"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus provident cum delectus repudiandae error sint! </p>
            </div> <!-- Right Info Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-gray-700 text-sm mt-0 md:mt-10"> <!-- Visit Us -->
                <div class="flex items-start gap-3">
                    <div class="text-[#7b5e3b] rounded-full border border-[#7b5e3b] w-10 h-10 flex items-center justify-center shadow-md"> <i class="fa-solid fa-location-dot"></i> </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-1 text-sm md:text-xl">Visit Us</h4> <a href="https://maps.app.goo.gl/7Ygr91o8m1zaQKgk6" target="_blank" class="hover:underline text-sm md:text-lg block"> 1st floor, Block No. B-1, Srinivas Apartment,<br> Bajaj Nagar, Nagpur, Maharashtra 440010 </a>
                    </div>
                </div> <!-- Contact Us -->
                <div class="flex items-start gap-3">
                    <div class="text-[#7b5e3b] rounded-full border border-[#7b5e3b] w-10 h-10 flex items-center justify-center shadow-md"> <i class="fa-solid fa-phone-volume"></i> </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-1 text-sm md:text-xl">Contact Us</h4>
                        <p class="hover:underline text-sm md:text-lg mt-1 block"> <a href="tel:+917030319520" class="hover:underline"> 7030319520 (Call) </a> </p>
                        <p class="hover:underline text-sm md:text-lg mt-1 block"> <a href="https://wa.me/917030319520?text=Hi%20Revola%20Clinic" target="_blank" class="hover:underline"> 7030319520 (WhatsApp) </a> </p>
                    </div>
                </div> <!-- Working Days -->
                <div class="flex items-start gap-3">
                    <div class="text-[#7b5e3b] rounded-full border border-[#7b5e3b] w-10 h-10 flex items-center justify-center shadow-md"> <i class="fa-solid fa-calendar-days"></i> </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-1 text-sm md:text-xl">Working Days</h4>
                        <p class="text-sm md:text-lg">Mon - Sun 10:00 AM To 08:00 PM</p>
                    </div>
                </div> <!-- Email Us -->
                <div class="flex items-start gap-3">
                    <div class="text-[#7b5e3b] rounded-full border border-[#7b5e3b] w-10 h-10 flex items-center justify-center shadow-md"> <i class="fa-solid fa-envelope"></i> </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-1 text-sm md:text-xl">Email Us</h4>
                        <p class="text-sm md:text-lg"> <a href="https://mail.google.com/mail/u/0/?view=cm&fs=1&to=revolaclinic@gmail.com&su=Appointment%20Inquiry&body=Hello%20Revola%20Clinic,%20I%20would%20like%20to%20book%20an%20appointment." target="_blank" class="hover:underline"> revolaclinic@gmail.com </a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>