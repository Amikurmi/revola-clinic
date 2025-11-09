@extends('layouts.app')

@section('title', 'Treatment Session - Revola Clinic')
@section('meta')
<meta name="description" content="Details of your upcoming treatment session at Revola Clinic. View patient information, consulting doctor, treatment details, and appointment confirmation." />
<meta name="keywords" content="Treatment Session, Appointment Details, Patient Information, Consulting Doctor, Treatment Details, Revola Clinic" />
@endsection

@section('content')
<x-centered-text line1="Treatment Session" line2="Home - Treatment" />

<div class="max-w-3xl mx-auto my-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-lg rounded-2xl p-5 sm:p-8 text-center border border-gray-100 transition-all hover:shadow-2xl duration-300">

        <!-- Title -->
        <h1 class="text-2xl sm:text-3xl font-bold mb-4 text-[#8b5e3c] flex items-center justify-center gap-2 flex-wrap">
            <i class="fas fa-leaf text-lg sm:text-xl"></i>
            Welcome to Your Treatment Session
        </h1>

        <!-- Doctor & Confirmation -->
        <p class="text-[#3b3b3b] mb-3 text-base sm:text-lg flex flex-wrap items-center justify-center gap-2 leading-relaxed">
            <i class="fas fa-user-md text-[#8b5e3c] text-base sm:text-lg"></i>
            Your appointment with <strong>{{ $appointment->doctor->name }}</strong> is
            <span class="text-[#8b5e3c] font-semibold flex items-center gap-1">
                <i class="fas fa-check-circle"></i> Confirmed
            </span>
        </p>

        <!-- Date and Time -->
        <div class="bg-[#fdf8f5] border border-[#8b5e3c]/20 rounded-xl p-4 sm:p-5 mb-4 flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4 text-center">
            <i class="fas fa-calendar-alt text-[#8b5e3c] text-lg sm:text-xl"></i>
            <p class="text-[#3b3b3b] text-base sm:text-lg font-semibold">
                {{ \Carbon\Carbon::parse($appointment->slot->date)->format('F j, Y') }}
                <span class="block sm:inline text-[#8b5e3c] font-medium">
                    ({{ \Carbon\Carbon::parse($appointment->slot->start_time)->format('h:i A') }} -
                    {{ \Carbon\Carbon::parse($appointment->slot->end_time)->format('h:i A') }})
                </span>
            </p>
        </div>

        <!-- Add to Google Calendar -->
        <a href="{{ $calendarLink }}"
            target="_blank"
            class="inline-flex items-center gap-2 px-4 py-2 mt-3 bg-[#8b5e3c] text-white text-sm rounded-lg hover:bg-[#0f5fcc] transition shadow-sm">
            <i class="far fa-calendar-plus text-white"></i> Add to Google Calendar
        </a>

        <!-- WhatsApp Reminder -->
        <!-- @php
        $msg = urlencode("Hello {$appointment->first_name}, this is a reminder about your treatment session today. Please arrive 10 minutes early. - Revola Skin & Hair Clinic");
        @endphp

        <a href="https://wa.me/{{ $appointment->mobile }}?text={{ $msg }}"
            class="inline-flex items-center gap-2 px-4 py-2 mt-3 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 transition shadow-sm">
            <i class="fab fa-whatsapp text-white"></i> Send WhatsApp Reminder
        </a> -->

        <!-- Branch Info -->
        <p class="text-[#3b3b3b]/80 mt-6 text-sm sm:text-base flex flex-wrap items-center justify-center gap-2 leading-relaxed">
            <i class="fas fa-map-marker-alt text-[#8b5e3c] text-base sm:text-lg"></i>
            Please arrive <strong>10 minutes early</strong> at the
            <span class="font-semibold text-[#3b3b3b]">{{ $appointment->branch }}</span> branch.
        </p>

        <!-- Patient Details -->
        <div class="text-left bg-[#faf7f4] border border-[#8b5e3c]/20 rounded-xl p-5 shadow-inner mb-6">
            <h2 class="text-lg font-semibold text-[#8b5e3c] mb-3 flex items-center gap-2">
                <i class="fas fa-user"></i> Patient Information
            </h2>
            <p class="text-sm text-gray-700"><strong>Name:</strong> {{ $appointment->first_name }} {{ $appointment->last_name }}</p>
            <p class="text-sm text-gray-700"><strong>Age:</strong> {{ $appointment->age }}</p>
            <p class="text-sm text-gray-700"><strong>Mobile:</strong> {{ $appointment->mobile }}</p>
            <p class="text-sm text-gray-700"><strong>Email:</strong> {{ $appointment->email }}</p>

            <a href="https://www.google.com/maps/dir/?api=1&destination=21.1294329,79.0604979"
                target="_blank"
                class="inline-flex items-center gap-2 px-4 py-2 mt-3 bg-[#8b5e3c] text-white text-sm rounded-lg hover:bg-[#6f4a2c] transition shadow-sm">
                <i class="fas fa-location-arrow text-white"></i> Get Directions
            </a>
        </div>

        <!-- Treatment Details -->
        <div class="text-left bg-[#faf7f4] border border-[#8b5e3c]/20 rounded-xl p-5 shadow-inner mb-6">
            <h2 class="text-lg font-semibold text-[#8b5e3c] mb-3 flex items-center gap-2">
                <i class="fas fa-spa"></i> Treatment Details
            </h2>
            <p class="text-sm text-gray-700"><strong>Service:</strong> {{ $appointment->service }}</p>
            <p class="text-sm text-gray-700"><strong>Branch:</strong> {{ $appointment->branch }}</p>
            @if($appointment->message)
            <p class="text-sm text-gray-700 leading-relaxed mt-2"><strong>Notes:</strong><br>{{ $appointment->message }}</p>
            @endif
        </div>

        <!-- Back Button -->
        <a href="{{ route('user.appointments.index') }}"
            class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-[#8b5e3c] text-white rounded-lg hover:bg-[#7a4f2f] transition shadow-sm text-sm sm:text-base">
            Back to Appointments
        </a>

    </div>
</div>

@endsection