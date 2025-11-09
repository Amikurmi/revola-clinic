@extends('layouts.admin')

@section('title', $blog->title)

@section('content')
<div class="bg-[#faf7f2] min-h-screen py-16 px-6">

    <div class="max-w-5xl mx-auto">

        <!-- Title -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-semibold text-[#3c2c20] leading-tight">{{ $blog->title }}</h1>
            <p class="text-sm tracking-wide uppercase text-[#8b6f47] mt-3">
                {{ $blog->category?->name ?? 'Uncategorized' }}
            </p>
        </div>

        <!-- Featured Image -->
        @if($blog->image)
        <div class="mb-14 flex justify-center">
            <img src="{{ asset('storage/' . $blog->image) }}"
                alt="{{ $blog->title }}"
                class="rounded-2xl shadow-[0_4px_25px_rgba(0,0,0,0.18)] w-full max-w-4xl object-cover">
        </div>
        @endif

        <!-- Excerpt -->
        <p class="text-xl text-[#3c2c20]/90 italic text-center max-w-3xl mx-auto mb-12 leading-relaxed">
            “{{ $blog->excerpt }}”
        </p>

        <!-- Content -->
        <div class="prose prose-lg max-w-none text-[#3c2c20] leading-loose custom-blog-content mb-16">
            {!! $blog->content !!}
        </div>

        <!-- Divider -->
        <div class="border-t border-[#d6c7b0] my-10"></div>

        <!-- Share Section -->
        <div class="text-center mb-14">
            <p class="text-lg tracking-wide text-[#3c2c20] font-medium mb-4">
                Share this article
            </p>

            <div class="flex justify-center gap-6 text-2xl">

                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                    target="_blank"
                    class="text-[#3c2c20] hover:text-[#8b6f47] transition">
                    <i class="fab fa-facebook-f"></i>
                </a>

                <a href="https://wa.me/?text={{ urlencode(request()->fullUrl()) }}"
                    target="_blank"
                    class="text-[#3c2c20] hover:text-[#8b6f47] transition">
                    <i class="fab fa-whatsapp"></i>
                </a>

                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}"
                    target="_blank"
                    class="text-[#3c2c20] hover:text-[#8b6f47] transition">
                    <i class="fab fa-linkedin-in"></i>
                </a>

                <button onclick="navigator.clipboard.writeText('{{ request()->fullUrl() }}')"
                    class="text-[#3c2c20] hover:text-[#8b6f47] transition">
                    <i class="fas fa-link"></i>
                </button>

                <a href="mailto:?subject={{ $blog->title }}&body={{ urlencode(request()->fullUrl()) }}"
                    class="text-[#3c2c20] hover:text-[#8b6f47] transition">
                    <i class="fas fa-envelope"></i>
                </a>
            </div>
        </div>

        <!-- Back Button -->
        <div class="text-center">
            <a href="{{ route('admin.blogs.index') }}"
                class="inline-block bg-[#3c2c20] px-10 py-3 rounded-full text-white tracking-wide text-lg shadow hover:bg-[#2a2119] transition">
                Back to Blogs
            </a>
        </div>

    </div>

</div>
@endsection