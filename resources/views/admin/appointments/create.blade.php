@extends('layouts.admin')

@section('title', 'Add Appointment')

@section('content')
<div class="max-w-xl mx-auto bg-[#fdf7ef] shadow-lg rounded-lg p-8 mt-8">

    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-[#7a5a3a]">Add Appointment</h1>

        <!-- Back Button -->
        <a href="{{ route('admin.appointments.index') }}"
            class="px-4 py-2 bg-[#7a5a3a] text-white rounded-lg hover:bg-[#6a4f33] transition">
            <i class="fa-solid fa-arrow-left mr-1"></i> Back
        </a>
    </div>

    <!-- Validation Errors -->
    @if($errors->any())
    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
        <ul class="text-sm space-y-1">
            @foreach($errors->all() as $error)
            <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.appointments.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="font-medium text-[#7a5a3a]">Doctor</label>
            <select name="doctor_id" class="w-full border rounded px-3 py-2 focus:outline-none" required>
                <option value="">Select Doctor</option>
                @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="font-medium text-[#7a5a3a]">Slot</label>
            <select name="slot_id" class="w-full border rounded px-3 py-2 focus:outline-none" required>
                <option value="">Select Slot</option>
                @foreach($slots as $slot)
                <option value="{{ $slot->id }}">{{ $slot->date }} ({{ $slot->start_time }} - {{ $slot->end_time }})</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="font-medium text-[#7a5a3a]">First Name</label>
                <input type="text" name="first_name" class="w-full border rounded px-3 py-2 focus:outline-none" required>
            </div>

            <div>
                <label class="font-medium text-[#7a5a3a]">Last Name</label>
                <input type="text" name="last_name" class="w-full border rounded px-3 py-2 focus:outline-none" required>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="font-medium text-[#7a5a3a]">Age</label>
                <input type="number" name="age" class="w-full border rounded px-3 py-2 focus:outline-none" required min="1" max="120">
            </div>

            <div>
                <label class="font-medium text-[#7a5a3a]">Mobile</label>
                <input type="text" name="mobile" class="w-full border rounded px-3 py-2 focus:outline-none" required>
            </div>
        </div>

        <div>
            <label class="font-medium text-[#7a5a3a]">Email</label>
            <input type="email" name="email" class="w-full border rounded px-3 py-2 focus:outline-none" required>
        </div>

        <div>
            <label class="font-medium text-[#7a5a3a]">Address</label>
            <input type="text" name="address" class="w-full border rounded px-3 py-2 focus:outline-none" required>
        </div>

        <div>
            <label class="font-medium text-[#7a5a3a]">Service</label>
            <input type="text" name="service" class="w-full border rounded px-3 py-2 focus:outline-none" required>
        </div>

        <div>
            <label class="font-medium text-[#7a5a3a]">Branch</label>
            <input type="text" name="branch" class="w-full border rounded px-3 py-2 focus:outline-none" required>
        </div>

        <div>
            <label class="font-medium text-[#7a5a3a]">Message</label>
            <textarea name="message" rows="3" class="w-full border rounded px-3 py-2 focus:outline-none"></textarea>
        </div>

        <div>
            <label class="font-medium text-[#7a5a3a]">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2 focus:outline-none">
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full py-2 bg-[#7a5a3a] hover:bg-[#6a4f33] text-white font-medium rounded-lg transition">
            Save Appointment
        </button>
    </form>
</div>
@endsection