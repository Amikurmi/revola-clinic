<div class="award-card-wrapper relative group">
    <div class="award-card {{ $bgColor }} rounded-lg p-6 shadow-md hover:shadow-xl transition-all duration-300 cursor-pointer">
        <!-- Main Content -->
        <div class="flex flex-col sm:flex-row items-center sm:justify-between gap-6">
            <!-- Logo Section -->
            <div class="logo-container flex-shrink-0">
                <div class="h-16 w-32 flex items-center justify-center">
                    <img src="/images/logo.png" alt="Award Logo" class="max-h-16 max-w-full object-contain">
                </div>
            </div>

            <!-- Date Section -->
            <div class="date-section text-center px-4 border-l-2 border-r-2 border-gray-200 text-gray-800 sm:text-lg font-bold">
                <p>{{ $date }}</p>
            </div>

            <!-- Description Section -->
            <div class="description-section flex-1 mt-4 sm:mt-0">
                <h3 class="text-sm font-semibold text-gray-600 mb-1">{{ $category }}</h3>
                <p class="text-base text-gray-800">{{ $description }}</p>
            </div>
        </div>

        <!-- Social Media Overlay -->
        <div class="social-overlay absolute inset-0 bg-black bg-opacity-70 flex items-center justify-center gap-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg">
            @if($facebookUrl)
            <a href="{{ $facebookUrl }}" target="_blank" class="social-icon bg-white hover:bg-blue-600 text-gray-800 hover:text-white rounded-full p-4 transform hover:scale-110 transition-all duration-300">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                </svg>
            </a>
            @endif

            @if($twitterUrl)
            <a href="{{ $twitterUrl }}" target="_blank" class="social-icon bg-white hover:bg-black text-gray-800 hover:text-white rounded-full p-4 transform hover:scale-110 transition-all duration-300">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                </svg>
            </a>
            @endif

            @if($instagramUrl)
            <a href="{{ $instagramUrl }}" target="_blank" class="social-icon bg-white hover:bg-gradient-to-br hover:from-purple-600 hover:via-pink-600 hover:to-orange-500 text-gray-800 hover:text-white rounded-full p-4 transform hover:scale-110 transition-all duration-300">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162z" />
                </svg>
            </a>
            @endif
        </div>
    </div>
</div>