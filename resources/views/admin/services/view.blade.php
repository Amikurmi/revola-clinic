@extends('layouts.admin')

@section('title', $service->title ?? 'Service Details')

@section('content')
<div class="max-w-5xl mx-auto my-16 bg-white p-8 rounded-2xl shadow-md">

    <!-- Title -->
    <h2 class="text-3xl font-bold mb-4">{{ $service->title }}</h2>

    <!-- Label -->
    @if($service->label)
    <p class="text-sm uppercase text-blue-600 font-semibold mb-3">{{ $service->label }}</p>
    @endif

    <!-- Image -->
    @if($service->image)
    <img src="{{ asset($service->image) }}" alt="{{ $service->title }}"
        class="rounded-xl shadow-md w-full object-cover h-80 mb-6">
    @endif

    <!-- Description (Rendered Rich HTML) -->
    <div class="prose max-w-none text-gray-700 leading-relaxed mb-8">
        {!! $service->description !!}
    </div>

    <!-- Buttons -->
    <div class="flex gap-3">
        <a href="{{ route('admin.services.index') }}"
            class="px-5 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium transition">
            ← Back to Services
        </a>

        <a href="{{ route('admin.services.edit', $service->id) }}"
            class="px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-medium transition">
            ✏️ Edit Service
        </a>
    </div>

</div>
@endsection