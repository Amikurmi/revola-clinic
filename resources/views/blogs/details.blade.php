@extends('layouts.app')

@section('title', $blog->title ?? 'Blog Details')
@section('meta')
<meta name="description" content="{{ Str::limit(strip_tags($blog->excerpt ?? $blog->content), 160) }}" />
<meta name="keywords" content="Dermatology Blog, {{ $blog->title }}, Skincare Tips, Wellness Insights, Expert Advice, Revola Clinic" />
@endsection

@section('content')

<!-- <x-centered-text line1="Blog Details" line2="Home - Blog Details" /> -->

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- Blog Banner with Title, Category & Date Overlay -->
    @if($blog->image)
    <div class="relative rounded-3xl overflow-hidden shadow-2xl mb-12">
        <img src="{{ asset('storage/' . $blog->image) }}"
            alt="{{ $blog->title }}"
            class="w-full h-72 sm:h-96 object-cover">

        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-black/30"></div>

        <!-- Text Overlay -->
        <div class="absolute bottom-6 left-6 sm:left-10 right-6 text-white">
            <h1 class="text-3xl sm:text-5xl font-extrabold mb-3 drop-shadow-lg">
                {{ $blog->title }}
            </h1>

            <p class="text-sm sm:text-base flex gap-2 items-center drop-shadow-md">
                {{ $blog->created_at->format('F d, Y') }}

                @if($blog->category)
                <span class="text-[#f2e0b6] font-semibold uppercase tracking-wide">
                    | {{ $blog->category->name }}
                </span>
                @endif
            </p>
        </div>
    </div>
    @endif


    <!-- Blog Main Content -->
    <div class="bg-white rounded-3xl shadow-lg p-6 sm:p-10 space-y-10 border border-[#E0D6C6]">

        <!-- Excerpt Section -->
        @if(!empty($blog->excerpt))
        <div class="bg-[#F9F6F1] border-l-4 border-[#8B7355] rounded-xl p-6 sm:p-8 shadow-sm">
            <h2 class="text-2xl font-semibold text-[#8B7355] mb-3">Quick Overview</h2>
            <p class="text-lg text-gray-700 leading-relaxed italic">
                {{ $blog->excerpt }}
            </p>
        </div>
        @endif

        <!-- Content Section -->
        <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed">
            {!! $blog->content !!}
        </div>

        <!-- Share This Article -->
        <div class="mt-12 border-t border-[#E6E1D3] pt-8 text-center">
            <h2 class="text-2xl font-semibold text-[#8B7355] mb-6">Share this Article</h2>
            <div class="flex justify-center flex-wrap gap-5">

                <!-- Facebook -->
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}"
                    target="_blank"
                    class="bg-[#F9F6F1] border border-[#E0D6C6] text-[#3b5998] rounded-full p-3 hover:bg-[#8B7355] hover:text-white transition">
                    <i class="fab fa-facebook-f text-xl"></i>
                </a>

                <!-- Twitter -->
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::url()) }}&text={{ urlencode($blog->title) }}"
                    target="_blank"
                    class="bg-[#F9F6F1] border border-[#E0D6C6] text-[#1DA1F2] rounded-full p-3 hover:bg-[#8B7355] hover:text-white transition">
                    <i class="fab fa-twitter text-xl"></i>
                </a>

                <!-- LinkedIn -->
                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(Request::url()) }}&title={{ urlencode($blog->title) }}"
                    target="_blank"
                    class="bg-[#F9F6F1] border border-[#E0D6C6] text-[#0077B5] rounded-full p-3 hover:bg-[#8B7355] hover:text-white transition">
                    <i class="fab fa-linkedin-in text-xl"></i>
                </a>

                <!-- WhatsApp -->
                <a href="https://api.whatsapp.com/send?text={{ urlencode($blog->title . ' - ' . Request::url()) }}"
                    target="_blank"
                    class="bg-[#F9F6F1] border border-[#E0D6C6] text-[#25D366] rounded-full p-3 hover:bg-[#8B7355] hover:text-white transition">
                    <i class="fab fa-whatsapp text-xl"></i>
                </a>

                <!-- Email -->
                <a href="mailto:?subject={{ urlencode($blog->title) }}&body={{ urlencode(Request::url()) }}"
                    class="bg-[#F9F6F1] border border-[#E0D6C6] text-[#D44638] rounded-full p-3 hover:bg-[#8B7355] hover:text-white transition">
                    <i class="fas fa-envelope text-xl"></i>
                </a>

                <!-- Copy Link -->
                <button id="copyLinkBtn"
                    class="bg-[#F9F6F1] border border-[#E0D6C6] text-[#4B3621] rounded-full p-3 hover:bg-[#8B7355] hover:text-white transition">
                    <i class="fas fa-link text-xl"></i>
                </button>
            </div>

            <!-- Copy Notification -->
            <p id="copyMsg" class="hidden mt-4 text-sm text-green-700 font-medium">
                🔗 Link copied to clipboard!
            </p>
        </div>
    </div>

    <!-- Related Blogs -->
    @if(isset($relatedBlogs) && $relatedBlogs->count())
    <div class="mt-16 border-t border-gray-200 pt-12">
        <h2 class="text-2xl sm:text-3xl font-semibold mb-8 text-center text-[#8B7355]">
            Related Articles
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($relatedBlogs as $related)
            <div
                class="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition duration-300 border border-[#E6E1D3]">
                <img src="{{ asset('storage/' . $related->image) }}"
                    alt="{{ $related->title }}"
                    class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="p-5 text-left">
                    <h3 class="text-lg font-semibold text-[#8B7355] group-hover:text-[#7a5d3b] transition">
                        {{ $related->title }}
                    </h3>
                    <p class="text-gray-500 text-sm mb-3">
                        {{ $related->created_at->format('F d, Y') }}
                    </p>
                    <p class="text-gray-700 text-sm mb-4">
                        {{ Str::limit(strip_tags($related->excerpt ?? $related->content), 80, '...') }}
                    </p>
                    <a href="{{ route('blogs.details', $related->slug) }}"
                        class="inline-block text-[#8B7355] font-semibold hover:text-[#7a5d3b] transition">
                        Read More →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Back Button -->
    <div class="text-center mt-16">
        <a href="{{ route('blogs.index') }}"
            class="inline-flex items-center gap-2 px-8 py-3 bg-[#8B7355] text-white rounded-full font-semibold hover:bg-[#7a5d3b] transition-all duration-300 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 19l-7-7 7-7" />
            </svg>
            Back to Blog & Articles
        </a>
    </div>
</div>

<!-- Copy Link Script -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const copyBtn = document.getElementById('copyLinkBtn');
        const copyMsg = document.getElementById('copyMsg');
        const urlToCopy = window.location.href;

        copyBtn.addEventListener('click', function() {
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(urlToCopy).then(() => {
                    copyMsg.classList.remove('hidden');
                    setTimeout(() => copyMsg.classList.add('hidden'), 2500);
                }).catch(() => fallbackCopy(urlToCopy));
            } else {
                fallbackCopy(urlToCopy);
            }
        });

        function fallbackCopy(text) {
            const tempInput = document.createElement("textarea");
            tempInput.value = text;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);

            copyMsg.classList.remove('hidden');
            setTimeout(() => copyMsg.classList.add('hidden'), 2500);
        }
    });
</script>


@endsection