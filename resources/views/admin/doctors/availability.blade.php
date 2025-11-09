@extends('layouts.admin')

@section('title', 'Doctor Availability')

@section('content')
<div class="container mx-auto py-8">

    <!-- Page Header -->
    <div class="flex justify-between items-center mb-8">
        <a href="{{ route('admin.doctors.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-4 py-2 rounded shadow">
            Back
        </a>
        <h1 class="text-3xl font-bold text-gray-800 text-center flex-1">{{ $doctor->name }} - Weekly Availability</h1>
        <div></div>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 max-w-4xl mx-auto">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 max-w-4xl mx-auto">
        {{ session('error') }}
    </div>
    @endif

    <!-- Legend -->
    <div class="mb-6 flex gap-6 justify-center">
        <div class="flex items-center gap-2">
            <span class="w-5 h-5 bg-green-200 rounded"></span>
            <span class="text-gray-700 font-medium">Available</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="w-5 h-5 bg-gray-300 rounded"></span>
            <span class="text-gray-700 font-medium">Unavailable / Disabled</span>
        </div>
    </div>

    <!-- Add / Update Availability Form -->
    <form id="availabilityForm" action="{{ route('admin.doctors.saveAvailability', $doctor) }}" method="POST" class="mb-10 max-w-4xl mx-auto bg-white shadow rounded-lg p-6">
        @csrf
        <h2 class="text-2xl font-semibold mb-6 text-gray-700">Set / Edit Availability Per Day</h2>

        <div class="grid grid-cols-1 gap-4">
            @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
            @php
            $dayAvailability = $doctor->availabilities->where('day_of_week', $day)->first();
            @endphp
            <div class="bg-gray-50 border rounded-lg p-4 flex flex-col gap-3 relative">
                <!-- Day Name -->
                <label class="font-semibold text-gray-800">{{ $day }}</label>

                <!-- Active / Inactive Toggle -->
                <div class="absolute top-4 right-4 flex items-center gap-2">
                    <label class="text-gray-700 text-sm">Active</label>
                    <input type="checkbox" name="availability[{{ $day }}][is_active]" value="1"
                        class="form-checkbox h-5 w-5 text-blue-600"
                        {{ $dayAvailability?->is_active ? 'checked' : '' }}>
                </div>

                <div class="flex gap-2 items-center mt-4">
                    <!-- Start Time -->
                    <div class="flex-1">
                        <label class="block text-gray-700 text-sm mb-1">Start Time</label>
                        <input type="time" name="availability[{{ $day }}][start_time]"
                            class="time-input w-full border border-gray-300 px-3 py-2 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            data-day="{{ $day }}"
                            value="{{ $dayAvailability?->start_time }}">
                    </div>

                    <!-- End Time -->
                    <div class="flex-1">
                        <label class="block text-gray-700 text-sm mb-1">End Time</label>
                        <input type="time" name="availability[{{ $day }}][end_time]"
                            class="time-input w-full border border-gray-300 px-3 py-2 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            data-day="{{ $day }}"
                            value="{{ $dayAvailability?->end_time }}">
                    </div>

                    <!-- Slot Duration -->
                    <div class="flex-1">
                        <label class="block text-gray-700 text-sm mb-1">Slot Duration (min)</label>
                        <input type="number" name="availability[{{ $day }}][slot_duration]"
                            class="w-full border border-gray-300 px-3 py-2 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ $dayAvailability?->slot_duration ?? 30 }}" min="5">
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Weeks Selection -->
        <div class="mb-6 mt-6 max-w-xs">
            <label class="block mb-2 font-medium text-gray-700">Generate Slots For:</label>
            <select name="weeks" class="w-full border border-gray-300 px-4 py-2 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @for($w=1; $w<=4; $w++)
                    <option value="{{ $w }}" {{ $w == 1 ? 'selected' : '' }}>{{ $w }} Week{{ $w > 1 ? 's' : '' }}</option>
                    @endfor
            </select>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button id="submitBtn" type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
                Save Availability & Generate Slots
            </button>
        </div>
    </form>

    <!-- Existing Availability -->
    <h2 class="text-2xl font-semibold mb-4 text-gray-700 text-center">Current Availability</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($doctor->availabilities as $availability)
        <div class="bg-white shadow-md rounded-lg p-4 border-l-4 {{ $availability->is_active ? 'border-blue-500' : 'border-gray-400' }} flex flex-col justify-between">
            <p class="font-semibold text-gray-800">{{ $availability->day_of_week }}</p>
            <p class="text-gray-600">Time: {{ $availability->start_time }} - {{ $availability->end_time }}</p>
            <p class="text-gray-600">Slot Duration: {{ $availability->slot_duration }} mins</p>
            <p class="text-gray-500 mt-1">Status: {{ $availability->is_active ? 'Active' : 'Inactive' }}</p>
        </div>
        @empty
        <p class="col-span-full text-center text-gray-500">No availability set yet.</p>
        @endforelse
    </div>

</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const now = new Date();
        const currentHour = now.getHours().toString().padStart(2, '0');
        const currentMinute = now.getMinutes().toString().padStart(2, '0');
        const minTime = `${currentHour}:${currentMinute}`;
        const submitBtn = document.getElementById('submitBtn');

        const validateTimes = () => {
            let valid = true;
            const todayName = new Intl.DateTimeFormat('en-US', {
                weekday: 'long'
            }).format(now);
            document.querySelectorAll('.time-input').forEach(input => {
                const day = input.dataset.day;
                input.classList.remove('border-red-500');
                input.title = '';

                if (day === todayName && input.value && input.value < minTime) {
                    valid = false;
                    input.classList.add('border-red-500');
                    input.title = 'Cannot select past time for today';
                }
            });
            submitBtn.disabled = !valid;
        };

        validateTimes();

        document.querySelectorAll('.time-input').forEach(input => {
            input.addEventListener('change', validateTimes);
        });
    });
</script>
@endsection