@extends('layouts.admin')

@section('title', 'Doctors List')

@section('content')
<div class="container mx-auto py-10 px-6">

    <!-- Header + Search + Add -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-10">
        <h1 class="text-3xl font-bold text-[#3c2c20]">Doctors List</h1>

        <div class="flex items-center gap-3 w-full md:w-auto">

            <!-- Search -->
            <form method="GET" action="{{ route('admin.doctors.index') }}"
                class="flex items-center border border-[#d6c7b4] rounded-lg overflow-hidden w-full md:w-72 bg-white shadow-sm focus-within:ring-2 focus-within:ring-[#b18457]/50">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search doctor..."
                    class="flex-1 px-4 py-2 focus:outline-none text-[#3c2c20] placeholder:text-[#a58f7a] bg-transparent">

                @if(request('search'))
                <a href="{{ route('admin.doctors.index') }}"
                    class="px-3 text-[#b18457] hover:text-[#3c2c20] transition" title="Clear search">
                    <i class="fa-solid fa-xmark"></i>
                </a>
                @endif

                <button type="submit"
                    class="bg-[#b18457] px-4 py-2 text-white hover:bg-[#a1744a] transition-all">
                    <i class="fa-solid fa-search"></i>
                </button>
            </form>

            <!-- Add Doctor -->
            <a href="{{ route('admin.doctors.create') }}"
                class="bg-[#7a5a3a] text-white px-5 py-2 rounded-lg shadow-md hover:bg-[#604629] transition flex items-center gap-2">
                <i class="fa-solid fa-user-plus"></i>
                Add Doctor
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white shadow-xl rounded-2xl border border-[#e6dbc9] overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-[#f4ece1] text-[#3c2c20] text-sm uppercase tracking-wide">
                <tr>
                    <th class="px-6 py-3">#</th>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Specialization</th>
                    <th class="px-6 py-3">Rating</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#f1e9dd]">
                @forelse($doctors as $doctor)
                <tr class="hover:bg-[#f9f6f1] transition duration-200">
                    <td class="px-6 py-4 text-[#3c2c20]">{{ $doctor->id }}</td>

                    <td class="px-6 py-4 font-semibold text-[#3c2c20]">{{ $doctor->name }}</td>

                    <td class="px-6 py-4 text-[#6b6156]">{{ $doctor->specialization ?? '-' }}</td>

                    <td class="px-6 py-4 text-[#6b6156]">{{ $doctor->rating ?? '-' }}</td>

                    <td class="px-6 py-4 text-right whitespace-nowrap flex justify-end gap-4">

                        <!-- View -->
                        <a href="{{ route('admin.doctors.edit', $doctor) }}"
                            class="inline-flex items-center gap-1 text-[#b18457] hover:text-[#3c2c20] transition">
                            <i class="fa-solid fa-eye"></i> View
                        </a>

                        <!-- Availability -->
                        <a href="{{ route('admin.doctors.availability', $doctor) }}"
                            class="inline-flex items-center gap-1 text-[#3c2c20] hover:text-[#b18457] transition">
                            <i class="fa-solid fa-calendar-days"></i> Availability
                        </a>

                        <!-- Delete -->
                        <form action="{{ route('admin.doctors.destroy', $doctor) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this doctor?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center gap-1 text-red-600 hover:text-red-700 transition">
                                <i class="fa-solid fa-trash"></i> Delete
                            </button>
                        </form>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500 italic">
                        No doctors found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    {{-- Pagination --}}
    @if ($doctors->hasPages())
    <div class="flex justify-center mt-10">
        <div
            class="inline-flex items-center space-x-2 bg-[#f9f6f1] border border-[#e0d6c6] shadow-md px-4 py-2 rounded-full">
            {{ $doctors->onEachSide(1)->appends(request()->query())->links('vendor.pagination.custom-tailwind') }}
        </div>
    </div>
    @endif


</div>
@endsection