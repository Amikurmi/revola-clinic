@extends('layouts.admin')

@section('title', 'Create Blog')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-6">

    <!-- Header + Back Button -->
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-[#3c2c20]">Create New Blog</h1>

        <a href="{{ route('admin.blogs.index') }}"
            class="bg-[#8b6f47] text-white px-4 py-2 rounded-lg hover:bg-[#725a3a] transition">
            ← Back
        </a>
    </div>

    <!-- Errors -->
    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Form -->
    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block mb-2 font-semibold">Title <span class="text-red-600">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}"
                class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring focus:ring-[#8b6f47]"
                required>
        </div>

        <div>
            <label class="block mb-2 font-semibold">Category</label>
            <select name="category_id"
                class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring focus:ring-[#8b6f47]">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-2 font-semibold">Excerpt</label>
            <textarea name="excerpt" rows="3"
                class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring focus:ring-[#8b6f47]">{{ old('excerpt') }}</textarea>
        </div>

        <div>
            <label class="block mb-2 font-semibold">Content <span class="text-red-600">*</span></label>
            <textarea id="editor" name="content" rows="6"
                class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring focus:ring-[#8b6f47]"
                required>{{ old('content') }}</textarea>
        </div>

        <div>
            <label class="block mb-2 font-semibold">Image</label>
            <input type="file" name="image"
                class="w-full border border-gray-300 px-3 py-2 rounded cursor-pointer">
        </div>

        <button type="submit"
            class="px-6 py-2 rounded-lg bg-[#8b6f47] text-white font-medium hover:bg-[#725a3a] transition">
            Save Blog
        </button>

    </form>
</div>
@endsection

@section('scripts')
<!-- ✅ TinyMCE CDN -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: '#editor',
        height: 350,
        menubar: false,

        plugins: 'lists link image table code',

        toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist | link table | code | lineheight',

        // Enable heading dropdown
        block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3;',

        // Allow <br> instead of always wrapping <p>
        forced_root_block: false,
        force_br_newlines: true,
        force_p_newlines: false,

        content_style: "body { font-family: 'Inter', sans-serif; font-size: 16px; line-height: 1.7; }"
    });
</script>
@endsection