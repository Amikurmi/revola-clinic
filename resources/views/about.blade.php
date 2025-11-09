@extends('layouts.app')

@section('title', 'About Us - Revola Clinic')

@section('meta')
<meta name="description" content="Learn more about Revola Clinic, our mission, values, and the expert team dedicated to providing top-notch dermatology care." />
<meta name="keywords" content="About Revola Clinic, Dermatology Experts, Skin Care Mission, Clinic Values, Dermatology Team" />
@endsection

@section('content')

<x-centered-text
    line1="About Us"
    line2="Home - About Us" />

<x-specialist />

<!-- Treatments Section -->
<x-treatments :services="$services" />

<x-service-section />


<section class="bg-gray-50 py-10 px-4 sm:px-6 lg:px-20 ">
    <div class="max-w-7xl mx-auto">

        <div class="flex flex-col lg:flex-row items-start gap-10 mb-12">

            <!-- Image -->
            <div class="w-full lg:w-1/2 order-1 lg:order-none">
                <img src="{{ asset('images/katkar1.jpg') }}"
                    alt="Medical Team"
                    class="rounded-xl shadow-md w-full sm:w-4/5 object-cover h-[370px] md:h-[600px] mx-auto">
            </div>

            <!-- Content -->
            <div class="w-full lg:w-1/2 order-2 lg:order-none mt-6 lg:mt-0 text-center lg:text-left">

                <div class="inline-block bg-[#f1e9dd] text-amber-800 px-3 py-1 rounded-full text-xs sm:text-sm font-medium mb-4">
                    Our Achievements & Awards
                </div>

                <h1 class="text-xl md:text-4xl font-semibold text-gray-900 mb-4 leading-snug">
                    Best Service Awards
                </h1>

                <p class="text-gray-600 mb-8 text-sm md:text-lg leading-relaxed">
                    Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.
                    Lorem Ipsum Has Been The Industry's Standard Dummy Text Ever Since The 1500s.
                </p>

                <!-- Awards List -->
                <div class="space-y-6 sm:space-y-8">

                    <x-award-card
                        title="Best Surgery"
                        date="JAN 2024"
                        category="For Surgery"
                        description="Porttitor Massa Id Neque Aliquam Vestibulum"
                        bgColor="bg-white"
                        facebookUrl="https://facebook.com"
                        twitterUrl="https://x.com"
                        instagramUrl="https://instagram.com" />

                    <x-award-card
                        title="Ozone Therapy"
                        date="JAN 2023"
                        category="For Therapy"
                        description="Porttitor Massa Id Neque Aliquam Vestibulum"
                        bgColor="bg-[#8b6f47] text-white"
                        facebookUrl="https://facebook.com"
                        twitterUrl="https://x.com"
                        instagramUrl="https://instagram.com" />

                    <x-award-card
                        title="Skin Care"
                        date="JAN 2022"
                        category="For Skin Care"
                        description="Porttitor Massa Id Neque Aliquam Vestibulum"
                        bgColor="bg-white"
                        facebookUrl="https://facebook.com"
                        twitterUrl="https://x.com"
                        instagramUrl="https://instagram.com" />

                </div>
            </div>
        </div>
    </div>
</section>




@endsection