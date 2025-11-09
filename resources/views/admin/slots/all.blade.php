@extends('layouts.admin')

@section('title', 'All Doctor Slots')

@section('content')
<div class="container mx-auto py-10 px-4">

    <!-- Page Header -->
    <div class="flex justify-between items-center mb-10">
        <a href="{{ route('admin.doctors.index') }}"
            class="px-5 py-2 rounded-lg border border-[#7a5a3a] text-[#7a5a3a] bg-[#f9f4ef] hover:bg-[#7a5a3a] hover:text-white transition shadow-sm">
            <i class="fa-solid fa-arrow-left mr-1"></i> Back
        </a>

        <h1 class="text-3xl font-bold text-[#7a5a3a] text-center flex-1">Doctor Slot Management</h1>

        <div></div>
    </div>

    <!-- Legend -->
    <div class="mb-8 flex gap-8 justify-center text-sm">
        <div class="flex items-center gap-2">
            <span class="w-5 h-5 bg-green-300 rounded-full"></span> <span>Available</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="w-5 h-5 bg-red-300 rounded-full"></span> <span>Booked</span>
        </div>
    </div>

    <!-- Filters -->
    <form method="GET" class="bg-[#f9f6f1] border border-[#e7dbc9] rounded-xl p-6 shadow mb-8 grid grid-cols-1 md:grid-cols-4 gap-5">
        <!-- Doctor Filter -->
        <div>
            <label class="block text-sm font-semibold text-[#7a5a3a] mb-1">Doctor</label>
            <select name="doctor_id"
                class="w-full border border-[#d5c3a9] px-3 py-2 rounded-lg focus:ring-2 focus:ring-[#7a5a3a] shadow-sm">
                <option value="">All Doctors</option>
                @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}" {{ request('doctor_id') == $doctor->id ? 'selected' : '' }}>
                    {{ $doctor->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Date Filter -->
        <div>
            <label class="block text-sm font-semibold text-[#7a5a3a] mb-1">Date</label>
            <input type="date" name="date" value="{{ request('date') }}"
                class="w-full border border-[#d5c3a9] px-3 py-2 rounded-lg focus:ring-2 focus:ring-[#7a5a3a] shadow-sm">
        </div>

        <!-- Status Filter -->
        <div>
            <label class="block text-sm font-semibold text-[#7a5a3a] mb-1">Status</label>
            <select name="status"
                class="w-full border border-[#d5c3a9] px-3 py-2 rounded-lg focus:ring-2 focus:ring-[#7a5a3a] shadow-sm">
                <option value="">All</option>
                <option value="available" {{ request('status') === 'available' ? 'selected' : '' }}>Available</option>
                <option value="booked" {{ request('status') === 'booked' ? 'selected' : '' }}>Booked</option>
            </select>
        </div>

        <!-- Submit -->
        <div class="flex items-end">
            <button type="submit"
                class="w-full bg-[#7a5a3a] text-white py-2 rounded-lg shadow hover:bg-[#604629] transition">
                Filter
            </button>
        </div>
    </form>

    <!-- Slots Table -->
    <div class="overflow-hidden rounded-2xl shadow-lg border border-[#e7dbc9] bg-white">
        <table class="min-w-full text-left">
            <thead class="bg-[#f4ece1] text-[#3c2c20] text-sm uppercase tracking-wide">
                <tr>
                    <th class="px-6 py-3">S no.</th>
                    <th class="px-6 py-3">Doctor</th>
                    <th class="px-6 py-3">Date</th>
                    <th class="px-6 py-3">Start</th>
                    <th class="px-6 py-3">End</th>
                    <th class="px-6 py-3 text-center">Appointments</th>
                    <th class="px-6 py-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($slots as $slot)
                @php $isBooked = $slot->appointments->count() > 0; @endphp

                <tr class="{{ $isBooked ? 'bg-red-50' : 'hover:bg-[#f9f4ef]' }} border-b transition">
                    <td class="px-6 py-3 text-gray-800 font-medium">{{ $loop->iteration }}</td>
                    <td class="px-6 py-3 text-gray-800 font-medium">{{ $slot->doctor?->name }}</td>
                    <td class="px-6 py-3">{{ \Carbon\Carbon::parse($slot->date)->format('d M, Y') }}</td>
                    <td class="px-6 py-3">{{ \Carbon\Carbon::parse($slot->start_time)->format('H:i') }}</td>
                    <td class="px-6 py-3">{{ \Carbon\Carbon::parse($slot->end_time)->format('H:i') }}</td>
                    <td class="px-6 py-3 text-center font-semibold">{{ $slot->appointments->count() }}</td>

                    <td class="px-6 py-3 text-center">
                        @if(!$isBooked)
                        <form action="{{ route('admin.slots.delete', $slot) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this slot?');">
                            @csrf @method('DELETE')
                            <button class="text-white bg-red-600 hover:bg-red-700 px-4 py-1 rounded-lg shadow transition">
                                Delete
                            </button>
                        </form>
                        @else
                        <span class="text-gray-500 italic">Booked</span>
                        @endif
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="6" class="px-6 py-6 text-center text-gray-500 text-lg">No Slots Found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if ($slots->hasPages())
    <div class="flex justify-center mt-10">
        <div class="inline-flex items-center space-x-2 bg-[#f9f6f1] border border-[#e0d6c6] shadow-md px-4 py-2 rounded-full">
            {{ $slots->onEachSide(1)->appends(request()->query())->links('vendor.pagination.custom-tailwind') }}
        </div>
    </div>
    @endif

</div>
@endsection