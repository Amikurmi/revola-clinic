@extends('layouts.admin')

@section('title', 'Doctor Slots')

@section('content')
<div class="container mx-auto py-10 px-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row items-center justify-between mb-10 gap-4">
        <h1 class="text-3xl font-bold text-[#3c2c20]">Doctor Slots</h1>

        <a href="{{ route('admin.slots.create') }}"
            class="bg-[#b18457] hover:bg-[#a1744a] text-white font-semibold px-5 py-2 rounded-lg shadow-md transition-all flex items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            <span>Add Slot</span>
        </a>
    </div>

    @if(session('success'))
    <div class="mb-6 px-4 py-3 rounded-lg bg-green-100 border border-green-300 text-green-700">
        {{ session('success') }}
    </div>
    @endif

    <!-- Table Container -->
    <div class="bg-white shadow-xl rounded-2xl border border-[#e6dbc9] overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-[#f4ece1] text-[#3c2c20] text-sm uppercase tracking-wide">
                <tr>
                    <th class="px-6 py-3 font-semibold">ID</th>
                    <th class="px-6 py-3 font-semibold">Doctor</th>
                    <th class="px-6 py-3 font-semibold">Date</th>
                    <th class="px-6 py-3 font-semibold">Start</th>
                    <th class="px-6 py-3 font-semibold">End</th>
                    <th class="px-6 py-3 font-semibold">Max Patients</th>
                    <th class="px-6 py-3 text-right font-semibold">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-[#f1e9dd]">
                @forelse($slots as $slot)
                <tr class="hover:bg-[#f9f6f1] transition duration-200">
                    <td class="px-6 py-3 text-[#3c2c20]">{{ $slot->id }}</td>
                    <td class="px-6 py-3 text-[#3c2c20]">{{ $slot->doctor->name }}</td>
                    <td class="px-6 py-3 text-[#3c2c20]">{{ $slot->date }}</td>
                    <td class="px-6 py-3 text-[#3c2c20]">{{ $slot->start_time }}</td>
                    <td class="px-6 py-3 text-[#3c2c20]">{{ $slot->end_time }}</td>
                    <td class="px-6 py-3 text-[#3c2c20]">{{ $slot->max_patients }}</td>

                    <td class="px-6 py-3 text-right space-x-3 whitespace-nowrap">
                        <!-- Edit -->
                        <a href="{{ route('admin.slots.edit', $slot->id) }}"
                            class="inline-flex items-center gap-1 text-[#3c2c20] hover:text-[#b18457] font-medium transition">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>

                        <!-- Delete -->
                        <form action="{{ route('admin.slots.destroy', $slot->id) }}" method="POST"
                            class="inline-block"
                            onsubmit="return confirm('Are you sure you want to delete this slot?');">
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
                        No slots found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if ($slots->hasPages())
    <div class="flex justify-center mt-10">
        <div class="inline-flex items-center space-x-2 bg-[#f9f6f1] border border-[#e0d6c6] shadow-md px-4 py-2 rounded-full">
            {{ $slots->onEachSide(1)->links('vendor.pagination.custom-tailwind') }}
        </div>
    </div>
    @endif

</div>
@endsection