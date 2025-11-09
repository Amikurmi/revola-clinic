@extends('layouts.app')

@section('title', 'Contact Us - Revola Clinic')

@section('meta')
<meta name="description" content="Get in touch with Revola Clinic for all your skin and hair care needs. Visit us, call, or send a message to book an appointment." />
<meta name="keywords" content="Contact Revola Clinic, Skin Care Contact, Hair Care Contact, Book Appointment, Clinic Address, Clinic Phone Number" />
@endsection

@section('content')

<x-centered-text
    line1="Contact Us"
    line2="Home - Contact Us" />

<section class="py-12 sm:py-16 md:py-20 px-4 sm:px-8 lg:px-16 bg-white text-[#3c2c20]">
    <div class="container mx-auto">

        <!-- Top Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center md:items-start">

            <!-- 🧭 Left Side -->
            <div>
                <!-- Header -->
                <span class="inline-block bg-[#e7d8c9] text-[#8b6f47] px-4 py-1.5 sm:px-6 sm:py-2 rounded-full font-medium text-xs sm:text-sm mb-4">
                    Our Address
                </span>
                <h2 class="text-2xl md:text-4xl font-bold mb-4">Connecting Near & Far</h2>
                <p class="text-gray-600 text-sm sm:text-base mb-2">
                    We're here to help you with all your skin and hair care needs. Visit or contact us anytime!
                </p>

                <!-- Head Quarters Info -->
                <h3 class="font-semibold text-lg sm:text-xl mb-6">Head Office</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 sm:gap-8 mb-6">
                    <!-- Visit -->
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center rounded-full border border-[#8b7355] text-[#8b7355] text-base sm:text-lg">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm md:text-lg">Visit Us</h4>
                            <a href="https://maps.app.goo.gl/7Ygr91o8m1zaQKgk6"
                                target="_blank"
                                class="hover:underline  text-xs md:text-sm  block">
                                Revola Skin and Hair Clinic<br>
                                1st floor, Block No. B-1, Srinivas Apartment,<br>
                                Bajaj Nagar, Nagpur, Maharashtra 440010
                            </a>
                        </div>
                    </div>

                    <!-- Call -->
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center rounded-full border border-[#8b7355] text-[#8b7355] text-base sm:text-lg">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm md:text-lg">Give Us a Call</h4>
                            <p class="hover:underline  text-xs md:text-sm mt-1 block">
                                <a href="tel:+917030319520" class="hover:underline">
                                    7030319520 (Call)
                                </a>
                            </p>
                            <p class="hover:underline  text-xs md:text-sm mt-1 block">
                                <a href="https://wa.me/917030319520?text=Hi%20Revola%20Clinic"
                                    target="_blank"
                                    class="hover:underline">
                                    7030319520 (WhatsApp)
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 my-10 sm:my-12"></div>

                <!-- Timings & Email -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 sm:gap-8">
                    <!-- Timings -->
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center rounded-full border border-[#8b7355] text-[#8b7355] text-base sm:text-lg">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm md:text-lg">Clinic Hours</h4>
                            <p class="text-xs md:text-sm font-medium">Monday – Sunday</p>
                            <p class="text-xs md:text-sm text-gray-600">10:00 AM – 8:00 PM</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center rounded-full border border-[#8b7355] text-[#8b7355] text-base sm:text-lg">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm md:text-lg">Send Message</h4>
                            <p class="text-xs md:text-sm ">
                                <a href="https://mail.google.com/mail/u/0/?view=cm&fs=1&to=revolaclinic@gmail.com&su=Appointment%20Inquiry&body=Hello%20Revola%20Clinic,%20I%20would%20like%20to%20book%20an%20appointment."
                                    target="_blank"
                                    class="hover:underline">
                                    revolaclinic@gmail.com
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 🗺️ Right Side (Map) -->
            <div class="rounded-2xl overflow-hidden shadow-md w-full h-64 sm:h-80 md:h-[450px] lg:h-[500px] relative group">
                <!-- Embedded Map -->
                <iframe
                    src="https://www.google.com/maps?q=Revola+Skin+and+Hair+Clinic,+1st+floor,+Block+No.+B-1,+Srinivas+Apartment,+Bajaj+Nagar,+Nagpur,+Maharashtra+440010&output=embed"
                    width="100%"
                    height="100%"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>

                <!-- View Directions Button -->
                <a href="https://www.google.com/maps/dir/?api=1&destination=Revola+Skin+and+Hair+Clinic,+1st+floor,+Block+No.+B-1,+Srinivas+Apartment,+Bajaj+Nagar,+Nagpur,+Maharashtra+440010"
                    target="_blank"
                    class="absolute bottom-4 right-4 bg-[#8b7355] text-white text-xs sm:text-sm font-medium px-4 py-2 rounded-full shadow-md opacity-90 hover:opacity-100 transition">
                    📍 Get Directions
                </a>
            </div>

        </div>

    </div>
</section>

@endsection