@extends('layouts.admin')

@section('title', 'Add New Treatment')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-6">
    <div class="bg-white rounded-2xl shadow-lg p-8 border border-[#e6dbc9]">
        <h1 class="text-3xl font-bold text-[#3c2c20] mb-8">Add New Treatment</h1>

        <!-- Form -->
        <form action="{{ route('admin.treatments.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-[#3c2c20] mb-2">Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="w-full border border-[#d6c7b4] focus:border-[#b18457] focus:ring-2 focus:ring-[#e6dbc9] rounded-lg px-4 py-2 text-[#3c2c20]"
                    placeholder="Enter treatment title" required>
            </div>

            <!-- Button Label -->
            <div>
                <label for="button" class="block text-sm font-medium text-[#3c2c20] mb-2">Button Label</label>
                <input type="text" name="button" id="button" value="{{ old('button', 'Learn More') }}"
                    class="w-full border border-[#d6c7b4] focus:border-[#b18457] focus:ring-2 focus:ring-[#e6dbc9] rounded-lg px-4 py-2 text-[#3c2c20]"
                    placeholder="e.g., Learn More">
            </div>

            <!-- Image Upload -->
            <div>
                <label for="image" class="block text-sm font-medium text-[#3c2c20] mb-2">Treatment Image</label>
                <input type="file" name="image" id="image"
                    class="w-full border border-[#d6c7b4] rounded-lg px-4 py-2 text-[#3c2c20] bg-white focus:border-[#b18457] focus:ring-2 focus:ring-[#e6dbc9]">
            </div>

            <!-- Luxury TinyMCE Editor -->
            <div class="lux-editor-wrapper bg-[#f8f5ef] border border-[#ddcdb7] rounded-xl p-4 shadow-sm">
                <label class="block font-semibold text-[#6b563f] text-lg mb-2">Description <span class="text-red-500">*</span></label>
                <textarea name="description" id="editor" rows="15" class="w-full">{{ old('description') }}</textarea>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('admin.treatments.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2.5 rounded-lg transition-all">Cancel</a>
                <button type="submit" class="bg-[#b18457] hover:bg-[#a1744a] text-white font-semibold px-6 py-2.5 rounded-lg shadow-md transition-all">Save Treatment</button>
            </div>

        </form>
    </div>
</div>
@endsection

@section('scripts')
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

        file_picker_types: 'image',
        file_picker_callback: function(callback) {
            let input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.onchange = function() {
                let formData = new FormData();
                formData.append('file', this.files[0]);

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

<style>
    .tox-tinymce {
        border-radius: 14px !important;
        border: 1px solid #d6c6b4 !important;
        box-shadow: 0 6px 18px rgba(60, 40, 30, 0.07) !important;
    }
</style>
@endsection