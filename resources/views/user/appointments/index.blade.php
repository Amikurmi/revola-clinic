@extends('layouts.app')

@section('title', 'My Appointments - Revola Clinic')
@section('meta')
<meta name="description" content="View and manage your appointments at Revola Clinic. Book, reschedule, or cancel your dermatology appointments with ease." />
<meta name="keywords" content="My Appointments, Book Appointment, Reschedule Appointment, Cancel Appointment, Revola Clinic" />
@endsection

@section('content')
<x-centered-text line1="My Appointments" line2="Home - My Appointments" />

<div class="max-w-6xl mx-auto my-12 px-4 sm:px-6 lg:px-8">

    {{-- Success Message --}}
    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    {{-- Error Messages --}}
    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Book Appointment Button --}}
    <div class="flex justify-end mb-6">
        <a href="{{ route('user.appointments.create') }}"
            class="bg-[#8b5e3c] hover:bg-[#7a4f2f] text-white px-4 py-2 rounded-lg shadow">
            <i class="fa-solid fa-plus"></i> Book Appointment
        </a>
    </div>

    {{-- Desktop Table --}}
    <div class="hidden md:block overflow-x-auto bg-white rounded-lg shadow-lg">
        <table class="w-full border-collapse">
            <thead class="bg-[#e4ddca] text-[#3b3b3b]">
                <tr>
                    <th class="px-4 py-3 border text-left">Doctor</th>
                    <th class="px-4 py-3 border text-left">Date</th>
                    <th class="px-4 py-3 border text-left">Time</th>
                    <th class="px-4 py-3 border text-left">Service</th>
                    <th class="px-4 py-3 border text-left">Status</th>
                    <th class="px-4 py-3 border text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($appointments as $appointment)
                @php
                $isExpired = $appointment->isExpired ?? false;
                @endphp
                <tr class="hover:bg-[#f9f3eb] transition">
                    <td class="px-4 py-3 border text-[#3b3b3b]">{{ $appointment->doctor->name ?? 'N/A' }}</td>
                    <td class="px-4 py-3 border text-[#3b3b3b]">{{ $appointment->slot->date ?? '-' }}</td>
                    <td class="px-4 py-3 border text-[#3b3b3b]">
                        {{ \Carbon\Carbon::parse($appointment->slot->start_time)->format('h:i A') }} -
                        {{ \Carbon\Carbon::parse($appointment->slot->end_time)->format('h:i A') }}
                    </td>
                    <td class="px-4 py-3 border text-[#3b3b3b]">{{ $appointment->service }}</td>

                    {{-- STATUS --}}
                    <td class="px-4 py-3 border text-center">
                        @if($isExpired)
                        <span class="inline-flex items-center gap-1 bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
                            Expired
                        </span>
                        @elseif($appointment->status === 'pending')
                        <span class="inline-flex items-center gap-1 bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">
                            Pending
                        </span>
                        @elseif($appointment->status === 'confirmed')
                        <span class="inline-flex items-center gap-1 bg-[#8b5e3c]/20 text-[#8b5e3c] px-3 py-1 rounded-full text-sm font-semibold">
                            Confirmed
                        </span>
                        @elseif($appointment->status === 'completed')
                        <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                            Completed
                        </span>
                        @endif
                    </td>

                    {{-- ACTIONS --}}
                    <td class="px-4 py-3 border text-center">

                        @if($appointment->status === 'completed')
                        <a href="{{ route('user.appointments.summary', $appointment->id) }}"
                            class="bg-[#8b5e3c] text-white px-3 py-1 rounded-lg shadow-sm">
                            View Summary
                        </a>

                        @elseif(!$isExpired && $appointment->status === 'pending')
                        <a href="{{ route('user.appointments.edit', $appointment->id) }}"
                            class="bg-[#8b5e3c] hover:bg-[#7a4f2f] text-white px-3 py-1 rounded-lg shadow-sm">
                            Reschedule
                        </a>

                        <form action="{{ route('user.appointments.destroy', $appointment->id) }}" method="POST"
                            class="inline-block ml-2"
                            onsubmit="return confirm('Are you sure you want to cancel this appointment?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg shadow-sm">
                                Cancel
                            </button>
                        </form>

                        @elseif($appointment->status === 'confirmed')
                        <a href="{{ route('user.appointments.treatment', $appointment->id) }}"
                            class="bg-[#8b5e3c] text-white px-3 py-1 rounded-lg shadow-sm">
                            Proceed
                        </a>

                        @elseif($isExpired)
                        <span class="text-red-500 font-semibold">Expired</span>
                        @else
                        <span class="text-gray-400">—</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-4 text-center text-gray-500">No appointments found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Mobile Cards --}}
    <div class="md:hidden space-y-4">
        @forelse ($appointments as $appointment)
        @php
        $isExpired = $appointment->isExpired ?? false;
        @endphp
        <div class="bg-white shadow-lg rounded-xl p-4">
            <div class="flex justify-between items-center mb-2">
                <h3 class="font-semibold text-[#3b3b3b]">{{ $appointment->doctor->name ?? 'N/A' }}</h3>

                @if($isExpired)
                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">Expired</span>
                @elseif($appointment->status === 'pending')
                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">Pending</span>
                @elseif($appointment->status === 'confirmed')
                <span class="bg-[#8b5e3c]/20 text-[#8b5e3c] px-3 py-1 rounded-full text-sm font-semibold">Confirmed</span>
                @elseif($appointment->status === 'completed')
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">Completed</span>
                @endif
            </div>

            <p class="text-[#3b3b3b]/90 mb-1"><strong>Date:</strong> {{ $appointment->slot->date }}</p>
            <p class="text-[#3b3b3b]/90 mb-1"><strong>Time:</strong>
                {{ \Carbon\Carbon::parse($appointment->slot->start_time)->format('h:i A') }} -
                {{ \Carbon\Carbon::parse($appointment->slot->end_time)->format('h:i A') }}
            </p>
            <p class="text-[#3b3b3b]/90 mb-2"><strong>Service:</strong> {{ $appointment->service }}</p>

            <div class="flex flex-wrap gap-2">

                @if($appointment->status === 'completed')
                <a href="{{ route('user.appointments.summary', $appointment->id) }}"
                    class="bg-[#8b5e3c] text-white px-3 py-1 rounded-lg shadow-sm">
                    View Summary
                </a>

                @elseif(!$isExpired && $appointment->status === 'pending')
                <a href="{{ route('user.appointments.edit', $appointment->id) }}"
                    class="bg-[#8b5e3c] hover:bg-[#7a4f2f] text-white px-3 py-1 rounded-lg shadow-sm">
                    Reschedule
                </a>
                <form action="{{ route('user.appointments.destroy', $appointment->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to cancel this appointment?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg shadow-sm">
                        Cancel
                    </button>
                </form>

                @elseif($appointment->status === 'confirmed')
                <a href="{{ route('user.appointments.treatment', $appointment->id) }}"
                    class="bg-[#8b5e3c] text-white px-3 py-1 rounded-lg shadow-sm">
                    Proceed
                </a>

                @elseif($isExpired)
                <span class="text-red-500 font-semibold">Expired</span>

                @else
                <span class="text-gray-400">—</span>
                @endif

            </div>
        </div>
        @empty
        <p class="text-center text-gray-500">No appointments found.</p>
        @endforelse
    </div>

</div>
@endsection