@extends('layouts.admin')
@section('title', 'Appointment Details')

@section('content')
<div class="container mx-auto py-10 px-6">

    <!-- Top Heading -->
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-[#3c2c20]">Appointment Details</h1>

        <!-- Back Button -->
        <a href="{{ route('admin.appointments.index') }}"
            class="inline-flex items-center gap-2 bg-[#e6dbc9] hover:bg-[#d5c6b3] text-[#3c2c20] px-5 py-2 rounded-full shadow-md transition-all">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    </div>

    <!-- Appointment Card -->
    <div class="bg-white border border-[#e6dbc9] shadow-[0_6px_20px_rgba(0,0,0,0.08)] rounded-2xl p-8 space-y-8">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6">

            <div>
                <h3 class="font-semibold text-[#7b6955] text-sm uppercase tracking-wide">Patient Name</h3>
                <p class="text-lg text-[#3c2c20]">{{ $appointment->first_name }} {{ $appointment->last_name }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-[#7b6955] text-sm uppercase tracking-wide">Email</h3>
                <p class="text-lg text-[#3c2c20]">{{ $appointment->email }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-[#7b6955] text-sm uppercase tracking-wide">Mobile</h3>
                <p class="text-lg text-[#3c2c20]">{{ $appointment->mobile }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-[#7b6955] text-sm uppercase tracking-wide">Age</h3>
                <p class="text-lg text-[#3c2c20]">{{ $appointment->age }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-[#7b6955] text-sm uppercase tracking-wide">Doctor</h3>
                <p class="text-lg text-[#3c2c20]">{{ $appointment->doctor->name }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-[#7b6955] text-sm uppercase tracking-wide">Service / Treatment</h3>
                <p class="text-lg text-[#3c2c20]">{{ $appointment->service }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-[#7b6955] text-sm uppercase tracking-wide">Branch</h3>
                <p class="text-lg text-[#3c2c20]">{{ $appointment->branch }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-[#7b6955] text-sm uppercase tracking-wide">Status</h3>

                @if($isExpired)
                <span class="px-4 py-1 rounded-full bg-red-100 text-red-700 font-semibold text-sm">Expired</span>
                @else
                <span class="px-4 py-1 rounded-full bg-[#f4ece1] text-[#3c2c20] font-semibold text-sm">
                    {{ ucfirst($appointment->status) }}
                </span>
                @endif
            </div>

        </div>

        @if($appointment->slot)
        <div class="border-t border-[#e6dbc9] pt-5">
            <h3 class="font-semibold text-[#7b6955] text-sm uppercase tracking-wide mb-2">Appointment Slot</h3>
            <p class="text-lg text-[#3c2c20]">
                {{ \Carbon\Carbon::parse($appointment->slot->date)->format('d M, Y') }} •
                {{ \Carbon\Carbon::parse($appointment->slot->start_time)->format('h:i A') }} -
                {{ \Carbon\Carbon::parse($appointment->slot->end_time)->format('h:i A') }}
            </p>
        </div>
        @endif

        @if($appointment->message)
        <div class="border-t border-[#e6dbc9] pt-5">
            <h3 class="font-semibold text-[#7b6955] text-sm uppercase tracking-wide mb-2">Message</h3>
            <p class="text-lg text-[#3c2c20] leading-relaxed">{{ $appointment->message }}</p>
        </div>
        @endif


        <!-- ✅ Action Buttons Section -->
        <div class="border-t border-[#e6dbc9] pt-6 flex flex-col md:flex-row gap-4">

            {{-- ✅ Show WhatsApp Button ONLY IF CONFIRMED --}}
            @if(!$isExpired && $appointment->status == 'confirmed')

            <a href="https://wa.me/{{ $appointment->mobile }}?text=Hello {{ $appointment->first_name }},%0A%0AThis is a confirmation from *Revola Skin & Hair Clinic* 🏥.%0A%0AYour appointment is *confirmed*.%0A%0A📅 *Date:* {{ optional($appointment->slot)->date }}%0A⏰ *Time:* {{ optional($appointment->slot)->start_time }}%0A%0AWe look forward to seeing you! 😊"
                target="_blank"
                class="inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-full shadow-md transition-all">
                <i class="fa-brands fa-whatsapp"></i> Send WhatsApp Message
            </a>

            @else
            <p class="text-[#7b6955] italic text-sm">
                WhatsApp button will appear only when appointment is <strong>Confirmed</strong>.
            </p>
            @endif

        </div>

    </div>
</div>
@endsection