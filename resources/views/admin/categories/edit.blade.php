@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Edit Category</h1>

    @if ($errors->any())
    <div class="bg-red-200 text-red-800 px-4 py-2 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
            <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1">Category Name</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" class="w-full border px-3 py-2 rounded" required>
        </div>
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update Category</button>
    </form>
</div>
@endsection