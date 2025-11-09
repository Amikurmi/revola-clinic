@extends('layouts.admin')

@section('title', 'User Enquiries')

@section('content')
<div class="container mx-auto py-10 px-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row items-center justify-between mb-10 gap-4">
        <h1 class="text-3xl font-bold text-[#3c2c20]">User Enquiries</h1>

        <form method="GET" action="{{ route('admin.enquiries.index') }}">
            <select name="filter" onchange="this.form.submit()"
                class="border border-[#b18457] text-[#3c2c20] bg-[#f5efe6] rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#b18457]">
                <option value="all" {{ $filter === 'all' ? 'selected' : '' }}>All</option>
                <option value="contacted" {{ $filter === 'contacted' ? 'selected' : '' }}>Contacted</option>
                <option value="pending" {{ $filter === 'pending' ? 'selected' : '' }}>Pending</option>
            </select>
        </form>
    </div>

    @if ($enquiries->isEmpty())
    <p class="text-gray-500 text-center py-16 italic">No enquiries yet.</p>
    @else

    <div class="overflow-x-auto shadow-xl rounded-2xl border border-[#e6dbc9] bg-white">
        <table class="min-w-full text-center">
            <thead class="bg-[#f4ece1] text-[#3c2c20] text-sm uppercase tracking-wide">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Mobile</th>
                    <th class="px-4 py-3">Message</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Contacted</th>
                </tr>
            </thead>
            <tbody>
                @foreach($enquiries as $index => $enquiry)
                <tr class="border-t hover:bg-[#f9f6f1] transition-all">
                    <td class="px-4 py-3">{{ $enquiry->id }}</td>

                    <td class="px-4 py-3 font-semibold text-[#3c2c20]">{{ $enquiry->name }}</td>

                    <td class="px-4 py-3">
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $enquiry->email }}" target="_blank" class="inline-flex items-center gap-1 text-[#b18457] hover:text-[#3c2c20]">
                            <i class="fa-solid fa-envelope"></i> {{ $enquiry->email }}
                        </a>
                    </td>

                    <td class="px-4 py-3">
                        <button onclick="showContactOptions('{{ $enquiry->mobile }}')" class="inline-flex items-center gap-1 text-green-600 hover:text-green-800">
                            <i class="fa-solid fa-phone"></i> {{ $enquiry->mobile }}
                        </button>
                    </td>

                    <!-- Message - Click to open full popup -->
                    <td class="px-4 py-3 text-[#3c2c20] max-w-xs truncate cursor-pointer hover:text-[#b18457] transition"
                        onclick="showMessage(`{{ addslashes($enquiry->message) }}`)">
                        {{ $enquiry->message }}
                    </td>

                    <td class="px-4 py-3 text-gray-600">{{ $enquiry->created_at->format('d M Y, h:i A') }}</td>

                    <td class="px-4 py-3">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="peer sr-only" data-id="{{ $enquiry->id }}" {{ $enquiry->contacted ? 'checked' : '' }} onchange="toggleContacted(this)">
                            <div class="w-11 h-6 bg-gray-300 rounded-full peer-checked:bg-[#b18457] transition relative">
                                <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full peer-checked:translate-x-5 transition"></div>
                            </div>
                        </label>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if ($enquiries->hasPages())
    <div class="flex justify-center mt-10">
        <div class="inline-flex items-center space-x-2 bg-[#f9f6f1] border border-[#e0d6c6] shadow-md px-4 py-2 rounded-full">
            {{ $enquiries->onEachSide(1)->appends(request()->query())->links('vendor.pagination.custom-tailwind') }}
        </div>
    </div>
    @endif

    @endif
</div>

<!-- Contact Popup -->
<div id="contactOptions" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-6 shadow-2xl w-80 relative">
        <button onclick="closePopup()" class="absolute top-2 right-3 text-xl text-gray-500 hover:text-black"><i class="fa-solid fa-xmark"></i></button>

        <h2 class="text-lg font-bold text-[#3c2c20] mb-3">Contact User</h2>

        <div class="flex justify-center gap-4 mt-6">
            <a id="callLink" href="#" class="bg-[#b18457] hover:bg-[#a1744a] text-white px-4 py-2 rounded-lg transition">
                <i class="fa-solid fa-phone"></i> Call
            </a>
            <a id="whatsappLink" href="#" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition">
                <i class="fa-brands fa-whatsapp"></i> WhatsApp
            </a>
        </div>
    </div>
</div>

<!-- Full Message Popup -->
<div id="messagePopup" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-6 shadow-2xl w-96 relative">
        <button onclick="closeMessagePopup()" class="absolute top-2 right-3 text-xl text-gray-500 hover:text-black"><i class="fa-solid fa-xmark"></i></button>
        <h2 class="text-lg font-bold text-[#3c2c20] mb-4">Message</h2>
        <p id="messageText" class="text-gray-700 leading-relaxed"></p>
    </div>
</div>

<script>
    function showContactOptions(mobile) {
        document.getElementById('contactOptions').classList.remove('hidden');
        document.getElementById('callLink').href = `tel:${mobile}`;
        document.getElementById('whatsappLink').href = `https://wa.me/${mobile}`;
    }

    function closePopup() {
        document.getElementById('contactOptions').classList.add('hidden');
    }

    function showMessage(message) {
        document.getElementById('messagePopup').classList.remove('hidden');
        document.getElementById('messageText').innerText = message;
    }

    function closeMessagePopup() {
        document.getElementById('messagePopup').classList.add('hidden');
    }

    function toggleContacted(checkbox) {
        fetch(`/admin/enquiries/${checkbox.dataset.id}/contacted`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                contacted: checkbox.checked ? 1 : 0
            })
        });
    }
</script>
@endsection