@extends('layouts.admin')

@section('title', 'Blogs')

@section('content')
<div class="container mx-auto px-4 py-10">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-semibold text-[#8b6f47]">Blog Posts</h1>
        <a href="{{ route('admin.blogs.create') }}"
            class="bg-[#8b6f47] hover:bg-[#725a39] text-white px-6 py-2 rounded-lg shadow-lg transition">
            + Add New Blog
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="mb-6 px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded-lg shadow-sm">
        {{ session('success') }}
    </div>
    @endif

    <!-- Table Card -->
    <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-gray-200">
        <table class="w-full text-left border-collapse">
            <thead class="bg-[#f4ece1] text-[#3c2c20] text-sm uppercase tracking-wide">
                <tr>
                    <th class="px-6 py-4 font-medium border-b">S no.</th>
                    <th class="px-6 py-4 font-medium border-b">Title</th>
                    <th class="px-6 py-4 font-medium border-b">Category</th>
                    <th class="px-6 py-4 font-medium border-b text-center">Image</th>
                    <th class="px-6 py-4 font-medium border-b text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($blogs as $blog)
                <tr class="hover:bg-[#f8f3ec] transition">
                    <td class="px-6 py-4 border-b">{{ $blog->id }}</td>
                    <td class="px-6 py-4 border-b">{{ $blog->title }}</td>

                    <td class="px-6 py-4 border-b">
                        {{ $blog->category?->name ?? 'Uncategorized' }}
                    </td>

                    <td class="px-6 py-4 border-b text-center">
                        @if($blog->image)
                        <img src="{{ asset('storage/' . $blog->image) }}" class="w-6 h-6 rounded-lg object-cover shadow">
                        @else
                        <span class="text-gray-500 italic">No Image</span>
                        @endif
                    </td>

                    <td class="px-6 py-4 border-b text-center flex justify-center gap-3">

                        <a href="{{ route('admin.blogs.view', $blog) }}"
                            class="inline-flex items-center gap-1 text-[#b18457] hover:text-[#3c2c20] font-medium transition">
                            <i class="fa-solid fa-eye"></i> View
                        </a>

                        <a href="{{ route('admin.blogs.edit', $blog) }}"
                            class="inline-flex items-center gap-1 text-[#3c2c20] hover:text-[#b18457] font-medium transition">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>

                        <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST"
                            onsubmit="return confirm('Delete this blog?')" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button
                                class="inline-flex items-center gap-1 text-red-600 hover:text-red-700 font-medium transition">
                                <i class="fa-solid fa-trash"></i> Delete
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if ($blogs->hasPages())
    <div class="flex justify-center mt-10">
        <div
            class="inline-flex items-center space-x-2 bg-[#f9f6f1] border border-[#e0d6c6] shadow-md px-4 py-2 rounded-full">
            {{ $blogs->onEachSide(1)->appends(request()->query())->links('vendor.pagination.custom-tailwind') }}
        </div>
    </div>
    @endif


</div>
@endsection