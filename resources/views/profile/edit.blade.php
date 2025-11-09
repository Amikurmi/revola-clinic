@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')


<x-centered-text
    line1="Profile"
    line2="Home - Profile" />
    
<div class="max-w-2xl mx-auto my-16 p-8 bg-[#fdf8f5] shadow-xl rounded-2xl border border-[#8b5e3c]/20">
    <h1 class="text-3xl font-extrabold mb-8 text-center text-[#8b5e3c]">Edit Profile</h1>

    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
        @csrf

        <div class="space-y-1">
            <label class="block mb-1 font-semibold text-[#8b5e3c]">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                class="w-full border border-[#8b5e3c]/30 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e3c] transition" />
        </div>

        <div class="space-y-1">
            <label class="block mb-1 font-semibold text-[#8b5e3c]">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                class="w-full border border-[#8b5e3c]/30 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e3c] transition" />
        </div>

        <div class="flex flex-col sm:flex-row justify-between gap-4 mt-8">
            <a href="{{ route('profile.view') }}"
                class="flex items-center justify-center gap-2 px-6 py-3 bg-gray-400 text-white font-semibold rounded-lg hover:bg-gray-500 transition duration-200 shadow">
                <i class="fas fa-arrow-left"></i> Cancel
            </a>
            <button type="submit"
                class="flex items-center justify-center gap-2 px-6 py-3 bg-[#8b5e3c] text-white font-semibold rounded-lg hover:bg-[#7a4f2f] transition duration-200 shadow">
                Update Profile
            </button>
        </div>
    </form>
</div>

<!-- Mobile responsiveness -->
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