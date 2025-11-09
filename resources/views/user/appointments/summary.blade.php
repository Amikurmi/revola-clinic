@extends('layouts.app')

@section('title', 'Appointment Summary - Revola Clinic')
@section('meta')
<meta name="description" content="View the summary of your completed appointment at Revola Clinic. Access patient details, consulting doctor information, treatment notes, and follow-up guidance." />
<meta name="keywords" content="Appointment Summary, Completed Appointment, Patient Details, Consulting Doctor, Treatment Notes, Follow-Up Guidance, Revola Clinic" />
@endsection

@section('content')

<style>
    .gold-gradient {
        background: linear-gradient(135deg, #d8c39c, #b79b72);
    }

    .lux-card {
        background: #ffffff;
        border: 1px solid #e1d7c8;
        border-radius: 28px;
        box-shadow: 0 20px 50px rgba(60, 44, 32, 0.10);
    }

    .divider {
        height: 1px;
        background: linear-gradient(to right, transparent, #c8b79a, transparent);
        margin: 2.5rem 0;
    }
</style>

<div class="min-h-screen bg-[#f4f1ea] py-12 px-4 lg:px-12">

    <div class="lux-card max-w-5xl mx-auto p-4 md:p-14 relative">

        <!-- Top Badge -->
        <div class="hidden sm:flex absolute -top-5 left-1/2 -translate-x-1/2 bg-[#8b5e3c] text-white px-2 md:px-4 py-2.5 rounded-full shadow-lg text-xs sm:text-sm font-semibold">
            APPOINTMENT COMPLETED
        </div>


        <!-- Title Section -->
        <div class="text-center mt-6 mb-12">
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-[#3c2c20]">Thank You for Visiting</h1>
            <p class="text-[#907d67] text-sm mt-2">
                Your treatment session has been successfully recorded.
            </p>
            <span class="text-green-700 font-semibold text-xs sm:text-sm mt-1 inline-block">
                Status: Completed
            </span>
        </div>

        <!-- Patient & Doctor Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">

            <!-- Patient Section -->
            <div class="bg-[#fbf8f3] border border-[#e4d9c8] rounded-xl p-6 shadow-inner">
                <h2 class="text-lg font-semibold text-[#3c2c20] mb-4">Patient Information</h2>
                <ul class="text-sm text-[#3c2c20] space-y-2">
                    <li><strong>Name:</strong> {{ $appointment->first_name }} {{ $appointment->last_name }}</li>
                    <li><strong>Age:</strong> {{ $appointment->age ?? 'N/A' }}</li>
                    <li><strong>Phone:</strong> {{ $appointment->mobile ?? 'N/A' }}</li>
                    <li><strong>Email:</strong> {{ $appointment->email ?? 'N/A' }}</li>
                </ul>
            </div>

            <!-- Doctor Section -->
            <div class="bg-[#fbf8f3] border border-[#e4d9c8] rounded-xl p-6 shadow-inner">
                <h2 class="text-lg font-semibold text-[#3c2c20] mb-4">Consulting Doctor</h2>
                <ul class="text-sm text-[#3c2c20] space-y-2">
                    <li><strong>Name:</strong> Dr. {{ $appointment->doctor->name ?? 'N/A' }}</li>
                    <li><strong>Specialization:</strong> {{ $appointment->doctor->specialization ?? 'N/A' }}</li>
                    <li><strong>Experience:</strong> {{ $appointment->doctor->experience_years ?? 'N/A' }} years</li>
                    <li><strong>Phone:</strong> {{ $appointment->doctor->phone ?? 'N/A' }} </li>
                </ul>
            </div>

        </div>

        <div class="divider"></div>

        <!-- Appointment Details -->
        <div class="mb-12">
            <h2 class="text-lg font-semibold text-[#3c2c20] mb-4">Appointment Details</h2>
            <ul class="text-sm text-[#3c2c20] space-y-2">
                <li><strong>Service:</strong> {{ $appointment->service ?? 'N/A' }}</li>
                <li><strong>Branch:</strong> {{ $appointment->branch ?? 'N/A' }}</li>

                @if($appointment->slot)
                <li><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->slot->date)->format('d M Y') }}</li>
                <li><strong>Time:</strong>
                    {{ \Carbon\Carbon::parse($appointment->slot->start_time)->format('h:i A') }}
                    to
                    {{ \Carbon\Carbon::parse($appointment->slot->end_time)->format('h:i A') }}
                </li>
                @endif
            </ul>
        </div>

        <!-- Treatment Notes -->
        <div class="mb-10">
            <h2 class="text-lg font-semibold text-[#3c2c20] mb-4">Treatment Notes / Observations</h2>
            <div class="bg-[#fffefb] border border-[#e4d9c8] rounded-xl p-6 text-sm leading-relaxed text-[#3c2c20] shadow-inner">
                {!! nl2br(e($appointment->message ?? 'No notes provided.')) !!}
            </div>
        </div>

        <!-- Follow Up Guidance -->
        <div class="bg-[#eee7db] p-6 rounded-xl text-sm text-[#3c2c20] mb-10">
            <strong class="font-medium text-[#3c2c20]">Next Steps / Follow-Up Care:</strong>
            <p class="mt-2">
                Please follow the given skincare instructions and book a follow-up if symptoms persist or improvement tracking is required.
            </p>
        </div>

        <!-- Footer -->
        <p class="text-xs text-center text-[#927d66]">
            Thank you for choosing <strong>Revola Skin & Hair Clinic</strong>. We value your trust.
        </p>

        <!-- Back Button -->
        <div class="text-center mt-8">
            <a href="{{ route('user.appointments.index') }}"
                class="inline-flex items-center px-6 py-3 bg-[#8b5e3c] text-white rounded-lg transition text-sm shadow">
                <i class="fa-solid fa-arrow-left"></i> Back to Appointments
            </a>
        </div>

    </div>
</div>

@endsection