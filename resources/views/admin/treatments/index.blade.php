@extends('layouts.admin')

@section('title', 'Manage Treatments')

@section('content')
<div class="container mx-auto py-10 px-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row items-center justify-between mb-10 gap-4">
        <h1 class="text-3xl font-bold text-[#3c2c20]">Manage Treatments</h1>

        <div class="flex items-center gap-3 w-full md:w-auto">
            <!-- Search -->
            <form method="GET" action="{{ route('admin.treatments.index') }}"
                class="flex items-center border border-[#d6c7b4] rounded-lg overflow-hidden w-full md:w-72 bg-white shadow-sm focus-within:ring-2 focus-within:ring-[#b18457]/50">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search treatments..."
                    class="flex-1 px-4 py-2 focus:outline-none text-[#3c2c20] placeholder:text-[#a58f7a] bg-transparent">

                @if(request('search'))
                <a href="{{ route('admin.treatments.index') }}"
                    class="px-3 text-[#b18457] hover:text-[#3c2c20] transition" title="Clear search">
                    <i class="fa-solid fa-xmark"></i>
                </a>
                @endif

                <button type="submit"
                    class="bg-[#b18457] px-4 py-2 text-white hover:bg-[#a1744a] transition-all">
                    <i class="fa-solid fa-search"></i>
                </button>
            </form>

            <!-- Add Button -->
            <a href="{{ route('admin.treatments.create') }}"
                class="bg-[#b18457] hover:bg-[#a1744a] text-white font-semibold px-5 py-2 rounded-lg shadow-md transition-all flex items-center gap-2">
                <i class="fa-solid fa-plus"></i>
                <span>Add Treatment</span>
            </a>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white shadow-xl rounded-2xl border border-[#e6dbc9] overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-[#f4ece1] text-[#3c2c20] text-sm uppercase tracking-wide">
                <tr>
                    <th class="px-6 py-3 font-semibold">Image</th>
                    <th class="px-6 py-3 font-semibold">Title</th>
                    <th class="px-6 py-3 font-semibold">Button Label</th>
                    <th class="px-6 py-3 font-semibold">Created</th>
                    <th class="px-6 py-3 text-right font-semibold">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-[#f1e9dd]">
                @forelse ($treatments as $treatment)
                <tr class="hover:bg-[#f9f6f1] transition duration-200">
                    <!-- Image -->
                    <td class="px-6 py-3">
                        <div class="w-16 h-16 rounded-md overflow-hidden border border-[#e6dbc9] shadow-sm group">
                            <img src="{{ asset($treatment->image) }}" alt="{{ $treatment->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        </div>
                    </td>

                    <!-- Title -->
                    <td class="px-6 py-3 font-semibold text-[#3c2c20]">
                        {{ $treatment->title }}
                    </td>

                    <!-- Button Label -->
                    <td class="px-6 py-3 text-[#3c2c20]">
                        {{ $treatment->button ?? 'Learn More' }}
                    </td>

                    <!-- Created Date -->
                    <td class="px-6 py-3 text-sm text-gray-600">
                        {{ $treatment->created_at->format('M d, Y') }}
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-3 text-right space-x-3 whitespace-nowrap">
                        <!-- View -->
                        <a href="{{ route('admin.treatments.show', $treatment->id) }}"
                            class="inline-flex items-center gap-1 text-[#b18457] hover:text-[#3c2c20] font-medium transition">
                            <i class="fa-solid fa-eye"></i> View
                        </a>

                        <!-- Edit -->
                        <a href="{{ route('admin.treatments.edit', $treatment->id) }}"
                            class="inline-flex items-center gap-1 text-[#3c2c20] hover:text-[#b18457] font-medium transition">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>

                        <!-- Delete -->
                        <form action="{{ route('admin.treatments.destroy', $treatment->id) }}" method="POST"
                            class="inline-block"
                            onsubmit="return confirm('Are you sure you want to delete this treatment?');">
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
                <!-- Empty State -->
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="text-gray-500 italic mb-3">
                            No treatments found.
                        </div>
                        <a href="{{ route('admin.treatments.create') }}"
                            class="inline-flex items-center gap-2 bg-[#b18457] text-white px-4 py-2 rounded-md shadow hover:bg-[#a1744a] transition">
                            <i class="fa-solid fa-plus"></i> Add First Treatment
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if ($treatments->hasPages())
    <div class="flex justify-center mt-10">
        <div class="inline-flex items-center space-x-2 bg-[#f9f6f1] border border-[#e0d6c6] shadow-md px-4 py-2 rounded-full">
            {{ $treatments->onEachSide(1)->appends(['search' => request('search')])->links('vendor.pagination.custom-tailwind') }}
        </div>
    </div>
    @endif
</div>
@endsection