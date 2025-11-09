@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')

<div class="min-h-screen py-12">

    <!-- Profile Welcome Box -->
    <div class="max-w-6xl mx-auto px-8 mb-14">
        <div class="bg-white shadow-xl border border-[#e7dcc8] rounded-3xl p-10 flex flex-col md:flex-row items-center gap-8 hover:shadow-2xl transition-all duration-500">

            <!-- Elegant Icon Avatar -->
            <div class="w-28 h-28 rounded-full bg-gradient-to-br from-[#bfa37a] to-[#8b6f47] flex items-center justify-center shadow-md border-4 border-[#f5f0e6]">
                <i class="fas fa-user-shield text-white text-5xl"></i>
            </div>

            <div>
                <h1 class="text-4xl font-extrabold text-[#3c2c20] drop-shadow-sm">
                    Welcome Back, {{ auth()->user()->name }} 
                </h1>
                <p class="text-gray-600 mt-2 text-lg">Manage & Control with Premium Comfort</p>
            </div>

        </div>
    </div>



    <!-- Animated Stats Row 1 -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 max-w-6xl mx-auto px-8 mb-16">

        <div class="bg-white border border-[#e7dcc8] rounded-3xl p-8 shadow-md text-center hover:-translate-y-2 hover:shadow-xl transition">
            <p class="text-gray-500 text-sm mb-1">Total Treatments</p>
            <p class="text-5xl font-bold text-[#8b6f47] counter" data-target="{{ $treatmentCount }}">0</p>
        </div>

        <div class="bg-white border border-[#e7dcc8] rounded-3xl p-8 shadow-md text-center hover:-translate-y-2 hover:shadow-xl transition">
            <p class="text-gray-500 text-sm mb-1">Total Blogs</p>
            <p class="text-5xl font-bold text-[#8b6f47] counter" data-target="{{ $blogCount }}">0</p>
        </div>

        <div class="bg-white border border-[#e7dcc8] rounded-3xl p-8 shadow-md text-center hover:-translate-y-2 hover:shadow-xl transition">
            <p class="text-gray-500 text-sm mb-1">Appointments Handled</p>
            <p class="text-5xl font-bold text-[#8b6f47] counter" data-target="{{ $appointmentCount }}">0</p>
        </div>

    </div>

    <!-- Animated Stats Row 2 -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 max-w-6xl mx-auto px-8 mb-20">

        <div class="bg-white border border-[#e7dcc8] rounded-3xl p-8 shadow-md text-center hover:-translate-y-2 hover:shadow-xl transition">
            <p class="text-gray-500 text-sm mb-1">Total Users</p>
            <p class="text-5xl font-bold text-[#8b6f47] counter" data-target="{{ $userCount }}">0</p>
        </div>

        <div class="bg-white border border-[#e7dcc8] rounded-3xl p-8 shadow-md text-center hover:-translate-y-2 hover:shadow-xl transition">
            <p class="text-gray-500 text-sm mb-1">Total Doctors</p>
            <p class="text-5xl font-bold text-[#8b6f47] counter" data-target="{{ $doctorCount }}">0</p>
        </div>

        <div class="bg-white border border-[#e7dcc8] rounded-3xl p-8 shadow-md text-center hover:-translate-y-2 hover:shadow-xl transition">
            <p class="text-gray-500 text-sm mb-1">Total Enquiries</p>
            <p class="text-5xl font-bold text-[#8b6f47] counter" data-target="{{ $enquiryCount }}">0</p>
        </div>

    </div>

    <!-- Dashboard Feature Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 max-w-7xl mx-auto px-8">

        <a href="{{ route('admin.treatments.index') }}" class="group bg-white shadow-xl rounded-3xl p-7 border border-[#e7dcc8] hover:shadow-2xl hover:-translate-y-2 transition cursor-pointer">
            <div class="text-[#8b6f47] text-5xl mb-5 group-hover:scale-110 transition"><i class="fas fa-users"></i></div>
            <h3 class="text-2xl font-semibold text-[#3c2c20]">Treatments</h3>
            <p class="text-gray-600 mt-2 text-sm">Manage treatment sections</p>
        </a>

        <a href="{{ route('admin.blogs.index') }}" class="group bg-white shadow-xl rounded-3xl p-7 border border-[#e7dcc8] hover:shadow-2xl hover:-translate-y-2 transition cursor-pointer">
            <div class="text-[#8b6f47] text-5xl mb-5 group-hover:scale-110 transition"><i class="fas fa-blog"></i></div>
            <h3 class="text-2xl font-semibold text-[#3c2c20]">Blogs</h3>
            <p class="text-gray-600 mt-2 text-sm">Create & manage blog posts</p>
        </a>

        <a href="{{ route('admin.appointments.index') }}" class="group bg-white shadow-xl rounded-3xl p-7 border border-[#e7dcc8] hover:shadow-2xl hover:-translate-y-2 transition cursor-pointer">
            <div class="text-[#8b6f47] text-5xl mb-5 group-hover:scale-110 transition"><i class="fas fa-calendar-check"></i></div>
            <h3 class="text-2xl font-semibold text-[#3c2c20]">Appointments</h3>
            <p class="text-gray-600 mt-2 text-sm">View and handle appointments</p>
        </a>

        <a href="{{ route('admin.enquiries.index') }}" class="group bg-white shadow-xl rounded-3xl p-7 border border-[#e7dcc8] hover:shadow-2xl hover:-translate-y-2 transition cursor-pointer">
            <div class="text-[#8b6f47] text-5xl mb-5 group-hover:scale-110 transition"><i class="fas fa-envelope-open-text"></i></div>
            <h3 class="text-2xl font-semibold text-[#3c2c20]">Enquiries</h3>
            <p class="text-gray-600 mt-2 text-sm">View patient enquiries</p>
        </a>

    </div>

</div>

<!-- Counter Animation -->
<script>
    const counters = document.querySelectorAll(".counter");
    counters.forEach(counter => {
        const updateCounter = () => {
            const target = +counter.getAttribute("data-target");
            const current = +counter.innerText;
            const increment = target / 80;

            if (current < target) {
                counter.innerText = Math.ceil(current + increment);
                setTimeout(updateCounter, 25);
            } else {
                counter.innerText = target;
            }
        };
        updateCounter();
    });
</script>

@endsection