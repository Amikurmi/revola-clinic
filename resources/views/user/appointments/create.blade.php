@extends('layouts.app')

@section('title', 'Book Appointment - Revola Clinic')
@section('meta')
<meta name="description" content="Book your dermatology appointment at Revola Clinic. Choose your preferred doctor, date, and time for online or personal consultations." />
<meta name="keywords" content="Book Appointment, Dermatology Appointment, Online Consultation, Personal Consultation, Revola Clinic" />
@endsection

@section('content')
<x-centered-text line1="Book Appointment" line2="Home - Appointment" />

<div class="bg-white py-12">
    <div class="max-w-5xl mx-auto bg-[#e4ddca] pt-4 px-4 sm:px-6 lg:px-8">

        {{-- Display Errors --}}
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div x-data="appointmentForm()" class="mb-6">

            {{-- Tabs --}}
            <div class="flex flex-wrap border-b border-gray-300 mb-4">
                <button @click="tab = 'online'"
                    :class="tab === 'online' ? 'border-b-2 border-[#8b5e3c] text-[#8b5e3c]' : 'text-gray-600'"
                    class="px-4 py-2 font-semibold focus:outline-none">Online Consultation</button>
                <button @click="tab = 'personal'"
                    :class="tab === 'personal' ? 'border-b-2 border-[#8b5e3c] text-[#8b5e3c]' : 'text-gray-600'"
                    class="px-4 py-2 font-semibold focus:outline-none">Personal Consultation</button>
            </div>

            {{-- Doctor Selection --}}
            <div class="mb-6">
                <label>Doctor</label>

                <select x-model="doctorId" x-show="tab==='online'" @change="fetchSlots()" class="w-full border border-black px-3 py-2 rounded">
                    <option value="">Select Doctor</option>
                    @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                    @endforeach
                </select>
                <select x-model="doctorIdPersonal" x-show="tab==='personal'" @change="fetchSlotsPersonal()" class="w-full border border-black px-3 py-2 rounded">
                    <option value="">Select Doctor</option>
                    @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                    @endforeach
                </select>

            </div>

            {{-- Slots Grid --}}
            <div class="mb-6">
                <label>Available Slots</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-2">
                    <template x-for="slot in filteredSlots()" :key="slot.id">
                        <button type="button"
                            :class="{
                                'bg-green-500 text-white': slot.remaining > 0 && !isPast(slot) && selectedSlot !== slot.id,
                                'bg-gray-400 text-white': slot.remaining <= 0,
                                'bg-red-500 text-white': isPast(slot),
                                'ring-4 ring-yellow-400': selectedSlot === slot.id
                            }"
                            class="rounded p-3 shadow hover:scale-105 transform transition duration-150"
                            @click="selectSlot(slot)"
                            :disabled="slot.remaining <= 0 || isPast(slot)">
                            <div class="font-semibold" x-text="slot.date"></div>
                            <div x-text="`${slot.start_time} - ${slot.end_time}`"></div>
                            <div x-text="slot.remaining > 0 ? `${slot.remaining} seat${slot.remaining > 1 ? 's' : ''} left` : 'Full'"></div>
                        </button>
                    </template>
                </div>

            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('user.appointments.store') }}"
                class="space-y-4 bg-[#e4ddca] p-6 rounded"
                onsubmit="return validateForm(this)">
                @csrf

                {{-- Patient Details --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <input id="doctor_id" type="hidden" name="doctor_id" required>
                    <input type="hidden" name="slot_id" :value="selectedSlot" required>
                    <div>
                        <label>First Name</label>
                        <input type="text" name="first_name" class="w-full border border-black px-3 py-2 rounded" required>
                    </div>
                    <div>
                        <label>Last Name</label>
                        <input type="text" name="last_name" class="w-full border border-black px-3 py-2 rounded" required>
                    </div>
                </div>

                <div>
                    <label>Age</label>
                    <input type="number" name="age" class="w-full border border-black px-3 py-2 rounded" required>
                </div>

                <div>
                    <label>Email</label>
                    <input type="email" name="email" class="w-full border border-black px-3 py-2 rounded bg-gray-100"
                        value="{{ auth()->user()->email ?? '' }}" readonly required>
                </div>

                <div>
                    <label>Mobile</label>
                    <input type="text" name="mobile" class="w-full border border-black px-3 py-2 rounded" required>
                </div>

                <div>
                    <label>Address</label>
                    <input type="text" name="address" class="w-full border border-black px-3 py-2 rounded" required>
                </div>

                {{-- Service --}}
                <!-- <div>
                    <label>Service</label>
                    <select name="service" class="w-full border border-black px-3 py-2 rounded" required>
                        <option value="">Select Service</option>
                        @foreach($services as $service)
                        <option value="{{ $service }}">{{ $service }}</option>
                        @endforeach
                    </select>
                </div> -->
                <div class="mb-4">
                    <label class="block font-medium mb-1">Select Service or Treatment</label>
                    <select name="service" class="form-select w-full border rounded p-2">
                        <option value="">Select Service / Treatment</option>

                        <!-- Static Services -->
                        <optgroup label="Basic Services">
                            @foreach($staticServices as $static)
                            <option value="{{ $static }}">{{ $static }}</option>
                            @endforeach
                        </optgroup>

                        <!-- Dynamic Services from DB -->
                        <optgroup label="Clinic Services">
                            @foreach($services as $id => $title)
                            <option value="{{ $title }}">{{ $title }}</option>
                            @endforeach
                        </optgroup>

                        <!-- Treatments from DB -->
                        <optgroup label="Treatments">
                            @foreach($treatments as $id => $title)
                            <option value="{{ $title }}">{{ $title }}</option>
                            @endforeach
                        </optgroup>

                    </select>
                </div>



                {{-- Branch --}}
                <div>
                    <label>Branch</label>
                    <select name="branch" class="w-full border border-black px-3 py-2 rounded" required>
                        <option value="">Select Branch</option>
                        @foreach($branches as $branch)
                        <option value="{{ $branch }}">{{ $branch }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Message --}}
                <div>
                    <label>Message</label>
                    <textarea name="message" class="w-full border border-black px-3 py-2 rounded"></textarea>
                </div>

                {{-- Terms --}}
                <div>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="terms" class="mr-2 terms-checkbox">
                        I agree to the <a href="#" class="text-[#8b5e3c] underline">Terms & Conditions</a>
                    </label>
                </div>

                {{-- Buttons --}}
                <div class="flex justify-between">
                    <a href="{{ route('user.appointments.index') }}"
                        class="flex items-center justify-center gap-2 px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition transform hover:-translate-y-0.5 shadow-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                    <button type="submit" class="bg-[#8b5e3c] text-white px-4 py-2 rounded">
                        Book Appointment
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="//unpkg.com/alpinejs" defer></script>
<script>
    function appointmentForm() {
        return {
            tab: 'personal', // Default tab
            doctorId: '',
            doctorIdPersonal: '',
            slots: [],
            slotsPersonal: [],
            selectedSlot: '',

            fetchSlots() {
                if (!this.doctorId) {
                    this.slots = [];
                    this.selectedSlot = '';
                    return;
                }
                document.getElementById('doctor_id').value = this.doctorId;
                fetch(`/user/doctor/${this.doctorId}/slots`)
                    .then(res => res.json())
                    .then(data => {
                        this.slots = data;
                        this.selectedSlot = '';
                    });
            },

            fetchSlotsPersonal() {
                if (!this.doctorIdPersonal) {
                    this.slotsPersonal = [];
                    this.selectedSlot = '';
                    return;
                }
                document.getElementById('doctor_id').value = this.doctorIdPersonal;
                console.log(document.getElementById('doctor_id').value);
                fetch(`/user/doctor/${this.doctorIdPersonal}/slots`)
                    .then(res => res.json())
                    .then(data => {
                        this.slotsPersonal = data;
                        this.selectedSlot = '';
                    });
            },

            filteredSlots() {
                let arr = this.tab === 'online' ? this.slots : this.slotsPersonal;
                return arr.filter(slot => new Date(slot.date + 'T' + slot.start_time) > new Date());
            },

            isPast(slot) {
                return new Date(slot.date + 'T' + slot.start_time) < new Date();
            },

            selectSlot(slot) {
                if (!this.isPast(slot) && slot.remaining > 0) {
                    this.selectedSlot = slot.id;
                }
            }
        }
    }

    // Frontend validation
    function validateForm(form) {
        if (!form.doctor_id.value) {
            alert('Please select a doctor');
            return false;
        }
        if (!form.slot_id.value) {
            alert('Please select a slot');
            return false;
        }
        const terms = form.querySelector('.terms-checkbox');
        if (!terms.checked) {
            alert('You must agree to Terms & Conditions');
            terms.focus();
            return false;
        }
        return true;
    }
</script>
@endsection