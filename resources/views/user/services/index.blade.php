@extends('layouts.app')

@section('title', 'Services - Revola Clinic')

@section('meta')
<meta name="description" content="Discover the range of dermatology services offered at Revola Clinic. From skin treatments to hair care and cosmetic solutions, we provide expert care tailored to your needs." />
<meta name="keywords" content="Dermatology Services, Skin Treatments, Hair Care, Cosmetic Solutions, Revola Clinic" />
@endsection

@section('content')

<x-centered-text
    line1="Services"
    line2="Home - Services" />

<!-- Treatments Section -->
<x-treatments :services="$services" />

<x-service-section />

<div class="text-center my-12">
    <div class="w-full">
        <div class="inline-block bg-[#f1e9dd] text-amber-800 px-4 py-2 rounded-full text-xs md:text-sm font-medium mb-4">
            Featured Post
        </div>
        <h1 class="text-2xl md:text-5xl font-semibold text-gray-900 mb-4">
            Our Insurance Company <br> Over World
        </h1>
        <p class="text-gray-600 mb-8 text-sm md:text-lg px-6 md:px-0">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos nulla voluptates laudantium aliquid
            reiciendis iusto eaque odit quaerat maiores dolorum.
        </p>
    </div>
</div>

<x-derma-card />

@endsection