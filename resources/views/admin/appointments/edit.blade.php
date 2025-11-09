@extends('layouts.admin')

@section('title', 'Edit Appointment')

@section('content')
<div class="container mx-auto py-6 max-w-lg">
    <h1 class="text-2xl font-bold mb-6">Edit Appointment</h1>

    @if($errors->any())
    <div class="mb-4 text-red-600">
        <ul>
            @foreach($errors->all() as $error)
            <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.appointments.update', $appointment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label>Doctor</label>
            <select name="doctor_id" class="w-full border px-3 py-2 rounded" required>
                @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}" {{ $appointment->doctor_id == $doctor->id ? 'selected' : '' }}>
                    {{ $doctor->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label>Slot</label>
            <select name="slot_id" class="w-full border px-3 py-2 rounded" required>
                @foreach($slots as $slot)
                <option value="{{ $slot->id }}" {{ $appointment->slot_id == $slot->id ? 'selected' : '' }}>
                    {{ $slot->date }} ({{ $slot->start_time }} - {{ $slot->end_time }})
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label>First Name</label>
            <input type="text" name="first_name" class="w-full border px-3 py-2 rounded" value="{{ $appointment->first_name }}" required>
        </div>

        <div class="mb-4">
            <label>Last Name</label>
            <input type="text" name="last_name" class="w-full border px-3 py-2 rounded" value="{{ $appointment->last_name }}" required>
        </div>

        <div class="mb-4">
            <label>Age</label>
            <input type="number" name="age" class="w-full border px-3 py-2 rounded" value="{{ $appointment->age }}" required min="1" max="120">
        </div>

        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email" class="w-full border px-3 py-2 rounded" value="{{ $appointment->email }}" required>
        </div>

        <div class="mb-4">
            <label>Mobile</label>
            <input type="text" name="mobile" class="w-full border px-3 py-2 rounded" value="{{ $appointment->mobile }}" required>
        </div>

        <div class="mb-4">
            <label>Address</label>
            <input type="text" name="address" class="w-full border px-3 py-2 rounded" value="{{ $appointment->address }}" required>
        </div>

        <div class="mb-4">
            <label>Service</label>
            <input type="text" name="service" class="w-full border px-3 py-2 rounded" value="{{ $appointment->service }}" required>
        </div>

        <div class="mb-4">
            <label>Branch</label>
            <input type="text" name="branch" class="w-full border px-3 py-2 rounded" value="{{ $appointment->branch }}" required>
        </div>

        <div class="mb-4">
            <label>Message</label>
            <textarea name="message" class="w-full border px-3 py-2 rounded" rows="3">{{ $appointment->message }}</textarea>
        </div>

        <div class="mb-4">
            <label>Status</label>
            <select name="status" class="w-full border px-3 py-2 rounded" required>
                <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Update Appointment</button>
    </form>
</div>
@endsection