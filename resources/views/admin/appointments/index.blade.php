@extends('layouts.admin')

@section('title', 'Appointments')

@section('content')
<div class="container mx-auto py-10 px-6">

    <!-- Header -->
    <div class="flex items-center justify-between mb-10">
        <h1 class="text-3xl font-bold text-[#3c2c20]">All Appointments</h1>

        <!-- Filter -->
        <form method="GET" action="{{ route('admin.appointments.index') }}" class="mb-6">
            <div class="flex items-center gap-3">
                <select name="status" class="border border-[#d9cfc0] bg-white text-[#3c2c20] px-3 py-2 rounded-lg shadow-sm">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                </select>

                <button type="submit"
                    class="bg-[#3c2c20] text-white px-4 py-2 rounded-lg hover:bg-[#5a4a3a] transition">
                    Filter
                </button>

                @if(request('status'))
                <a href="{{ route('admin.appointments.index') }}" class="text-sm underline text-[#3c2c20]">
                    Reset
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="mb-6 px-4 py-3 rounded-lg bg-green-100 border border-green-300 text-green-700 shadow-sm">
        {{ session('success') }}
    </div>
    @endif

    <!-- Table -->
    <div class="bg-white shadow-xl rounded-2xl border border-[#e6dbc9] overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-[#f4ece1] text-[#3c2c20] text-sm uppercase tracking-wide">
                <tr>
                    <th class="px-6 py-3 font-semibold">ID</th>
                    <th class="px-6 py-3 font-semibold">Doctor</th>
                    <th class="px-6 py-3 font-semibold">Slot</th>
                    <th class="px-6 py-3 font-semibold">Patient</th>
                    <th class="px-6 py-3 font-semibold">Service</th>
                    <th class="px-6 py-3 font-semibold">Status</th>
                    <th class="px-6 py-3 text-right font-semibold">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-[#f1e9dd]">
                @forelse($appointments as $appointment)
                @php
                $slot = $appointment->slot;
                $isExpired = false;

                if($slot && \Carbon\Carbon::parse($slot->date)->isPast() && $appointment->status !== 'completed') {
                $isExpired = true;
                }
                @endphp

                <tr class="hover:bg-[#f9f6f1] transition duration-200 {{ $isExpired ? 'opacity-60 bg-red-50' : '' }}">

                    <td class="px-6 py-3 text-[#3c2c20]">{{ $appointment->id }}</td>

                    <td class="px-6 py-3 text-[#3c2c20] font-semibold">
                        {{ $appointment->doctor->name }}
                    </td>

                    <td class="px-6 py-3 text-[#3c2c20]">
                        @if($slot)
                        {{ \Carbon\Carbon::parse($slot->date)->format('d M, Y') }}
                        ({{ \Carbon\Carbon::parse($slot->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($slot->end_time)->format('H:i') }})
                        @else
                        —
                        @endif
                    </td>

                    <td class="px-6 py-3 text-[#3c2c20]">
                        {{ $appointment->first_name }} {{ $appointment->last_name }}
                    </td>

                    <td class="px-6 py-3 text-[#3c2c20]">{{ $appointment->service }}</td>

                    <!-- Status Column -->
                    <td class="px-6 py-3 text-[#3c2c20]">
                        @if($isExpired)
                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 font-semibold">Expired</span>
                        @elseif($appointment->status == 'completed')
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold">Completed</span>
                        @else
                        <form action="{{ route('admin.appointments.updateStatus', $appointment->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status"
                                onchange="this.form.submit()"
                                class="border border-[#d9cfc0] bg-[#f9f6f1] text-[#3c2c20] px-3 py-1 rounded-lg shadow-sm focus:ring focus:ring-[#b18457] focus:outline-none">
                                <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </form>
                        @endif
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-3 text-right whitespace-nowrap">
                        <a href="{{ route('admin.appointments.show', $appointment->id) }}"
                            class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-700 font-medium transition mr-3">
                            <i class="fa-solid fa-eye"></i> View
                        </a>

                        <form action="{{ route('admin.appointments.destroy', $appointment->id) }}"
                            method="POST" class="inline-block"
                            onsubmit="return confirm('Are you sure you want to delete this appointment?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center gap-1 text-red-600 hover:text-red-700 font-medium transition">
                                <i class="fa-solid fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-500 italic">
                        No appointments found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection