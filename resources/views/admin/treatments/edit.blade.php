@extends('layouts.admin')

@section('title', 'Edit Treatment')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-6">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-[#3c2c20]">Edit Treatment</h1>
        <a href="{{ route('admin.treatments.index') }}"
            class="bg-[#e6dbc9] text-[#3c2c20] hover:bg-[#d7c8b2] font-semibold px-5 py-2 rounded-lg transition-all">
            ← Back
        </a>
    </div>

    <div class="bg-white shadow-lg rounded-2xl border border-[#e6dbc9] p-8">
        <form action="{{ route('admin.treatments.update', $treatment->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-6">
                <label class="block text-[#3c2c20] font-semibold mb-2">Treatment Title</label>
                <input type="text" name="title" value="{{ old('title', $treatment->title) }}"
                    class="w-full border border-[#e6dbc9] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#b18457] focus:outline-none text-[#3c2c20]">
            </div>

            <!-- Button Label -->
            <div class="mb-6">
                <label class="block text-[#3c2c20] font-semibold mb-2">Button Label</label>
                <input type="text" name="button" value="{{ old('button', $treatment->button) }}"
                    class="w-full border border-[#e6dbc9] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#b18457] focus:outline-none text-[#3c2c20]">
            </div>

            <!-- Image Upload -->
            <div class="mb-6">
                <label class="block text-[#3c2c20] font-semibold mb-2">Treatment Image</label>

                @if ($treatment->image)
                <div class="mb-4">
                    <img src="{{ asset($treatment->image) }}" class="w-40 h-40 object-cover rounded-md border border-[#e6dbc9]">
                </div>
                @endif

                <input type="file" name="image" accept="image/*"
                    class="w-full border border-[#e6dbc9] rounded-lg px-4 py-2 bg-white text-[#3c2c20]">
            </div>

            <!-- Luxury Description Editor -->
            <div class="lux-editor-wrapper bg-[#f8f5ef] border border-[#ddcdb7] rounded-xl p-4 shadow-sm mb-8">
                <label class="block font-semibold text-[#6b563f] text-lg mb-2">Description</label>
                <textarea id="editor" class="w-full" name="description" rows="20">{{ old('description', $treatment->description) }}</textarea>
            </div>

            <!-- Save Button -->
            <div class="text-right">
                <button type="submit" class="bg-[#b18457] hover:bg-[#a1744a] text-white font-semibold px-8 py-3 rounded-lg shadow-md transition-all">
                    Update Treatment
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

{{-- ✅ Luxury TinyMCE --}}
@push('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#editor',
        height: 500,
        menubar: false,
        plugins: 'lists link image table code media autoresize paste',
        toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image media table | removeformat | code',

        content_style: `
        body { font-family: 'Inter', sans-serif; font-size: 17px; color: #4a3b2e; line-height: 1.75; }
        img { max-width: 100%; border-radius: 10px; }
    `,

        automatic_uploads: true,
        images_upload_url: "{{ route('admin.treatments.upload-image') }}",
        images_upload_credentials: true,
        paste_data_images: true,

        file_picker_callback: function(callback) {
            let input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.onchange = function() {
                let file = this.files[0];
                let formData = new FormData();
                formData.append('file', file);

                fetch("{{ route('admin.treatments.upload-image') }}", {
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
    });
</script>
@endpush