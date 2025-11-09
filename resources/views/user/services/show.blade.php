@extends('layouts.app')

@section('title', $service->title ?? 'Service Details')

@section('meta')
<meta name="description" content="{{ Str::limit(strip_tags($service->short_description ?? $service->description), 160) }}" />
<meta name="keywords" content="Dermatology Service, {{ $service->title }}, Skin Care, Hair Care, Cosmetic Solutions, Revola Clinic" />
@endsection

@section('content')

<!-- <x-centered-text line1="Service Details" line2="Home - Service Details" /> -->

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    @if($service->image)
    <div class="relative rounded-3xl overflow-hidden shadow-2xl mb-12">
        <img src="{{ asset($service->image) }}"
            alt="{{ $service->title }}"
            class="w-full h-72 sm:h-96 object-cover">

        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-black/10"></div>

        <!-- Text Over Image -->
        <div class="absolute bottom-6 left-6 right-6 text-white drop-shadow-lg">
            <h1 class="text-3xl sm:text-5xl font-extrabold mb-2">
                {{ $service->title }}
            </h1>

            @if($service->label)
            <p class="text-base sm:text-lg font-medium text-[#F5EEDC]">
                {{ $service->label }}
            </p>
            @endif

            @if($service->created_at)
            <p class="text-xs sm:text-sm opacity-90 mt-1">
                {{ $service->created_at->format('F d, Y') }}
            </p>
            @endif
        </div>
    </div>
    @endif


    <!-- Main Content Card -->
    <div class="bg-white rounded-3xl shadow-lg p-6 sm:p-10 space-y-10 border border-[#E0D6C6]">

        <!-- Quick Overview (Optional Short Summary) -->
        @if(!empty($service->short_description))
        <div class="bg-[#F9F6F1] border-l-4 border-[#8B7355] rounded-xl p-6 sm:p-8 shadow-sm">
            <h2 class="text-2xl font-semibold text-[#8B7355] mb-3">Quick Overview</h2>
            <p class="text-lg text-gray-700 leading-relaxed italic">
                {{ $service->short_description }}
            </p>
        </div>
        @endif

        <!-- Description -->
        <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed">
            {!! $service->description !!}
        </div>

        <!-- Share This Service -->
        <div class="mt-12 border-t border-[#E6E1D3] pt-8 text-center">
            <h2 class="text-2xl font-semibold text-[#8B7355] mb-6">Share this Service</h2>
            <div class="flex justify-center flex-wrap gap-5">

                <!-- Facebook -->
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}"
                    target="_blank"
                    class="bg-[#F9F6F1] border border-[#E0D6C6] text-[#3b5998] rounded-full p-3 hover:bg-[#8B7355] hover:text-white transition">
                    <i class="fab fa-facebook-f text-xl"></i>
                </a>

                <!-- Twitter -->
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::url()) }}&text={{ urlencode($service->title) }}"
                    target="_blank"
                    class="bg-[#F9F6F1] border border-[#E0D6C6] text-[#1DA1F2] rounded-full p-3 hover:bg-[#8B7355] hover:text-white transition">
                    <i class="fab fa-twitter text-xl"></i>
                </a>

                <!-- LinkedIn -->
                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(Request::url()) }}&title={{ urlencode($service->title) }}"
                    target="_blank"
                    class="bg-[#F9F6F1] border border-[#E0D6C6] text-[#0077B5] rounded-full p-3 hover:bg-[#8B7355] hover:text-white transition">
                    <i class="fab fa-linkedin-in text-xl"></i>
                </a>

                <!-- WhatsApp -->
                <a href="https://api.whatsapp.com/send?text={{ urlencode($service->title . ' - ' . Request::url()) }}"
                    target="_blank"
                    class="bg-[#F9F6F1] border border-[#E0D6C6] text-[#25D366] rounded-full p-3 hover:bg-[#8B7355] hover:text-white transition">
                    <i class="fab fa-whatsapp text-xl"></i>
                </a>

                <!-- Email -->
                <a href="mailto:?subject={{ urlencode($service->title) }}&body={{ urlencode(Request::url()) }}"
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

    <!-- Back Button -->
    <div class="text-center mt-16">
        <a href="{{ route('services.index') }}"
            class="inline-flex items-center gap-2 px-8 py-3 bg-[#8B7355] text-white rounded-full font-semibold hover:bg-[#7a5d3b] transition-all duration-300 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 19l-7-7 7-7" />
            </svg>
            Back to All Services
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