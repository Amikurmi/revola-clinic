@extends('layouts.app')

@section('title', 'Pricing Plans - Revola Clinic')

@section('meta')
<meta name="description" content="Explore the pricing plans at Revola Clinic. Choose from our Personal, Professional, and Free Consultation packages tailored to your dermatology needs." />    
<meta name="keywords" content="Pricing Plans, Dermatology Packages, Personal Plan, Professional Plan, Free Consultation, Revola Clinic" />
@endsection

@section('content')

<x-centered-text
    line1="Pricing Plans"
    line2="Home - Pricing Plans" />



<div class="container mx-auto py-8 md:py-16 px-4 md:px-0">

    <div class="text-center  mb-12 ">
        <!-- Content -->
        <div class="w-full ">
            <div class="inline-block bg-[#f1e9dd] text-amber-800 px-4 py-2 rounded-full text-xs md:text-sm font-medium mb-4">
                Our Achievements Awards
            </div>
            <h1 class="text-2xl md:text-5xl font-semibold text-gray-900 mb-0 md:mb-4">Best Service Awards</h1>
            <p class="text-gray-600 text-sm md:text-lg px-4 md:px-0 mb-8">
                Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry. <br> Lorem Ipsum Has Been The Industry's
            </p>

        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

        <x-pricing-card
            title="Personal Plan"
            price="$29"
            duration="Per Month"
            :features="['One-One Consulation', 'Expert Advice And Guidance Skin Care Solutions To Pecific', 'Flexible Treatments Detailed Competitor', 'Analysis 2 Hours Of Consulting Treatments Held Skincare Solutions', 'Laser Treatments Estabkishme', 'Expert Advice and Guidance', 'Skin Care Solutions To Pecific']"
            icon='<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
              </svg>'
            bgColor="#f1e9dd"
            textColor="text-gray-800"
            buttonText="Get Started"
            buttonUrl="#" />

        <x-pricing-card
            title="Professional Plan"
            price="$59"
            duration="Per Month"
            :features="['One-One Consulation', 'Expert Advice And Guidance Skin Care Solutions To Pecific', 'Flexible Treatments Detailed Competitor', 'Analysis 2 Hours Of Consulting Treatments Held Skincare Solutions', 'Laser Treatments Estabkishme', 'Expert Advice and Guidance', 'Skin Care Solutions To Pecific']"
            icon='<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
              </svg>'
            bgColor="#8B7355"
            textColor="text-white"
            buttonText="Get Started"
            buttonUrl="#" />

        <x-pricing-card
            title="Let's Talk"
            price="$59"
            duration="Per Month"
            :features="['One-One Consulation', 'Expert Advice And Guidance Skin Care Solutions To Pecific', 'Flexible Treatments Detailed Competitor', 'Analysis 2 Hours Of Consulting Treatments Held Skincare Solutions', 'Laser Treatments Estabkishme', 'Expert Advice and Guidance', 'Skin Care Solutions To Pecific']"
            icon='<i class="fa-solid fa-paper-plane text-white text-2xl"></i>'
            bgColor="#f1e9dd"
            textColor="text-gray-800"
            buttonText="Get Started"
            buttonUrl="#" />

        <x-pricing-card
            title="Free Consultation"
            :isImageCard="true"
            image="https://images.unsplash.com/photo-1616394584738-fc6e612e71b9?w=400&h=600&fit=crop"
            price="Starting Tomorrow"
            buttonText="Contact Us"
            buttonUrl="#" />

    </div>

</div>


<x-customer-reviews :reviews="[
    [
        'image' => 'images/1.jpeg',
        'name' => 'Sophia Turner',
        'designation' => 'Cosmetic Specialist',
        'rating' => 5,
        'text' => 'Excellent service and very friendly staff. I am totally satisfied with the results!'
    ],
    [
        'image' => 'images/1.jpeg',
        'name' => 'Sophia Turner',
        'designation' => 'Cosmetic Specialist',
        'rating' => 5,
        'text' => 'Excellent service and very friendly staff. I am totally satisfied with the results!'
    ],
    [
        'image' => 'images/1.jpeg',
        'name' => 'Sophia Turner',
        'designation' => 'Cosmetic Specialist',
        'rating' => 5,
        'text' => 'Excellent service and very friendly staff. I am totally satisfied with the results!'
    ],
    
]" />


<div>
    <div class="text-center my-12 ">
        <!-- Content -->
        <div class="w-full ">
            <div class="inline-block bg-[#f1e9dd] text-amber-800 px-4 py-2 rounded-full text-xs md:text-sm font-medium mb-4">
                Featured Post
            </div>
            <h1 class="text-2xl md:text-5xl font-semibold text-gray-900 mb-4">Our Insurance Company <br> Over World</h1>
            <p class="text-gray-600 mb-8 text-sm md:text-lg px-6 md:px-0">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos nulla voluptates laudantium aliquid <br>reiciendis iusto eaque odit quaerat maiores dolorum.
            </p>

        </div>
    </div>
    <x-derma-card />
</div>

@endsection