@extends('layouts.admin')

@section('title', 'Treatment Details')

@section('content')
<div class="max-w-5xl mx-auto py-12 px-6">

    <!-- Header -->
    <div class="flex items-center justify-between mb-10">
        <h1 class="text-3xl font-bold text-[#3c2c20] tracking-wide">Treatment Details</h1>

        <a href="{{ route('admin.treatments.index') }}"
            class="bg-[#e6dbc9] text-[#3c2c20] hover:bg-[#d7c8b2] font-semibold px-5 py-2 rounded-lg transition-all shadow-sm">
            ← Back to Treatments
        </a>
    </div>

    <!-- Content Card -->
    <div class="bg-white shadow-xl rounded-2xl border border-[#e6dbc9] p-10">

        <!-- Image -->
        @if ($treatment->image)
        <div class="mb-10">
            <img src="{{ asset($treatment->image) }}" alt="{{ $treatment->title }}"
                class="w-full h-96 object-cover rounded-2xl border border-[#e6dbc9] shadow-md">
        </div>
        @endif

        <!-- Title -->
        <h2 class="text-3xl font-semibold text-[#3c2c20] mb-4">{{ $treatment->title }}</h2>

        <!-- Button Label -->
        @if ($treatment->button)
        <p class="text-sm bg-[#f7f2eb] px-4 py-2 inline-block rounded-lg border border-[#e6dbc9] text-[#7a5f43] mb-8">
            <span class="font-semibold text-[#b18457]">Button Label:</span> {{ $treatment->button }}
        </p>
        @endif

        <!-- Description -->
        <div class="prose max-w-none text-[#3c2c20] leading-relaxed
            prose-headings:text-[#3c2c20]
            prose-strong:text-[#3c2c20]
            prose-a:text-[#b18457] prose-a:no-underline prose-a:hover:underline
        ">
            {!! $treatment->description !!}
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end mt-12 gap-4">
            <a href="{{ route('admin.treatments.edit', $treatment->id) }}"
                class="bg-[#b18457] hover:bg-[#9b6e45] text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-all flex items-center gap-2">
                <i class="fa-solid fa-pen-to-square"></i> Edit
            </a>

            <form action="{{ route('admin.treatments.destroy', $treatment->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this treatment?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-all flex items-center gap-2">
                    <i class="fa-solid fa-trash-can"></i> Delete
                </button>
            </form>
        </div>

    </div>
</div>
@endsection