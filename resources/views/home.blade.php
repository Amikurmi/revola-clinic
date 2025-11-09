@extends('layouts.app')

@section('title', 'Home - Revola Clinic')

@section('meta')
<meta name="description" content="Revola Clinic offers expert dermatology services including skin treatments, hair care, and cosmetic solutions. Book your appointment today for personalized care." />
<meta name="keywords" content="Dermatology Services, Skin Treatments, Hair Care, Cosmetic Solutions, Book Appointment, Revola Clinic" />
@endsection

@section('content')
<!-- Hero Section -->
<x-hero />

<!-- Treatments Section -->
<x-treatments :services="$services" />

<!-- Hero Treatments Section -->
<x-hero-treatments
    title1="Get 20% Offer On Amazing Skin Mole Removal Treatments"
    subtitle1="Skin Care Dermatology Treatments"
    buttonText1="View More"
    :image1="asset('images/skinMole.jpeg')"
    title2="Get 20% Offer On Amazing Skin Mole Removal Treatments"
    subtitle2="Professional Cosmetic Skin Care Solutions"
    buttonText2="View More"
    :image2="asset('images/2.jpg')"
    title3="Cosmetic Skin Care Treatments"
    subtitle3="Advanced Laser Treatments"
    buttonText3="Healthy Skin & Natural"
    :image3="asset('images/skincare.webp')" />

<x-specialist />

<x-treatment-section />




<!-- Before & After Slider Section -->
<x-before-after-slider
    label="Skin Treatments Portfolio"
    title="Skin Care Of Before & After"
    description="Lorem Ipsum is simply dummy text of the printing and typesetting industry."
    :items="[
        ['image' => 'images/Gallary/p1.jpg'],
        ['image' => 'images/Gallary/p2.jpg'],
        ['image' => 'images/Gallary/p3.jpg'],
        ['image' => 'images/Gallary/p8.jpg'],
        ['image' => 'images/Gallary/p9.jpg'],
        ['image' => 'images/Gallary/p10.jpg'],  
        ['image' => 'images/Gallary/p12.jpg'],
        ['image' => 'images/Gallary/p13.jpg'],      
        ['image' => 'images/Gallary/p15.jpg'],
        ['image' => 'images/Gallary/p16.jpg'],
    ]" />




<!-- ============================= -->
<!-- Doctors Section with Carousel -->
<!-- ============================= -->
<section class="bg-[#f1e9dd] py-6 md:py-16 relative overflow-hidden">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-12 gap-3 lg:gap-16">
            <!-- Left Heading -->
            <div class="flex-1 text-center lg:text-left">
                <span class="text-xs md:text-sm bg-[#e6dbc9] text-[#8b7760] px-4 py-1 rounded-full inline-block">
                    Booking Our Specialist
                </span>
                <h2 class="text-xl sm:text-3xl lg:text-5xl font-semibold mt-4 text-[#3c2c20] leading-tight">
                    Our Leading Skincare Specialist
                </h2>
            </div>

            <!-- Right Description -->
            <div class="flex-1 text-gray-600 text-center lg:text-left text-sm lg:text-lg">
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum ab deserunt vero odit tempore omnis exercitationem nisi molestiae eum officia!
                </p>
                <a href="#" class="text-[#b18457] underline mt-3 inline-block hover:text-[#8b7760] transition">
                    Browse All Dermatology Doctors
                </a>
            </div>
        </div>
    </div>

    <!-- Swiper Carousel Container -->
    <div class="relative px-2 sm:px-6 md:px-10 lg:px-[150px]">
        <!-- Navigation Arrows (Font Awesome) -->
        <div
            class="swiper-button-prev-custom absolute left-1 sm:left-6 md:left-8 lg:left-10 top-1/2 z-10 cursor-pointer">
            <i class="fas fa-chevron-left text-2xl sm:text-3xl text-[#b18457] hover:text-[#8b7760]"></i>
        </div>
        <div
            class="swiper-button-next-custom absolute right-2 sm:right-6 md:right-8 lg:right-10 top-1/2  z-10 cursor-pointer">
            <i class="fas fa-chevron-right text-2xl sm:text-3xl text-[#b18457] hover:text-[#8b7760] "></i>
        </div>

        <!-- Swiper Wrapper -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <!-- Example Slides -->
                @foreach ([
                ['1.jpeg', 'Dr. John William', 'Dermatologist'],
                ['katkar1.jpg', 'Dr. Shraddha Katkar', 'Cosmetologist'],
                ['1.jpeg', 'Dr. David Lee', 'Dermatologist'],
                ['katkar2.jpg', 'Dr. Shraddha Katkar'],
                ['1.jpeg', 'Dr. David Lee'],
                ['katkar2.jpg', 'Dr. Shraddha Katkar'],
                ] as $doctor)
                <div class="swiper-slide">
                    <x-doctor-card
                        image="{{ asset('images/' . $doctor[0]) }}"
                        name="{{ $doctor[1] }}"
                        specialization="{{ $doctor[2] ?? 'Dermatologist' }}"
                        rating="4.8" />
                </div>
                @endforeach
            </div>

            <!-- Pagination Dots -->
            <div class="swiper-pagination mt-8"></div>
        </div>
    </div>
</section>


<x-customer-reviews :reviews="[
    [
        'image' => 'images/1.jpeg',
        'name' => 'Amit Kumar',
        'designation' => 'Hair Reduction',
        'rating' => 5,
        'text' => 'Excellent service and very friendly staff. I am totally satisfied with the results!'
    ],
    [
        'image' => 'images/1.jpeg',
        'name' => 'Amit Kumar',
        'designation' => 'Hair Reduction',
        'rating' => 5,
        'text' => 'Excellent service and very friendly staff. I am totally satisfied with the results!'
    ],
    [
        'image' => 'images/1.jpeg',
        'name' => 'Amit Kumar',
        'designation' => 'Hair Reduction',
        'rating' => 5,
        'text' => 'Excellent service and very friendly staff. I am totally satisfied with the results!'
    ],
    
]" />


<x-dermatology-consultation />


<x-appointment-banner />

<!-- Testimonials Section -->
<section class="py-20 bg-[#f1e9dd]">
    <div class="max-w-7xl mx-auto text-center px-6">
        <h2 class="text-4xl font-extrabold text-[#3c2c20] drop-shadow-sm mb-3">
            Our Happy Clients
        </h2>
        <p class="text-gray-600 mb-14">Real Stories • Real Confidence • Real Results</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            <!-- Video Testimonial 1 -->
            <div class="rounded-3xl overflow-hidden shadow-xl border border-[#e7dcc8] hover:shadow-2xl hover:-translate-y-2 transition duration-500 bg-white">
                <video controls class="w-full h-[350px] md:h-[500px] object-cover">
                    <source src="/images/Gallary/1.mp4" type="video/mp4">
                </video>
            </div>

            <!-- Video Testimonial 2 -->
            <div class="rounded-3xl overflow-hidden shadow-xl border border-[#e7dcc8] hover:shadow-2xl hover:-translate-y-2 transition duration-500 bg-white">
                <video controls class="w-full h-[350px] md:h-[500px] object-cover">
                    <source src="/images/Gallary/2.mp4" type="video/mp4">
                </video>
            </div>

            <!-- Video Testimonial 3 (Optional Placeholder / Add Later) -->
            <div class="rounded-3xl overflow-hidden shadow-xl border border-[#e7dcc8] hover:shadow-2xl hover:-translate-y-2 transition duration-500 bg-white">
                <video controls class="w-full h-[350px] md:h-[500px] object-cover">
                    <source src="/images/Gallary/3.mp4" type="video/mp4">
                </video>
            </div>

        </div>

        <!-- See More Button -->
        <div class="mt-14">
            <a href="{{ route('gallery.page') }}"
                class="px-8 py-3 text-lg font-semibold rounded-full bg-[#8b6f47] text-white hover:bg-[#6b5337] transition">
                View Full Gallery <i class="fa-solid fa-arrow-right"></i>

            </a>
        </div>
    </div>
</section>






@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            centeredSlides: false,
            navigation: {
                nextEl: ".swiper-button-next-custom",
                prevEl: ".swiper-button-prev-custom",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true, // Shows 5–6 dots only
            },
            breakpoints: {
                480: {
                    slidesPerView: 1.2,
                    spaceBetween: 20,
                },
                640: {
                    slidesPerView: 1.5,
                    spaceBetween: 24,
                },
                768: {
                    slidesPerView: 2.2,
                    spaceBetween: 24,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 28,
                },
                1280: {
                    slidesPerView: 4,
                    spaceBetween: 32,
                },
            },
        });
    });
</script>
@endpush

@push('styles')
<style>
    /* Modern Pagination Dots */
    .swiper-pagination-bullet {
        background: #b18457;
        opacity: 0.4;
        width: 8px;
        height: 8px;
        margin: 0 4px !important;
        transition: all 0.3s ease;
    }

    .swiper-pagination-bullet-active {
        background: #8b7760;
        opacity: 1;
        width: 18px;
        height: 8px;
        border-radius: 10px;
    }



    /* Ensure arrows don't overlap slides on small screens */
    @media (max-width: 640px) {
        .swiper-button-prev-custom {
            top: 150px;
            left: 4px;
        }

        .swiper-button-next-custom {
            top: 150px;
            right: 4px;
        }

        .swiper-button-prev-custom i,
        .swiper-button-next-custom i {
            font-size: 1.5rem;
        }
    }

    /* Adjust spacing for smaller screens */
    @media (max-width: 1024px) {
        section {
            padding: 12px;
        }
    }
</style>
@endpush