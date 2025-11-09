@extends('layouts.app')

@section('title', 'Blog - Revola Clinic')
@section('meta')
<meta name="description" content="Explore the latest articles and insights on dermatology, skincare, and wellness at Revola Clinic. Stay informed with expert advice and tips from our specialists." />
<meta name="keywords" content="Blog, Dermatology Articles, Skincare Tips, Wellness Insights, Expert Advice, Revola Clinic" />
@endsection

@section('content')

<x-centered-text
    line1="Blog & Articles"
    line2="Home - Blog & Articles" />

<div class="max-w-7xl mx-auto my-20 px-6 lg:px-8">
    <!-- Blog Section Title -->
    <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-[#4B3621] tracking-tight mb-3">
            Discover Our Latest <span class="text-[#8B7355]">Insights</span>
        </h2>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">
            Expert advice, skincare secrets, and the latest trends from the world of dermatology & wellness.
        </p>
    </div>

    <!-- Blog Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($blogs as $blog)
        <div class="group bg-white rounded-2xl border border-[#E0D6C6] shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden hover:-translate-y-2">
            <!-- Blog Image -->
            <div class="relative overflow-hidden">
                <img src="{{ asset('storage/' . $blog->image) }}"
                    alt="{{ $blog->title }}"
                    class="w-full h-60 object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
            </div>

            <!-- Blog Content -->
            <div class="p-6">
                <p class="text-[#A68B61] font-semibold text-sm uppercase tracking-wide mb-2">
                    {{ $blog->category->name ?? 'Uncategorized' }}
                </p>
                <h3 class="text-xl font-bold text-[#4B3621] group-hover:text-[#8B7355] transition-colors duration-300 mb-3">
                    {{ $blog->title }}
                </h3>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    {{ Str::limit(strip_tags($blog->content), 120, '...') }}
                </p>
                <div class="flex items-center justify-between">
                    <span class="text-gray-400 text-xs">
                        {{ $blog->created_at->format('F d, Y') }}
                    </span>
                    <a href="{{ route('blogs.details', $blog->slug) }}"
                        class="inline-flex items-center text-[#8B7355] font-semibold hover:text-[#7a5d3b] text-sm transition">
                        Read More
                        <i class="fa-solid fa-angle-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center text-gray-600 py-20">
            <p class="text-lg">No blogs available at the moment.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if ($blogs->hasPages())
    <div class="flex justify-center mt-16">
        <div class="inline-flex items-center space-x-2 bg-[#F9F6F1] border border-[#E0D6C6] shadow-md px-4 py-2 rounded-full">
            {{ $blogs->onEachSide(1)->links('vendor.pagination.custom-tailwind') }}
        </div>
    </div>
    @endif
</div>

@endsection