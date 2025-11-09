<div style="text-align:center; font-family: sans-serif;">
    <h2 style="margin-bottom: 5px;">Revola Skin & Hair Clinic</h2>
    <p>1st Floor, B-1, Srinivas Apartment, Bajaj Nagar, Nagpur</p>
    <hr>

    <h3>Appointment Slip</h3>
    <p><strong>Patient:</strong> {{ $appointment->first_name }} {{ $appointment->last_name }}</p>
    <p><strong>Doctor:</strong> {{ $appointment->doctor->name }}</p>
    <p><strong>Service:</strong> {{ $appointment->service }}</p>

    @if($appointment->slot)
    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->slot->date)->format('d M, Y') }}</p>
    <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->slot->start_time)->format('h:i A') }} -
        {{ \Carbon\Carbon::parse($appointment->slot->end_time)->format('h:i A') }}
    </p>
    @endif

    @if(isset($qr))
    <img src="{{ $qr }}" width="120" alt="QR Code">
    @endif

</div>