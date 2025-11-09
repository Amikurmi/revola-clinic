@extends('layouts.admin')

@section('title', 'Edit Service')

@section('content')
<div class="max-w-4xl mx-auto mt-12 bg-white p-10 rounded-3xl shadow-xl border border-gray-100">
    <h2 class="text-3xl font-bold mb-8 text-[#4a3f35] tracking-wide">✦ Edit Service</h2>

    {{-- Validation Errors --}}
    @if ($errors->any())
    <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.services.update', $service->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-6">

            {{-- Title --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-1">Title *</label>
                <input type="text" name="title" value="{{ old('title', $service->title) }}"
                    class="w-full border rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-[#8b6f47]" required>
            </div>

            {{-- Label --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-1">Label</label>
                <input type="text" name="label" value="{{ old('label', $service->label) }}"
                    class="w-full border rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-[#8b6f47]">
            </div>

            {{-- Button Text --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-1">Button Text</label>
                <input type="text" name="button" value="{{ old('button', $service->button) }}"
                    class="w-full border rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-[#8b6f47]">
            </div>

            {{-- Description Editor --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-1">Description *</label>

                <div class="lux-editor-container border rounded-2xl shadow-sm bg-[#faf8f5] p-2">
                    <textarea class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring focus:ring-[#8b6f47]" rows="20" id="editor" name="description" required>{{ old('description', $service->description) }}</textarea>
                </div>
            </div>

            {{-- Image Upload --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-2">Service Image</label>

                @if($service->image)
                <img src="{{ asset($service->image) }}" class="h-32 w-32 object-cover rounded-xl border shadow mb-3">
                @endif

                <input type="file" name="image" id="imageInput"
                    class="w-full border rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-[#8b6f47]">

                <p class="text-sm text-gray-500 mt-1">Leave blank to keep current image.</p>
                <img id="previewImage" class="hidden h-32 w-32 object-cover rounded-xl border mt-3" />
            </div>

            {{-- Buttons --}}
            <div class="flex justify-between items-center pt-4 border-t">
                <a href="{{ route('admin.services.view', $service->id) }}" class="text-[#8b6f47] font-semibold hover:underline">Preview</a>

                <div class="space-x-2">
                    <a href="{{ route('admin.services.index') }}"
                        class="bg-gray-200 text-gray-800 px-5 py-2 rounded-xl hover:bg-gray-300 transition">Cancel</a>

                    <button type="submit"
                        class="bg-[#8b6f47] text-white px-6 py-2 rounded-xl hover:bg-[#735c3b] transition">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection


{{-- TinyMCE --}}
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js"></script>

<script>
    tinymce.init({
        selector: '#editor',
        height: 350,

        plugins: 'lists link image media table code autoresize paste template',
        toolbar: `
        undo redo | blocks | 
        bold italic underline | 
        alignleft aligncenter alignright | 
        bullist numlist | 
        link image media table | 
        templates | 
        code
    `,
        content_style: `
        body { font-family: 'Inter', sans-serif; font-size: 18px; color: #4a3b2e; padding: 14px; }
        img { max-width: 100%; border-radius: 14px; }
    `,
        automatic_uploads: true,
        images_upload_url: "{{ route('admin.editor.image.upload') }}",
        images_upload_credentials: true,
        paste_data_images: true,

        file_picker_types: 'image',
        file_picker_callback(callback) {
            let input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.onchange = function() {
                let file = this.files[0];
                let formData = new FormData();
                formData.append('file', file);

                fetch("{{ route('admin.editor.image.upload') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    })
                    .then(r => r.json())
                    .then(result => callback(result.location));
            };
            input.click();
        },

        templates: [{
                title: '✔ Benefits List',
                description: 'List of treatment benefits',
                content: `
                <h3 class="section-title">✨ Benefits</h3>
                <ul>
                    <li>Boosts natural glow</li>
                    <li>Improves skin elasticity</li>
                    <li>Reduces wrinkles & fine lines</li>
                    <li>Deep hydration & nourishment</li>
                </ul>`
            },
            {
                title: '⚜ Luxury Section Divider',
                description: 'Premium golden divider',
                content: `<div style="border-bottom: 2px solid #c8a97e; margin: 30px 0;"></div>`
            }
        ],
    });
</script>