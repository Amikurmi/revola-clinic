@extends('layouts.admin')

@section('title', 'Edit Doctor Slot')

@section('content')
<div class="container mx-auto py-6 max-w-lg">
    <h1 class="text-2xl font-bold mb-6 text-[#8b5e3c]">Edit Doctor Slot</h1>

    @if($errors->any())
    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.slots.update', $slot->id) }}" method="POST" class="bg-white p-6 rounded shadow-md space-y-4">
        @csrf
        @method('PUT')

        {{-- Doctor --}}
        <div>
            <label class="block font-medium mb-1">Doctor</label>
            <select name="doctor_id" class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-2 focus:ring-[#8b5e3c]" required>
                @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}" {{ $slot->doctor_id == $doctor->id ? 'selected' : '' }}>
                    {{ $doctor->name }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Date --}}
        <div>
            <label class="block font-medium mb-1">Date</label>
            <input type="date" name="date" class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-2 focus:ring-[#8b5e3c]"
                value="{{ $slot->date }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
        </div>

        {{-- Start Time --}}
        <div>
            <label class="block font-medium mb-1">Start Time</label>
            <input type="time" name="start_time" class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-2 focus:ring-[#8b5e3c]"
                value="{{ $slot->start_time }}" required>
        </div>

        {{-- End Time --}}
        <div>
            <label class="block font-medium mb-1">End Time</label>
            <input type="time" name="end_time" class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-2 focus:ring-[#8b5e3c]"
                value="{{ $slot->end_time }}" required>
        </div>

        {{-- Max Patients --}}
        <div>
            @php
            // Ensure appointments_count exists
            $booked = $slot->appointments_count ?? $slot->appointments()->count() ?? 0;
            @endphp
            <label class="block font-medium mb-1">Max Patients
                <span class="text-gray-500 text-sm">(Min: {{ $booked }}, Max: 255)</span>
            </label>
            <input type="number" name="max_patients"
                class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-2 focus:ring-[#8b5e3c]"
                value="{{ $slot->max_patients }}" min="{{ $booked }}" max="255" required>
        </div>

        <button type="submit"
            class="w-full px-4 py-2 bg-[#8b5e3c] hover:bg-[#7a4f2f] text-white rounded font-semibold transition">
            Update Slot
        </button>
    </form>
</div>
@endsection