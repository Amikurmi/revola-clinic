@extends('layouts.admin')

@section('title', 'Add Doctor Slot')

@section('content')
<div class="container mx-auto py-6 max-w-lg">
    <h1 class="text-2xl font-bold mb-6 text-[#8b5e3c]">Add Doctor Slot</h1>

    @if($errors->any())
    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.slots.store') }}" method="POST" class="bg-white p-6 rounded shadow-md space-y-4">
        @csrf

        {{-- Doctor --}}
        <div>
            <label class="block font-medium mb-1">Doctor</label>
            <select name="doctor_id" class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-2 focus:ring-[#8b5e3c]" required>
                <option value="">Select Doctor</option>
                @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Date --}}
        <div>
            <label class="block font-medium mb-1">Date</label>
            <input type="date" name="date" class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-2 focus:ring-[#8b5e3c]"
                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
        </div>

        {{-- Start Time --}}
        <div>
            <label class="block font-medium mb-1">Start Time</label>
            <input type="time" name="start_time" class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-2 focus:ring-[#8b5e3c]" required>
        </div>

        {{-- End Time --}}
        <div>
            <label class="block font-medium mb-1">End Time</label>
            <input type="time" name="end_time" class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-2 focus:ring-[#8b5e3c]" required>
        </div>

        {{-- Max Patients --}}
        <div>
            <label class="block font-medium mb-1">Max Patients <span class="text-gray-500 text-sm">(1-255)</span></label>
            <input type="number" name="max_patients" class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-2 focus:ring-[#8b5e3c]"
                value="4" min="1" max="255" required>
        </div>

        <button type="submit"
            class="w-full px-4 py-2 bg-[#8b5e3c] hover:bg-[#7a4f2f] text-white rounded font-semibold transition">
            Save Slot
        </button>
    </form>
</div>
@endsection