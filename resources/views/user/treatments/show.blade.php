@extends('layouts.app')

@section('title', $treatment->title ?? 'Treatment Details')

@section('meta')
<meta name="description" content="{{ Str::limit(strip_tags($treatment->short_description ?? $treatment->description), 160) }}" />
<meta name="keywords" content="Dermatology Treatment, {{ $treatment->title }}, Skin Care, Hair Care, Cosmetic Solutions, Revola Clinic" />
@endsection

@section('content')

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- Treatment Banner with Title Overlay -->
    @if($treatment->image)
    <div class="relative rounded-3xl overflow-hidden shadow-2xl mb-12">
        <img src="{{ asset($treatment->image) }}"
            alt="{{ $treatment->title }}"
            class="w-full h-72 sm:h-96 object-cover">

        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-black/20"></div>

        <!-- Title + Date on Banner -->
        <div class="absolute bottom-6 left-6 right-6 text-white">
            <h1 class="text-3xl sm:text-5xl font-extrabold mb-2 drop-shadow-lg">
                {{ $treatment->title }}
            </h1>
            <p class="text-sm sm:text-base font-medium opacity-90 drop-shadow-lg">
                {{ $treatment->created_at->format('F d, Y') }}
            </p>
        </div>
    </div>
    @endif


    <!-- Main Content -->
    <div class="bg-white rounded-3xl shadow-lg p-6 sm:p-10 space-y-10 border border-[#E0D6C6]">

        <!-- Overview -->
        @if($treatment->short_description)
        <div class="bg-[#F9F6F1] border-l-4 border-[#8B7355] rounded-xl p-6 sm:p-8 shadow-sm">
            <h2 class="text-2xl font-semibold text-[#8B7355] mb-3">Overview</h2>
            <p class="text-lg text-gray-700 leading-relaxed italic">
                {{ $treatment->short_description }}
            </p>
        </div>
        @endif

        <!-- Full Description -->
        <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed">
            {!! $treatment->description !!}
        </div>

        <!-- Share This Treatment -->
        <div class="mt-12 border-t border-[#E6E1D3] pt-8 text-center">
            <h2 class="text-2xl font-semibold text-[#8B7355] mb-6">Share this Treatment</h2>

            <div class="flex justify-center flex-wrap gap-5">
                <!-- Facebook -->
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}"
                    target="_blank"
                    class="bg-[#F9F6F1] border border-[#E0D6C6] text-[#3b5998] rounded-full p-3 hover:bg-[#8B7355] hover:text-white transition">
                    <i class="fab fa-facebook-f text-xl"></i>
                </a>

                <!-- Twitter -->
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::url()) }}&text={{ urlencode($treatment->title) }}"
                    target="_blank"
                    class="bg-[#F9F6F1] border border-[#E0D6C6] text-[#1DA1F2] rounded-full p-3 hover:bg-[#8B7355] hover:text-white transition">
                    <i class="fab fa-twitter text-xl"></i>
                </a>

                <!-- LinkedIn -->
                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(Request::url()) }}&title={{ urlencode($treatment->title) }}"
                    target="_blank"
                    class="bg-[#F9F6F1] border border-[#E0D6C6] text-[#0077B5] rounded-full p-3 hover:bg-[#8B7355] hover:text-white transition">
                    <i class="fab fa-linkedin-in text-xl"></i>
                </a>

                <!-- WhatsApp -->
                <a href="https://api.whatsapp.com/send?text={{ urlencode($treatment->title . ' - ' . Request::url()) }}"
                    target="_blank"
                    class="bg-[#F9F6F1] border border-[#E0D6C6] text-[#25D366] rounded-full p-3 hover:bg-[#8B7355] hover:text-white transition">
                    <i class="fab fa-whatsapp text-xl"></i>
                </a>

                <!-- Email -->
                <a href="mailto:?subject={{ urlencode($treatment->title) }}&body={{ urlencode(Request::url()) }}"
                    class="bg-[#F9F6F1] border border-[#E0D6C6] text-[#D44638] rounded-full p-3 hover:bg-[#8B7355] hover:text-white transition">
                    <i class="fas fa-envelope text-xl"></i>
                </a>

                <!-- Copy Link -->
                <button id="copyLinkBtn"
                    class="bg-[#F9F6F1] border border-[#E0D6C6] text-[#4B3621] rounded-full p-3 hover:bg-[#8B7355] hover:text-white transition">
                    <i class="fas fa-link text-xl"></i>
                </button>
            </div>

            <p id="copyMsg" class="hidden mt-4 text-sm text-green-700 font-medium">
                ✅ Link copied successfully!
            </p>
        </div>
    </div>

    <!-- Related Treatments -->
    @if($relatedTreatments->count() > 0)
    <div class="mt-20">
        <h2 class="text-3xl font-bold text-center text-[#4B3621] mb-10">Related Treatments</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach($relatedTreatments as $related)
            <div class="bg-white border border-[#E0D6C6] rounded-2xl overflow-hidden shadow-md hover:shadow-lg transition-all duration-300 group">
                <div class="overflow-hidden">
                    <img src="{{ asset($related->image) }}" alt="{{ $related->title }}"
                        class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-105">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-[#4B3621] mb-2">{{ $related->title }}</h3>
                    <p class="text-gray-600 text-sm line-clamp-3">{{ $related->short_description }}</p>
                    <a href="{{ route('treatments.show', $related->slug) }}"
                        class="inline-block mt-4 text-[#8B7355] font-semibold hover:text-[#4B3621] transition-all duration-200">
                        Learn More →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Back + CTA Buttons -->
    <div class="text-center mt-16 flex flex-col sm:flex-row justify-center gap-4">
        <a href="{{ route('home') }}"
            class="px-8 py-3 bg-[#8B7355] text-white rounded-full font-semibold hover:bg-[#7a5d3b] transition-all duration-300 shadow-md inline-flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i> Back to Treatments
        </a>

        @if($treatment->button)
        <a href="{{ route('user.appointments.index') ?? '#' }}"
            class="px-8 py-3 bg-[#C6A57B] text-white rounded-full font-semibold hover:bg-[#b99267] transition-all duration-300 shadow-md">
            {{ $treatment->button ?? 'Book Appointment' }}
        </a>
        @endif
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