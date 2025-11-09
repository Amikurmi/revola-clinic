<!-- Enquiry Popup Component -->
<div>
    <!-- Buttons -->
    <div class="flex flex-col sm:flex-row justify-center md:justify-start gap-4 pt-0 md:pt-6">
        <!-- Book Now -->
        <x-button onclick="window.location.href='{{ url('/user/appointments') }}'"
            bg="#7a5a3a" color="white" class="py-3 text-sm sm:text-base">
            <i class="fa-solid fa-phone-volume mr-1 md:mr-2"></i> Book Now
        </x-button>

        <!-- Enquiries -->
        <x-button onclick="openPopup()"
            class="border border-[#7a5a3a] text-[#7a5a3a] hover:bg-[#7a5a3a] hover:text-white py-3 text-sm sm:text-base">
            <i class="fa-solid fa-envelope mr-1 md:mr-2"></i> Enquiries
        </x-button>
    </div>

    <!-- Popup Form -->
    <div id="popupForm" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
        <div class="bg-white rounded-2xl p-6 w-11/12 sm:w-96 shadow-lg relative">
            <button onclick="closePopup()" class="absolute top-2 right-3 text-gray-500 hover:text-gray-800 text-lg">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <h2 class="text-lg font-bold text-center mb-4 text-[#7a5a3a]">Send Your Enquiry</h2>

            <form id="enquiryForm">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" name="name" required maxlength="50"
                        placeholder="Enter your full name"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#7a5a3a]">
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" required
                        placeholder="example@email.com"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#7a5a3a]">
                </div>

                <!-- Mobile -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mobile Number</label>
                    <input
                        type="text"
                        name="mobile"
                        required
                        minlength="10"
                        maxlength="10"
                        pattern="[0-9]{10}"
                        placeholder="Enter 10 digit mobile number"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#7a5a3a]">
                </div>

                <!-- Message -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                    <textarea name="message" rows="3" required maxlength="2000"
                        placeholder="Write your message (max 2000 characters)"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#7a5a3a]"></textarea>
                </div>

                <button type="submit"
                    class="w-full bg-[#7a5a3a] text-white rounded-lg py-2 hover:bg-[#60462b] transition">
                    Submit Enquiry
                </button>
            </form>


            <p id="successMsg" class="hidden text-green-600 font-medium mt-4 text-center"></p>
        </div>
    </div>

    <!-- JS -->
    <script>
        function openPopup() {
            document.getElementById('popupForm').classList.remove('hidden');
            document.getElementById('successMsg').classList.add('hidden');
            document.getElementById('enquiryForm').classList.remove('hidden');
        }

        function closePopup() {
            document.getElementById('popupForm').classList.add('hidden');
        }

        document.querySelector('input[name="mobile"]').addEventListener("input", function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
        
        document.getElementById('enquiryForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const form = this;
            const submitBtn = form.querySelector('button[type="submit"]');
            const successMsg = document.getElementById('successMsg');

            submitBtn.disabled = true;
            submitBtn.textContent = 'Submitting...';

            try {
                const response = await fetch('{{ route("enquiry.store") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: new FormData(form)
                });

                const data = await response.json();

                if (data.success) {
                    form.reset();
                    form.classList.add('hidden');
                    successMsg.textContent = data.message;
                    successMsg.classList.remove('hidden');

                    // ✅ Auto close after 3 seconds
                    setTimeout(() => closePopup(), 3000);
                } else {
                    successMsg.textContent = 'Something went wrong. Please try again.';
                    successMsg.classList.remove('hidden');
                }

            } catch (error) {
                successMsg.textContent = 'Error submitting form. Please try again.';
                successMsg.classList.remove('hidden');
            }

            setTimeout(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Submit Enquiry';
            }, 2000);
        });
    </script>
</div>