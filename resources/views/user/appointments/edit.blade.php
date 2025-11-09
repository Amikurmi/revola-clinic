@extends('layouts.app')

@section('title', 'Reschedule Appointment - Revola Clinic')
@section('meta')
<meta name="description" content="Reschedule your dermatology appointment at Revola Clinic. Choose a new date and time that fits your schedule for personalized care." />
<meta name="keywords" content="Reschedule Appointment, Change Appointment, Dermatology Appointment, Revola Clinic" />
@endsection

@section('content')
<x-centered-text line1="Reschedule Appointment" line2="Home - Appointment" />

<div class="max-w-3xl mx-auto my-12 px-4 sm:px-6 lg:px-8" x-data="rescheduleForm()">

    {{-- Error Messages --}}
    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li><i class="fas fa-exclamation-circle text-red-600"></i> {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Reschedule Form --}}
    <form action="{{ route('user.appointments.update', $appointment->id) }}" method="POST"
        class="bg-[#e4ddca] p-6 sm:p-8 rounded-2xl shadow-lg space-y-6 border border-[#8b5e3c]/20 transition hover:shadow-2xl duration-300"
        onsubmit="return validateReschedule(this)">
        @csrf
        @method('PUT')

        {{-- Current Slot --}}
        <div>
            <label class="block text-[#3b3b3b] font-medium mb-2 flex items-center gap-2">
                <i class="fas fa-calendar-alt text-[#8b5e3c]"></i> Current Slot
            </label>
            <p class="text-[#3b3b3b] bg-[#e4ddca]/30 p-2 rounded">
                {{ $appointment->slot->doctor->name ?? 'N/A' }} |
                {{ $appointment->slot->date }} |
                {{ \Carbon\Carbon::parse($appointment->slot->start_time)->format('h:i A') }} -
                {{ \Carbon\Carbon::parse($appointment->slot->end_time)->format('h:i A') }}
            </p>
        </div>

        {{-- New Slot Selection --}}
        <div>
            <label class="block text-[#3b3b3b] font-medium mb-3 flex items-center gap-2">
                <i class="fas fa-clock text-[#8b5e3c]"></i> Choose a New Slot
            </label>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($slots as $slot)
                @php
                $remaining = $slot->max_patients - ($slot->appointments_count ?? 0);
                $isPast = \Carbon\Carbon::parse($slot->date . ' ' . $slot->start_time)->isPast();
                @endphp
                @if ($remaining > 0 && !$isPast)
                <button type="button"
                    class="rounded-lg p-3 shadow hover:scale-105 transform transition duration-150 text-center font-medium"
                    :class="selectedSlot === {{ $slot->id }} 
                        ? 'ring-4 ring-yellow-400 bg-green-600 text-white' 
                        : 'bg-green-500 text-white hover:bg-green-600'"
                    @click="selectSlot({{ $slot->id }})">
                    <div>{{ $slot->doctor->name ?? 'N/A' }}</div>
                    <div class="text-sm">{{ $slot->date }}</div>
                    <div class="text-sm">
                        {{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }} -
                        {{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }}
                    </div>
                    <div class="text-xs opacity-90">{{ $remaining }} seat{{ $remaining > 1 ? 's' : '' }} left</div>
                </button>
                @endif
                @endforeach
            </div>

            <input type="hidden" name="slot_id" x-model="selectedSlot" required>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row justify-between gap-3 sm:gap-4">
            <a href="{{ route('user.appointments.index') }}"
                class="flex items-center justify-center gap-2 px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition transform hover:-translate-y-0.5 shadow-sm w-full sm:w-auto">
                <i class="fas fa-arrow-left"></i> Back
            </a>

            <button type="submit"
                class="flex items-center justify-center gap-2 px-4 py-2 bg-[#8b5e3c] hover:bg-[#7a4f2f] text-white rounded-lg transition transform hover:-translate-y-0.5 shadow-sm w-full sm:w-auto">
                <i class="fas fa-sync-alt"></i> Update Appointment
            </button>
        </div>
    </form>
</div>

<script src="//unpkg.com/alpinejs" defer></script>
<script>
    function rescheduleForm() {
        return {
            selectedSlot: '',
            selectSlot(id) {
                this.selectedSlot = id;
            }
        };
    }

    // Basic validation before submitting
    function validateReschedule(form) {
        if (!form.slot_id.value) {
            alert('Please select a new slot before submitting.');
            return false;
        }
        return true;
    }
</script>
@endsection