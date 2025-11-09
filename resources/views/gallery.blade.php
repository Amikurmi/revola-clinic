@extends('layouts.app')

@section('title', 'Gallery - Revola Clinic')

@section('meta')
<meta name="description" content="Explore the gallery of real transformations at Revola Clinic. Watch video testimonials and view before-and-after photos of our satisfied patients." />
<meta name="keywords" content="Gallery, Real Transformations, Video Testimonials, Photo Gallery, Before and After, Revola Clinic" />
@endsection

@section('content')

<x-centered-text
    line1="Gallery of Our Real Transformations"
    line2="Home - Gallery of Our Real Transformations" />

<div class="bg-[#f7f5f0] py-16">
    <div class="max-w-7xl mx-auto px-6">

        <h1 class="text-2xl md:text-4xl font-extrabold text-center text-[#3c2c20] mb-12">
            Gallery of Our Real Transformations
        </h1>

        <!-- ================= VIDEO TESTIMONIALS ================= -->
        <h2 class="text-2xl font-bold mb-8 text-[#3c2c20]">Video Testimonials</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-20">

            <!-- Video 1 -->
            <div class="video-card h-[400px] md:h-[500px]">
                <div class="loader"></div>
                <video preload="none" class="lazy-video w-full h-full object-cover" controls>
                    <source data-src="/images/Gallary/1.mp4" type="video/mp4">
                </video>
            </div>

            <!-- Video 2 -->
            <div class="video-card h-[400px] md:h-[500px]">
                <div class="loader"></div>
                <video preload="none" class="lazy-video w-full h-full object-cover" controls>
                    <source data-src="/images/Gallary/2.mp4" type="video/mp4">
                </video>
            </div>

            <!-- Video 3 -->
            <div class="video-card h-[400px] md:h-[500px]">
                <div class="loader"></div>
                <video preload="none" class="lazy-video w-full h-full object-cover" controls>
                    <source data-src="/images/Gallary/3.mp4" type="video/mp4">
                </video>
            </div>

        </div>

        <!-- ================= PHOTO GALLERY ================= -->
        <h2 class="text-2xl font-bold mb-6 text-[#3c2c20]">Photo Gallery</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            @php
            $photos = ['p1','p2','p3','p4','p5','p6','p7','p8','p9','p10','p11','p12','p13','p14','p15','p16'];
            @endphp

            @foreach($photos as $img)
            <div class="relative w-full h-64 md:h-96 overflow-hidden rounded-2xl shadow-lg">
                <div class="loader"></div>
                <img data-src="/images/Gallary/{{ $img }}.jpg" class="lazy-img gallery-img object-cover w-full h-full cursor-pointer">
            </div>
            @endforeach

        </div>

        <!-- ================= TREATMENT PROCESS ================= -->
        <h2 class="text-2xl font-bold mt-20 mb-8 text-[#3c2c20]">Treatment Process</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-10">

            @php $treatments = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,16,17,18,20]; @endphp

            @foreach($treatments as $t)
            <div class="video-card h-[400px] md:h-[500px]">
                <div class="loader"></div>
                <video preload="none"
                    class="lazy-video w-full h-full object-cover {{ in_array($t,[3,5]) ? 'rotate-video' : '' }}"
                    controls>
                    <source data-src="/images/Gallary/t{{ $t }}.mp4" type="video/mp4">
                </video>
            </div>
            @endforeach

        </div>

    </div>
</div>

<!-- ================= LIGHTBOX ================= -->
<div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 z-[9999] hidden flex items-center justify-center">
    <button id="closeLightbox" class="absolute top-5 right-6 text-white text-5xl font-bold">&times;</button>
    <button id="prevImage" class="absolute left-6 text-white text-5xl font-bold">&#10094;</button>
    <img id="lightboxImage" class="max-h-[90vh] max-w-[90vw] rounded-lg shadow-2xl transition">
    <button id="nextImage" class="absolute right-6 text-white text-5xl font-bold">&#10095;</button>
</div>

@endsection

@push('styles')
<style>
    .loader {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eee;
    }

    .loader:after {
        content: "";
        width: 35px;
        height: 35px;
        border: 4px solid #c0a182;
        border-top-color: transparent;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .rotate-video {
        transform: rotate(-90deg);
        object-fit: cover !important;
    }

    .video-card {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        border: 1px solid #e7dcc8;
        background: #fff;
        box-shadow: 0 5px 18px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@push('scripts')
<script>
    const lazyImages = document.querySelectorAll('.lazy-img');
    const lazyVideos = document.querySelectorAll('.lazy-video');

    const lazyLoad = (entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if (entry.target.tagName === "IMG") entry.target.src = entry.target.dataset.src;
                if (entry.target.tagName === "VIDEO") {
                    entry.target.querySelector('source').src = entry.target.querySelector('source').dataset.src;
                    entry.target.load();
                }
                entry.target.parentElement.querySelector('.loader').style.display = 'none';
                observer.unobserve(entry.target);
            }
        });
    };

    const observer = new IntersectionObserver(lazyLoad, {
        rootMargin: '100px'
    });
    lazyImages.forEach(img => observer.observe(img));
    lazyVideos.forEach(v => observer.observe(v));

    const images = [...document.querySelectorAll('.gallery-img')].map(img => img.dataset.src || img.src);
    let current = 0;
    const lightbox = document.getElementById('lightbox');
    const preview = document.getElementById('lightboxImage');

    document.querySelectorAll('.gallery-img').forEach((img, i) => {
        img.addEventListener('click', () => {
            current = i;
            preview.src = images[current];
            lightbox.classList.remove('hidden');
        });
    });
    document.getElementById('closeLightbox').onclick = () => lightbox.classList.add('hidden');
    document.getElementById('nextImage').onclick = () => {
        current = (current + 1) % images.length;
        preview.src = images[current];
    };
    document.getElementById('prevImage').onclick = () => {
        current = (current - 1 + images.length) % images.length;
        preview.src = images[current];
    };
</script>
@endpush