<section class="bg-[#e7d8c9] py-8 md:py-16 px-6 sm:px-12">
    <div class="container mx-auto">

        {{-- ✅ SUCCESS POPUP (Core JS, Auto Close, Fade Animation) --}}
        @if(session('success'))
        <div id="popupOverlay" class="fixed inset-0 flex items-center justify-center bg-black/60 z-50 opacity-0 transition-opacity duration-300">
            <div id="popupBox" class="bg-white text-[#3c2c20] px-8 py-6 rounded-xl shadow-2xl w-11/12 max-w-md relative opacity-0 scale-95 transition-all duration-300">

                <!-- Close Button -->
                <button id="popupClose" class="absolute top-3 right-3 text-gray-600 hover:text-black text-xl">
                    <i class="fa-solid fa-xmark"></i>
                </button>

                <!-- Icon -->
                <div class="text-center mb-4">
                    <i class="fa-solid fa-circle-check text-green-600 text-4xl"></i>
                </div>

                <!-- Message -->
                <p class="text-center text-lg font-semibold">{{ session('success') }}</p>
            </div>
        </div>

        <script>
            const overlay = document.getElementById("popupOverlay");
            const box = document.getElementById("popupBox");

            // Fade-in
            setTimeout(() => {
                overlay.classList.remove("opacity-0");
                box.classList.remove("opacity-0", "scale-95");
            }, 50);

            // Auto-close after 2 seconds
            setTimeout(() => closePopup(), 2000);

            // Close on button click
            document.getElementById("popupClose").addEventListener("click", closePopup);

            function closePopup() {
                overlay.classList.add("opacity-0");
                box.classList.add("opacity-0", "scale-95");
                setTimeout(() => overlay.remove(), 300);
            }
        </script>
        @endif


        {{-- ✅ VALIDATION ERROR ALERT --}}
        @if ($errors->any())
        <div id="errorAlert" class="fixed top-6 left-1/2 -translate-x-1/2 bg-red-600 text-white py-3 px-6 rounded-lg shadow-lg z-50 opacity-0 transition-opacity duration-300">
            Please fill all required fields correctly.
        </div>

        <script>
            const errorAlert = document.getElementById("errorAlert");
            setTimeout(() => errorAlert.classList.remove("opacity-0"), 50);
            setTimeout(() => {
                errorAlert.classList.add("opacity-0");
                setTimeout(() => errorAlert.remove(), 300);
            }, 2000);
        </script>
        @endif


        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">

            <!-- Left Section -->
            <div class="text-center md:text-start">
                <button class="bg-[#d6c1a3] text-[#5b4636] px-6 py-2 rounded-full text-xs md:text-sm font-medium mb-6">
                    Get Care You Deserve
                </button>

                <h2 class="text-2xl md:text-5xl text-[#3c2c20] leading-tight font-semibold mb-5">
                    We Offer All Services <br class="hidden sm:block"> On Dermatology
                </h2>

                <p class="text-[#5b4636] text-sm md:text-lg leading-relaxed mb-8 max-w-lg">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </p>

                <h3 class="font-semibold text-lg md:text-xl text-[#3c2c20] mb-4">How This Works?</h3>

                <ul class="space-y-3 text-[#5b4636] text-sm">
                    @foreach(['Register by filling out the form','Book an appointment','Consult with a specialist','Diagnostic tests if required','Easy payment options'] as $step)
                    <li class="flex items-start gap-4">
                        <span class="flex items-center justify-center w-6 h-6 mt-0.5 rounded-full border border-[#8b6f47] bg-[#e7d8c9] text-[#8b6f47] text-xs flex-shrink-0">
                            <i class="fa-solid fa-check"></i>
                        </span>
                        <span>{{ $step }}</span>
                    </li>
                    @endforeach
                </ul>

                <div class="bg-[#8b6f47] text-white flex flex-col sm:flex-row sm:items-center gap-4 px-6 py-4 rounded-xl mt-8 md:mt-10 w-full sm:w-fit shadow-md">
                    <div>
                        <p class="text-xs uppercase mb-3">We Always Take Care Of Your Skin</p>
                        <p class="text-xl text-center font-semibold">24/7 Emergency</p>
                        <div class="flex items-center justify-center mt-2">
                            <i class="fa-solid fa-phone-volume mr-3"></i>
                            <p class="text-xs">7030319520</p>
                        </div>
                    </div>
                </div>
            </div>


            <!-- ✅ Right Section (FORM) -->
            <div class="bg-[#8b6f47] text-white p-8 sm:p-10 rounded-xl shadow-lg">
                <h2 class="text-2xl md:text-3xl font-semibold mb-8">Schedule A Consultation</h2>

                <form id="consultationForm" action="{{ route('consultation.store') }}" method="POST" class="space-y-2 md:space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm mb-2">Hello I am*</label>
                        <input type="text" name="name" required value="{{ old('name') }}" placeholder="Enter Name"
                            class="w-full bg-transparent border-b border-[#d6c1a3] focus:outline-none focus:border-white py-2 text-sm placeholder-[#e7d8c9]">
                    </div>

                    <div>
                        <label class="block text-sm mb-2">I am Looking It For Treatments*</label>
                        <select name="treatment_id" required
                            class="w-full bg-transparent border-b border-[#d6c1a3] focus:outline-none focus:border-white py-2 text-sm text-[#e7d8c9]">
                            <option selected disabled>Select Treatments</option>
                            @foreach(App\Models\Treatment::orderBy('title')->get() as $t)
                            <option value="{{ $t->id }}" class="text-[#3c2c20]">{{ $t->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm mb-2">Date To Fix A Surgery Or Treatments*</label>
                        <input type="date" name="preferred_date" required value="{{ old('preferred_date') }}"
                            min="{{ date('Y-m-d') }}"
                            class="w-full bg-transparent border-b border-[#d6c1a3] focus:outline-none focus:border-white py-2 text-sm text-[#e7d8c9]">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm mb-2">Your Contact Number</label>
                            <input type="text" name="contact_number" value="{{ old('contact_number') }}" placeholder="Enter Contact"
                                class="w-full bg-transparent border-b border-[#d6c1a3] focus:outline-none py-2 text-sm placeholder-[#e7d8c9]">
                        </div>

                        <div>
                            <label class="block text-sm mb-2">Your Email ID</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter Email"
                                class="w-full bg-transparent border-b border-[#d6c1a3] focus:outline-none py-2 text-sm placeholder-[#e7d8c9]">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm mb-2">Message</label>
                        <textarea rows="3" name="message" placeholder="Enter Message"
                            class="w-full bg-transparent border-b border-[#d6c1a3] focus:outline-none py-2 text-sm placeholder-[#e7d8c9]">{{ old('message') }}</textarea>
                    </div>

                    <button id="submitButton" type="submit"
                        class="bg-[#d6c1a3] text-[#3c2c20] font-semibold px-6 py-2 rounded-full hover:bg-[#c9af8e] transition duration-300 flex items-center justify-center gap-2">
                        <span>Submit Now</span>
                    </button>
                </form>

                <script>
                    document.getElementById('consultationForm').addEventListener('submit', function() {
                        const btn = document.getElementById('submitButton');
                        btn.disabled = true;
                        btn.classList.add("opacity-70", "cursor-not-allowed");
                        btn.innerHTML = `<span class="animate-pulse">⏳ Sending...</span>`;
                    });
                </script>
            </div>

        </div>
    </div>
</section>