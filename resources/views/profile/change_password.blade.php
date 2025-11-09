@extends('layouts.app')

@section('title', 'Change Password')

@section('content')

<x-centered-text
    line1="Profile"
    line2="Home - Profile" />
    
<div class="max-w-2xl mx-auto my-16 p-8 bg-[#fdf8f5] shadow-xl rounded-2xl border border-[#8b5e3c]/20">
    <h1 class="text-3xl font-extrabold mb-8 text-center text-[#8b5e3c]">Change Password</h1>

    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
        <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('profile.change_password') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label class="block mb-2 font-semibold text-[#8b5e3c]">Current Password</label>
            <input type="password" name="current_password"
                class="w-full border border-[#8b5e3c]/50 px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#8b5e3c] transition duration-200">
        </div>

        <div>
            <label class="block mb-2 font-semibold text-[#8b5e3c]">New Password</label>
            <input type="password" name="new_password"
                class="w-full border border-[#8b5e3c]/50 px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#8b5e3c] transition duration-200">
        </div>

        <div>
            <label class="block mb-2 font-semibold text-[#8b5e3c]">Confirm New Password</label>
            <input type="password" name="new_password_confirmation"
                class="w-full border border-[#8b5e3c]/50 px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#8b5e3c] transition duration-200">
        </div>

        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mt-6">
            <a href="{{ route('profile.view') }}"
                class="flex items-center justify-center gap-2 px-6 py-3 bg-gray-400 text-white font-semibold rounded-lg hover:bg-gray-500 transition duration-200 shadow">
                <i class="fas fa-arrow-left"></i> Cancel
            </a>
            <button type="submit"
                class="flex items-center justify-center gap-2 px-6 py-3 bg-[#8b5e3c] text-white font-semibold rounded-lg hover:bg-[#7a4f2f] transition duration-200 shadow">
                <i class="fas fa-key"></i> Change Password
            </button>
        </div>
    </form>
</div>

<!-- Responsive tweaks for mobile -->
<style>
    @media (max-width: 640px) {
        .px-6 {
            padding-left: 1.25rem !important;
            padding-right: 1.25rem !important;
        }

        .py-3 {
            padding-top: 0.75rem !important;
            padding-bottom: 0.75rem !important;
        }
    }
</style>
@endsection