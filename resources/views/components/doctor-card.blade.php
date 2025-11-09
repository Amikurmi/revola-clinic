<div class="bg-[#f1e9dd] px-6 md:p-0 rounded-lg overflow-hidden rounded-t-lg transition-transform duration-300 group-hover:scale-105">
    <!-- Image Container (Hover Group) -->
    <div class="relative group">
        <!-- Doctor Image (Base Layer) -->
        <img src="{{ $image }}" alt="{{ $name }}"
            class="w-full h-[300px] sm:h-[350px] md:h-[400px] lg:h-[450px] object-cover rounded-t-lg transition-transform duration-300 group-hover:scale-105">

        <!-- Specialization Button (Bottom Left, Always Visible) -->
        <div class="absolute bottom-4 left-4 bg-white text-[#785d41] px-3 sm:px-4 py-1 sm:py-2 rounded-full shadow-md text-xs sm:text-sm
                    transition-colors duration-300 hover:bg-[#785d41] hover:text-white">
            {{ $specialization }}
        </div>

        <!-- Hover Overlay (Desktop Only) -->
        <div class="hidden md:flex absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex-col p-6 items-end gap-4 rounded-t-lg transition-opacity duration-300 group-hover:scale-105">
            <a href="#" class="text-white text-xl md:text-3xl hover:text-blue-500 transition"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="text-white text-xl md:text-3xl hover:text-blue-400 transition"><i class="fab fa-twitter"></i></a>
            <a href="#" class="text-white text-xl md:text-3xl hover:text-pink-500 transition"><i class="fab fa-instagram"></i></a>
        </div>

        <!-- Always Visible Social Icons (Mobile Only) -->
        <div class="flex md:hidden absolute top-4 right-4 flex-col gap-3">
            <a href="#" class="text-[#785d41] text-lg sm:text-xl"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="text-[#785d41] text-lg sm:text-xl"><i class="fab fa-twitter"></i></a>
            <a href="#" class="text-[#785d41] text-lg sm:text-xl"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
</div>

<!-- Doctor Info -->
<div class="px-6 pb-8 pt-4">
    <!-- Name and Appointment Link in Same Row -->
    <div class="flex items-center justify-between">
        <h3 class="text-sm md:text-lg sm:text-xl font-semibold text-gray-800">{{ $name }}</h3>
        <a href="#" class="text-[#b18457] text-sm md:text-lg font-medium hover:underline flex items-center">
            <!-- <i class="fas fa-phone mr-1"></i> For Appointment -->
        </a>
    </div>

    <!-- Rating -->
    <div class="flex items-center justify-start md:justify-start text-sm sm:text-base text-[#785d41] mt-4">
        <i class="fas fa-star mr-1"></i> {{ $rating }} (10 Reviews)
    </div>
</div>