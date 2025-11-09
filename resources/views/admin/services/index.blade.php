@extends('layouts.admin')

@section('title', 'Manage Services')

@section('content')
<div class="container mx-auto py-10 px-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row items-center justify-between mb-10 gap-4">
        <h1 class="text-3xl font-bold text-[#3c2c20]">All Services</h1>

        <a href="{{ route('admin.services.create') }}"
            class="bg-[#b18457] hover:bg-[#a1744a] text-white font-semibold px-5 py-2 rounded-lg shadow-md transition-all flex items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            <span>Add New Service</span>
        </a>
    </div>

    <!-- Success -->
    @if(session('success'))
    <div class="mb-6 px-4 py-3 rounded-lg bg-green-100 border border-green-300 text-green-700 shadow-sm">
        {{ session('success') }}
    </div>
    @endif

    <!-- Table -->
    <div class="bg-white shadow-xl rounded-2xl border border-[#e6dbc9] overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-[#f4ece1] text-[#3c2c20] text-sm uppercase tracking-wide">
                <tr>
                    <th class="px-6 py-3 font-semibold">#</th>
                    <th class="px-6 py-3 font-semibold">Image</th>
                    <th class="px-6 py-3 font-semibold">Title</th>
                    <th class="px-6 py-3 font-semibold">Label</th>
                    <th class="px-6 py-3 font-semibold">Slug</th>
                    <th class="px-6 py-3 text-right font-semibold">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-[#f1e9dd]">
                @forelse($services as $service)
                <tr class="hover:bg-[#f9f6f1] transition duration-200">

                    <!-- Correct numbering across pages -->
                    <td class="px-6 py-3 text-[#3c2c20]">
                        {{  $service->id }}
                    </td>

                    <td class="px-6 py-3">
                        @if($service->image)
                        <div class="w-14 h-14 border border-[#e6dbc9] rounded-lg overflow-hidden shadow-sm group">
                            <img src="{{ asset($service->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        </div>
                        @else
                        <span class="text-gray-400 italic">No Image</span>
                        @endif
                    </td>

                    <td class="px-6 py-3 font-semibold text-[#3c2c20]">{{ $service->title }}</td>
                    <td class="px-6 py-3 text-[#3c2c20]">{{ $service->label ?? '—' }}</td>
                    <td class="px-6 py-3 text-sm text-gray-500">{{ $service->slug }}</td>

                    <td class="px-6 py-3 text-right space-x-3 whitespace-nowrap">

                        <!-- Preview -->
                        <a href="{{ route('admin.services.view', $service->id) }}"
                            class="inline-flex items-center gap-1 text-[#b18457] hover:text-[#3c2c20] font-medium transition">
                            <i class="fa-solid fa-eye"></i> View
                        </a>

                        <!-- Edit -->
                        <a href="{{ route('admin.services.edit', $service->id) }}"
                            class="inline-flex items-center gap-1 text-[#3c2c20] hover:text-[#b18457] font-medium transition">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>

                        <!-- Delete -->
                        <form action="{{ route('admin.services.destroy', $service->id) }}"
                            method="POST" class="inline-block"
                            onsubmit="return confirm('Are you sure you want to delete this service?');">
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
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500 italic">
                        No services found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if ($services->hasPages())
    <div class="flex justify-center mt-10">
        <div
            class="inline-flex items-center space-x-2 bg-[#f9f6f1] border border-[#e0d6c6] shadow-md px-4 py-2 rounded-full">
            {{ $services->onEachSide(1)->appends(request()->query())->links('vendor.pagination.custom-tailwind') }}
        </div>
    </div>
    @endif

</div>
@endsection