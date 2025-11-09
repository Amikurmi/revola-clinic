@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">

    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
        <h1 class="text-3xl font-bold text-[#7a5a3a]">Consultation Requests</h1>

        <form method="GET">
            <select name="filter" onchange="this.form.submit()"
                class="border border-[#7a5a3a] text-[#7a5a3a] rounded-lg px-3 py-2 focus:outline-none">
                <option value="all" {{ $filter === 'all' ? 'selected' : '' }}>All</option>
                <option value="contacted" {{ $filter === 'contacted' ? 'selected' : '' }}>Contacted</option>
                <option value="pending" {{ $filter === 'pending' ? 'selected' : '' }}>Pending</option>
            </select>
        </form>
    </div>

    <div class="overflow-x-auto shadow rounded-lg border border-gray-200">
        <table class="min-w-full bg-white text-center rounded-lg">
            <thead class="bg-[#f4ece1] text-[#3c2c20] text-sm uppercase tracking-wide">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Treatment</th>
                    <th class="px-4 py-3">Preferred Date</th>
                    <th class="px-4 py-3">Contact</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Message</th>
                    <th class="px-4 py-3">Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($consultations as $index => $c)
                <tr class="border-t hover:bg-gray-100 transition">
                    <td class="px-4 py-3">{{ $c->id }}</td>
                    <td class="px-4 py-3 font-semibold">{{ $c->name }}</td>
                    <td class="px-4 py-3">{{ $c->treatment->title }}</td>
                    <td class="px-4 py-3">{{ $c->preferred_date }}</td>

                    {{-- Phone Popup Trigger --}}
                    <td class="px-4 py-3">
                        <button onclick="showContactPopup('{{ $c->contact_number }}', '{{ $c->email }}', '{{ $c->name }}')"
                            class="text-green-600 hover:underline flex items-center justify-center gap-1">
                            <i class="fa-solid fa-phone"></i> {{ $c->contact_number }}
                        </button>
                    </td>

                    {{-- Email Click Gmail Compose --}}
                    <td class="px-4 py-3">
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $c->email }}&su=Regarding%20Your%20Enquiry"
                            target="_blank"
                            class="text-blue-600 hover:underline flex items-center justify-center gap-1">
                            <i class="fa-solid fa-envelope text-[#7a5a3a]"></i> {{ $c->email }}
                        </a>
                    </td>

                    <td class="px-4 py-3 text-gray-700">{{ Str::limit($c->message, 35) }}</td>

                    {{-- Status Toggle --}}
                    <td class="px-4 py-3">
                        <input type="checkbox"
                            class="w-5 h-5 accent-[#7a5a3a] cursor-pointer"
                            data-id="{{ $c->id }}"
                            data-number="{{ $c->contact_number }}"
                            data-name="{{ $c->name }}"
                            {{ $c->status ? 'checked' : '' }}
                            onchange="toggleContacted(this)">
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="py-8 text-gray-500">No consultation requests yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

     {{-- Pagination --}}
        @if ($consultations->hasPages())
        <div class="flex justify-center mt-10">
            <div
                class="inline-flex items-center space-x-2 bg-[#f9f6f1] border border-[#e0d6c6] shadow-md px-4 py-2 rounded-full">
                {{ $consultations->onEachSide(1)->appends(request()->query())->links('vendor.pagination.custom-tailwind') }}
            </div>
        </div>
        @endif


</div>

{{-- Contact Options Popup --}}
<div id="contactOptions" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center z-50">
    <div class="bg-white p-6 rounded-2xl shadow-xl text-center w-80 relative">
        <button onclick="closePopup()" class="absolute top-2 right-3 text-gray-600 text-lg hover:text-black">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <h2 class="text-lg font-bold mb-4 text-[#7a5a3a]">Contact Options</h2>
        <p class="text-gray-700 mb-6">Choose how you want to contact the user:</p>
        <div class="flex justify-center gap-4">
            <a id="callLink" href="#" target="_blank"
                class="bg-[#7a5a3a] text-white px-4 py-2 rounded-lg hover:bg-[#60462b] transition">
                <i class="fa-solid fa-phone-volume mr-1"></i> Call
            </a>
            <a id="whatsappLink" href="#" target="_blank"
                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                <i class="fa-brands fa-whatsapp mr-1"></i> WhatsApp
            </a>
        </div>
    </div>
</div>

<script>
    // ✅ Show Contact Popup (Same Style as Enquiries Page)
    function showContactPopup(number, email, name) {
        const popup = document.getElementById('contactOptions');
        popup.classList.remove('hidden');

        // Clean phone number formatting
        let cleaned = (number || '').replace(/\D/g, '');

        // Set Call & WhatsApp Links
        document.getElementById('callLink').href = `tel:${cleaned}`;
        document.getElementById('whatsappLink').href = `https://wa.me/${cleaned}?text=Hello ${name}, regarding your consultation request...`;
    }

    // ✅ Close Popup
    function closePopup() {
        document.getElementById('contactOptions').classList.add('hidden');
    }

    // ✅ Toggle Contacted Status + Send WhatsApp Message if checked
    function toggleContacted(checkbox) {
        fetch(`/admin/consultations/${checkbox.dataset.id}/contacted`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(() => {
            if (checkbox.checked) {
                // Prepare WhatsApp Auto Message
                let number = checkbox.dataset.number.replace(/\D/g, '');
                let name = checkbox.dataset.name;
                window.open(`https://wa.me/${number}?text=Hello ${name}, we have reviewed and contacted you. Thank you! 😊`, "_blank");
            }
        }).catch(() => alert("Error updating status"));
    }
</script>

@endsection