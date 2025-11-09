@extends('layouts.admin')

@section('title', 'Add Doctor')

@section('content')
<div class="container mx-auto py-8">
    <!-- Header with Back Button -->
    <div class="flex justify-between items-center mb-8">
        <a href="{{ route('admin.doctors.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-4 py-2 rounded shadow">
            Back
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Add New Doctor</h1>
        <div></div> <!-- Placeholder to balance flex -->
    </div>

    <!-- Add Doctor Form -->
    <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data" class="max-w-2xl mx-auto bg-white shadow rounded-lg p-6">
        @csrf

        <!-- Name -->
        <div class="mb-6">
            <label class="block mb-2 font-medium text-gray-700">Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" required
                class="w-full border border-gray-300 px-4 py-2 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Specialization -->
        <div class="mb-6">
            <label class="block mb-2 font-medium text-gray-700">Specialization</label>
            <input type="text" name="specialization" value="{{ old('specialization') }}"
                class="w-full border border-gray-300 px-4 py-2 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Email -->
        <div class="mb-6">
            <label class="block mb-2 font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="w-full border border-gray-300 px-4 py-2 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Phone -->
        <div class="mb-6">
            <label class="block mb-2 font-medium text-gray-700">Phone</label>
            <input type="text" name="phone" value="{{ old('phone') }}"
                class="w-full border border-gray-300 px-4 py-2 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Rating -->
        <div class="mb-6">
            <label class="block mb-2 font-medium text-gray-700">Rating (0-5)</label>
            <input type="number" name="rating" value="{{ old('rating') }}" step="0.1" min="0" max="5"
                class="w-full border border-gray-300 px-4 py-2 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Experience -->
        <div class="mb-6">
            <label class="block mb-2 font-medium text-gray-700">Experience (Years)</label>
            <input type="number" name="experience_years" value="{{ old('experience_years') }}"
                class="w-full border border-gray-300 px-4 py-2 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Image Upload -->
        <div class="mb-6">
            <label class="block mb-2 font-medium text-gray-700">Profile Image</label>
            <input type="file" name="image"
                class="w-full border border-gray-300 px-4 py-2 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
                Add Doctor
            </button>
        </div>
    </form>
</div>
@endsection