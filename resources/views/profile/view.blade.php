@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

<x-centered-text
    line1="Profile"
    line2="Home - Profile" />


<div class="max-w-2xl mx-auto my-16 p-8 bg-[#fdf8f5] shadow-xl rounded-2xl border border-[#8b5e3c]/20">
    <h1 class="text-3xl font-extrabold mb-8 text-center text-[#8b5e3c]">My Profile</h1>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
        {{ session('success') }}
    </div>
    @endif

    <div class="space-y-5 text-[#3b3b3b]">
        <div class="flex justify-between items-center border-b border-[#8b5e3c]/20 pb-2">
            <span class="font-semibold text-[#8b5e3c]">Name:</span>
            <span>{{ $user->name }}</span>
        </div>
        <div class="flex justify-between items-center border-b border-[#8b5e3c]/20 pb-2">
            <span class="font-semibold text-[#8b5e3c]">Email:</span>
            <span>{{ $user->email }}</span>
        </div>
        <div class="flex justify-between items-center border-b border-[#8b5e3c]/20 pb-2">
            <span class="font-semibold text-[#8b5e3c]">User Type:</span>
            <span>{{ ucfirst($user->usertype) }}</span>
        </div>
    </div>

    <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
        <a href="{{ route('profile.edit') }}"
            class="flex-1 text-center px-6 py-3 bg-[#8b5e3c] text-white font-semibold rounded-lg hover:bg-[#7a4f2f] transition duration-200 shadow">
            <i class="fas fa-edit"></i> Edit Profile
        </a>
        <a href="{{ route('profile.change_password_form') }}"
            class="flex-1 text-center px-6 py-3 bg-white text-black font-semibold rounded-lg hover:bg-[#b55f04] transition duration-200 shadow">
            <i class="fas fa-key"></i> Change Password
        </a>
    </div>
</div>

<!-- Responsive tweaks -->
<style>
    @media (max-width: 640px) {
        .px-6 {
            padding-left: 1.5rem !important;
            padding-right: 1.5rem !important;
        }

        .py-3 {
            padding-top: 0.75rem !important;
            padding-bottom: 0.75rem !important;
        }
    }
</style>
@endsection