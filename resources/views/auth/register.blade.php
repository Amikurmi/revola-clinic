@extends('layouts.auth')

@section('title', 'Register - Revola Clinic')
@section('meta')
<meta name="description" content="Create an account at Revola Clinic to access personalized dermatology services, manage appointments, and view treatment history." />
<meta name="keywords" content="Register, Create Account, Dermatology Services, Manage Appointments, Treatment History, Revola Clinic" />
@endsection

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#e4ddca] px-4 sm:px-6 lg:px-8 py-12">

    <!-- Register Card -->
    <div class="relative w-full max-w-md sm:max-w-lg md:max-w-md lg:max-w-md">
        <div class="bg-white rounded-3xl shadow-2xl p-6 sm:p-8 space-y-6">

            <!-- Header -->
            <div class="text-center space-y-2">
                <div class="inline-flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 bg-[#8b5e3c]/20 rounded-2xl mb-3 sm:mb-4 shadow">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-[#8b5e3c]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h2 class="text-2xl sm:text-3xl font-bold text-[#3b3b3b]">Create Account</h2>
                <p class="text-[#3b3b3b]/80 text-sm sm:text-base">Sign up to start your journey</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-4 sm:space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block text-sm sm:text-base font-medium text-[#3b3b3b] mb-1 sm:mb-2">Name</label>
                    <input
                        type="text"
                        name="name"
                        class="w-full pl-3 sm:pl-4 pr-3 sm:pr-4 py-1.5 md:py-2 bg-white border border-black rounded-xl text-[#3b3b3b] placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#8b5e3c] focus:border-transparent transition-all text-sm sm:text-base"
                        placeholder="Your Name"
                        required>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm sm:text-base font-medium text-[#3b3b3b] mb-1 sm:mb-2">Email Address</label>
                    <input
                        type="email"
                        name="email"
                        class="w-full pl-3 sm:pl-4 pr-3 sm:pr-4 py-1.5 md:py-2  bg-white border border-black rounded-xl text-[#3b3b3b] placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#8b5e3c] focus:border-transparent transition-all text-sm sm:text-base"
                        placeholder="you@example.com"
                        required>
                </div>

                <!-- Password -->
                <div class="relative">
                    <label class="block text-sm sm:text-base font-medium text-[#3b3b3b] mb-1 sm:mb-2">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="w-full pr-10 sm:pr-12 pl-3 sm:pl-4 py-1.5 md:py-2  bg-white border border-black rounded-xl text-[#3b3b3b] placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#8b5e3c] focus:border-transparent transition-all text-sm sm:text-base"
                        placeholder="••••••••"
                        required>
                    <button type="button" onclick="togglePassword('password','eyeIcon1')" class="absolute inset-y-0 right-0 px-2 sm:px-4 flex items-center text-gray-500">
                        <i id="eyeIcon1" class="fa-solid fa-eye text-sm sm:text-base mt-6 md:mt-8"></i>
                    </button>
                </div>

                <!-- Confirm Password -->
                <div class="relative">
                    <label class="block text-sm sm:text-base font-medium text-[#3b3b3b] mb-1 sm:mb-2">Confirm Password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="w-full pr-10 sm:pr-12 pl-3 sm:pl-4 py-1.5 md:py-2  bg-white border border-black rounded-xl text-[#3b3b3b] placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#8b5e3c] focus:border-transparent transition-all text-sm sm:text-base"
                        placeholder="••••••••"
                        required>
                    <button type="button" onclick="togglePassword('password_confirmation','eyeIcon2')" class="absolute inset-y-0 right-0 px-2 sm:px-4 flex items-center text-gray-500">
                        <i id="eyeIcon2" class="fa-solid fa-eye text-sm sm:text-base mt-6 md:mt-8"></i>
                    </button>
                </div>

                <!-- Submit -->
                <button
                    type="submit"
                    class="w-full bg-[#8b5e3c] hover:bg-[#7a4f2f] text-white font-semibold py-2.5 sm:py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 text-sm sm:text-base">
                    Register
                </button>
            </form>

            <!-- Login Link -->
            <p class="text-center text-[#3b3b3b]/80 text-sm sm:text-base">
                Already have an account?
                <a href="{{ route('login') }}" class="text-[#8b5e3c] font-semibold hover:underline transition-all">
                    Login
                </a>
            </p>
        </div>
    </div>
</div>

<script>
    function togglePassword(inputId, iconId) {
        const password = document.getElementById(inputId);
        const eyeIcon = document.getElementById(iconId);
        if (password.type === 'password') {
            password.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            password.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    }
</script>
@endsection