@extends('layouts.admin')

@section('title', 'Add Service')

@section('content')
<div class="max-w-3xl mx-auto mt-12 bg-white p-8 rounded-2xl shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Add New Service</h2>

    {{-- ✅ Display Validation Errors --}}
    @if ($errors->any())
    <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- ✅ Display Success Message --}}
    @if(session('success'))
    <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">
        {{ session('success') }}
    </div>
    @endif

    {{-- ✅ Form Start --}}
    <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="space-y-6">

            {{-- Title --}}
            <div>
                <label class="block font-semibold mb-1 text-gray-700">Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" class="w-full border border-gray-300 rounded p-2 focus:ring-2 focus:ring-[#c3a68a] focus:outline-none" required>
            </div>

            {{-- Label --}}
            <div>
                <label class="block font-semibold mb-1 text-gray-700">Label</label>
                <input type="text" name="label" value="{{ old('label') }}" class="w-full border border-gray-300 rounded p-2 focus:ring-2 focus:ring-[#c3a68a] focus:outline-none">
            </div>

            {{-- Button --}}
            <div>
                <label class="block font-semibold mb-1 text-gray-700">Button Text</label>
                <input type="text" name="button" value="{{ old('button', 'View Services') }}" class="w-full border border-gray-300 rounded p-2 focus:ring-2 focus:ring-[#c3a68a] focus:outline-none">
            </div>

            {{-- Description (Rich Editor) --}}
            <div class="lux-editor-wrapper bg-[#f8f5ef] border border-[#ddcdb7] rounded-xl p-4 shadow-sm">
                <label class="block font-semibold text-[#6b563f] text-lg mb-2">Description <span class="text-red-500">*</span></label>
                <textarea class="w-full" rows="20" id="editor" name="description" required>{{ old('description') }}</textarea>
            </div>

            {{-- Image --}}
            <div>
                <label class="block font-semibold mb-1 text-gray-700">Main Image</label>
                <input type="file" name="image" accept="image/*" class="w-full border border-gray-300 rounded p-2 focus:ring-2 focus:ring-[#c3a68a] focus:outline-none">
            </div>

            {{-- Buttons --}}
            <div class="flex justify-end space-x-2">
                <a href="{{ route('admin.services.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">Cancel</a>
                <button type="submit" class="bg-[#8b6f47] text-white px-4 py-2 rounded hover:bg-[#6d5839] transition">Save</button>
            </div>

        </div>
    </form>
</div>
@endsection


{{-- ✅ TinyMCE Luxury Editor --}}
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#editor',
        height: 500,
        menubar: false,

        plugins: 'lists link image table code media autoresize paste',
        toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image media table | removeformat | code',

        // Luxury Fonts
        content_style: `
        body { font-family: 'Inter', sans-serif; font-size: 17px; color: #4a3b2e; line-height: 1.75; }
        img { max-width: 100%; border-radius: 10px; }
    `,

        // Drag & Drop + Upload
        automatic_uploads: true,
        images_upload_url: "{{ route('admin.services.upload-image') }}",
        images_upload_credentials: true,
        paste_data_images: true,

        file_picker_types: 'image',
        file_picker_callback: function(callback) {
            let input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.onchange = function() {
                let file = this.files[0];
                let formData = new FormData();
                formData.append('file', file);

                fetch("{{ route('admin.services.upload-image') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                }).then(r => r.json()).then(result => {
                    callback(result.location);
                });
            };
            input.click();
        },

        // ✅ Image resizing inside editor
        image_advtab: true,
        object_resizing: true
    });
</script>

<style>
    .tox-tinymce {
        border-radius: 14px !important;
        border: 1px solid #d6c6b4 !important;
        box-shadow: 0 6px 18px rgba(60, 40, 30, 0.07) !important;
    }

    .tox .tox-toolbar,
    .tox .tox-statusbar {
        background-color: #f8f5ef !important;
        border-color: #d6c6b4 !important;
    }
</style>