@extends('layouts.app')

@section('title', 'Appointment - Revola Clinic')

@section('meta')
<meta name="description" content="Book your appointment at Revola Clinic for expert dermatology services. Choose between online or personal consultations and select your preferred date and time." />
<meta name="keywords" content="Book Appointment, Dermatology Services, Online Consultation, Personal Consultation, Revola Clinic" />
@endsection

@section('content')

<x-centered-text
    line1="Appointment - 1"
    line2="Home - Appointment" />

<div class="max-w-5xl mx-auto my-12 sm:my-16 px-4 sm:px-6 lg:px-8">
    <!-- Consultation Type Selection -->
    <div class="flex flex-col sm:flex-row justify-center gap-4 sm:gap-6 mb-8">
        <button id="onlineBtn"
            class="flex flex-col items-center w-full sm:w-auto p-4 sm:p-6 rounded-lg border-2 border-[#8b6f47] bg-[#8b6f47] text-white transition-all duration-300">
            <span class="font-semibold text-sm sm:text-base">Online Consultation</span>
        </button>
        <button id="personalBtn"
            class="flex flex-col items-center w-full sm:w-auto p-4 sm:p-6 rounded-lg border-2 border-[#8b6f47] bg-[#fdf7ef] text-[#8b6f47] transition-all duration-300">
            <span class="font-semibold text-sm sm:text-base">Personal Consultation</span>
        </button>
    </div>

    <!-- Appointment Form -->
    <div class="bg-[#f1e9dd] p-6 sm:p-8 rounded-2xl shadow-md">
        <form id="appointmentForm" class="space-y-8">
            <!-- Patient Details -->
            <div>
                <h2 class="text-xl font-semibold mb-4 text-center sm:text-left">Patient Details*</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label for="firstName" class="block font-medium mb-1 ml-1">First Name</label>
                        <input type="text" id="firstName" name="first_name" placeholder="Your First Name"
                            class="border border-gray-300 p-2 rounded-lg w-full focus:ring-2 focus:ring-[#8b6f47]" />
                    </div>
                    <div>
                        <label for="lastName" class="block font-medium mb-1 ml-1">Last Name</label>
                        <input type="text" id="lastName" name="last_name" placeholder="Your Last Name"
                            class="border border-gray-300 p-2 rounded-lg w-full focus:ring-2 focus:ring-[#8b6f47]" />
                    </div>
                    <div>
                        <label for="age" class="block font-medium mb-1 ml-1">Age</label>
                        <input type="number" id="age" name="age" placeholder="Your Age"
                            class="border border-gray-300 p-2 rounded-lg w-full focus:ring-2 focus:ring-[#8b6f47]" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="email" class="block font-medium mb-1 ml-1">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Your Email Address"
                            class="border border-gray-300 p-2 rounded-lg w-full focus:ring-2 focus:ring-[#8b6f47]" />
                    </div>
                    <div>
                        <label for="mobile" class="block font-medium mb-1 ml-1">Mobile Number</label>
                        <input type="text" id="mobile" name="mobile" placeholder="Your Mobile Number"
                            class="border border-gray-300 p-2 rounded-lg w-full focus:ring-2 focus:ring-[#8b6f47]" />
                    </div>
                </div>

                <div class="mb-4">
                    <label for="address" class="block font-medium mb-1 ml-1">Address</label>
                    <input type="text" id="address" name="address" placeholder="Your Address"
                        class="border border-gray-300 p-2 rounded-lg w-full focus:ring-2 focus:ring-[#8b6f47]" />
                </div>
            </div>

            <!-- Appointment Details -->
            <div>
                <h2 class="text-xl font-semibold mb-4 text-center sm:text-left">Appointment Details*</h2>

                <div class="mb-4">
                    <label for="service" class="block font-medium mb-1 ml-1">Select Service</label>
                    <select id="service" name="service"
                        class="border border-gray-300 p-2 rounded-lg w-full focus:ring-2 focus:ring-[#8b6f47]">
                        <option value="">Select Our Treatments</option>
                        <option value="Consultation">Consultation</option>
                        <option value="Skin Care">Skin Care</option>
                        <option value="Laser Treatment">Laser Treatment</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label for="date" class="block font-medium mb-1 ml-1">Appointment Date</label>
                        <input type="date" id="date" name="date"
                            class="border border-gray-300 p-2 rounded-lg w-full focus:ring-2 focus:ring-[#8b6f47]" />
                    </div>
                    <div>
                        <label for="time" class="block font-medium mb-1 ml-1">Appointment Time</label>
                        <input type="time" id="time" name="time"
                            class="border border-gray-300 p-2 rounded-lg w-full focus:ring-2 focus:ring-[#8b6f47]" />
                    </div>
                    <div>
                        <label for="branch" class="block font-medium mb-1 ml-1">Select Branch</label>
                        <select id="branch" name="branch"
                            class="border border-gray-300 p-2 rounded-lg w-full focus:ring-2 focus:ring-[#8b6f47]">
                            <option value="Los Angeles, CA">Los Angeles, CA</option>
                            <option value="New York, NY">New York, NY</option>
                            <option value="Chicago, IL">Chicago, IL</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="message" class="block font-medium mb-1 ml-1">Message</label>
                    <textarea id="message" name="message" placeholder="You can write here"
                        class="border border-gray-300 p-2 rounded-lg w-full h-28 focus:ring-2 focus:ring-[#8b6f47]"></textarea>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center sm:justify-start gap-4 sm:gap-6 mt-6">
                <button type="button" id="previewBtn"
                    class="px-4 py-2 border border-black rounded-lg w-full sm:w-auto hover:bg-gray-100 transition">PREVIEW</button>
                <button type="button" id="downloadBtn"
                    class="px-4 py-2 border border-black rounded-lg w-full sm:w-auto hover:bg-gray-100 transition">DOWNLOAD</button>
                <button type="submit"
                    class="px-4 py-2 bg-[#8b6f47] text-white rounded-lg w-full sm:w-auto hover:bg-[#7a5f3f] transition">BOOK
                    APPOINTMENT</button>
            </div>
        </form>

        <!-- Preview Section -->
        <div id="previewSection"
            class="mt-6 p-4 sm:p-6 bg-white border rounded-lg hidden overflow-auto text-sm sm:text-base">
            <h3 class="font-semibold text-lg mb-2 text-center sm:text-left">Appointment Preview:</h3>
            <div id="previewContent"></div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('appointmentForm');
        const previewBtn = document.getElementById('previewBtn');
        const downloadBtn = document.getElementById('downloadBtn');
        const previewSection = document.getElementById('previewSection');
        const previewContent = document.getElementById('previewContent');
        const onlineBtn = document.getElementById('onlineBtn');
        const personalBtn = document.getElementById('personalBtn');
        let consultationType = "Online";

        function setActiveButton(activeBtn, inactiveBtn) {
            activeBtn.classList.add('bg-[#8b6f47]', 'text-white');
            activeBtn.classList.remove('bg-[#fdf7ef]', 'text-[#8b6f47]');
            inactiveBtn.classList.add('bg-[#fdf7ef]', 'text-[#8b6f47]');
            inactiveBtn.classList.remove('bg-[#8b6f47]', 'text-white');
        }

        setActiveButton(onlineBtn, personalBtn);

        onlineBtn.addEventListener('click', () => {
            consultationType = 'Online';
            setActiveButton(onlineBtn, personalBtn);
        });

        personalBtn.addEventListener('click', () => {
            consultationType = 'Personal';
            setActiveButton(personalBtn, onlineBtn);
        });

        function getFormData() {
            return {
                type: consultationType,
                firstName: document.getElementById('firstName').value,
                lastName: document.getElementById('lastName').value,
                age: document.getElementById('age').value,
                email: document.getElementById('email').value,
                mobile: document.getElementById('mobile').value,
                address: document.getElementById('address').value,
                service: document.getElementById('service').value,
                date: document.getElementById('date').value,
                time: document.getElementById('time').value,
                branch: document.getElementById('branch').value,
                message: document.getElementById('message').value
            };
        }

        previewBtn.addEventListener('click', () => {
            const data = getFormData();
            previewContent.innerHTML = `
                <p><strong>Consultation Type:</strong> ${data.type}</p>
                <p><strong>Name:</strong> ${data.firstName} ${data.lastName}</p>
                <p><strong>Age:</strong> ${data.age}</p>
                <p><strong>Email:</strong> ${data.email}</p>
                <p><strong>Mobile:</strong> ${data.mobile}</p>
                <p><strong>Address:</strong> ${data.address}</p>
                <p><strong>Service:</strong> ${data.service}</p>
                <p><strong>Date & Time:</strong> ${data.date} at ${data.time}</p>
                <p><strong>Branch:</strong> ${data.branch}</p>
                <p><strong>Message:</strong> ${data.message}</p>`;
            previewSection.classList.remove('hidden');
        });

        downloadBtn.addEventListener('click', () => {
            const data = getFormData();
            const text = `
Consultation Type: ${data.type}
Name: ${data.firstName} ${data.lastName}
Age: ${data.age}
Email: ${data.email}
Mobile: ${data.mobile}
Address: ${data.address}
Service: ${data.service}
Date & Time: ${data.date} at ${data.time}
Branch: ${data.branch}
Message: ${data.message}`;
            const blob = new Blob([text], {
                type: 'text/plain'
            });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'appointment.txt';
            link.click();
        });

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Appointment booked successfully!');
            form.reset();
            consultationType = "Online";
            setActiveButton(onlineBtn, personalBtn);
            previewSection.classList.add('hidden');
        });
    });
</script>
@endpush