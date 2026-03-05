@extends('layouts.admin')

@section('title', 'Admin - Add Blog')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-fade-in-up">

    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-black font-heading tracking-tight">
            Add New Blog
        </h1>
        <a href="{{ route('admin.blogs.index') }}"
            class="px-5 py-2.5 bg-white border border-zinc-200 text-zinc-600 rounded-lg hover:bg-zinc-50 hover:border-zinc-300 transition-all font-medium flex items-center shadow-sm hover:shadow group">
            <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to List
        </a>
    </div>

    @if ($errors->any())
    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg shadow-sm animate-shake">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                <ul class="mt-2 text-sm text-red-700 list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-xl border border-zinc-100 overflow-hidden">
        <div class="p-8">
            <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-medium text-zinc-700 mb-2">
                        Blog Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow shadow-sm placeholder-zinc-400"
                        placeholder="e.g., This is why this year will be the year of startups">
                    <p class="mt-1 text-xs text-zinc-500">The title will be used to generate the slug.</p>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-zinc-700 mb-2">
                        Content / Description <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description" id="description" rows="10"
                        class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow shadow-sm placeholder-zinc-400"
                        placeholder="Enter the main blog content here...">{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="published_at" class="block text-sm font-medium text-zinc-700 mb-2">
                            Publish Date (Optional)
                        </label>
                        <input type="date" name="published_at" id="published_at" value="{{ old('published_at', date('Y-m-d')) }}"
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow shadow-sm bg-white">
                        <p class="mt-1 text-xs text-zinc-500">Leave it as today's date or select a date.</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-2">
                        Featured Image (Optional)
                    </label>

                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-amber-500 border-dashed rounded-xl hover:bg-amber-50/50 transition-colors cursor-pointer bg-zinc-50"
                        id="drop-zone">
                        <div class="space-y-1 text-center">
                            <!-- Icon from reference image -->
                            <svg class="mx-auto h-12 w-12 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z M18 4v4M16 6h4" />
                            </svg>
                            <div class="flex text-sm text-zinc-600 justify-center">
                                <label for="file-upload" class="relative cursor-pointer rounded-md font-medium text-zinc-600 hover:text-amber-600 focus-within:outline-none">
                                    <span class="font-bold">Upload new image</span>
                                    <input id="file-upload" name="image" type="file" class="sr-only" accept="image/*" onchange="previewImage(this)">
                                </label>
                                <p class="pl-1 text-zinc-500">or drag and drop</p>
                            </div>
                            <p class="text-xs text-zinc-400">
                                SVG, PNG, JPG, WEBP up to 5MB
                            </p>
                        </div>
                    </div>

                    <!-- Image Preview Container -->
                    <div id="image-preview" class="mt-4 hidden animate-fade-in">
                        <p class="text-sm font-medium text-zinc-700 mb-2">Selected Image:</p>
                        <div class="relative w-48 h-32 rounded-lg overflow-hidden border border-zinc-200 shadow-md group">
                            <img id="preview-img" src="#" alt="Preview" class="w-full h-full object-cover bg-white">
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <button type="button" onclick="removeImage()" class="text-white hover:text-red-400 font-medium text-sm">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center">
                    <label class="relative inline-flex items-center cursor-pointer group">
                        <input type="checkbox" name="status" value="1" class="sr-only peer" checked>
                        <div class="relative w-11 h-6 bg-zinc-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-amber-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500 transition-colors"></div>
                        <span class="ml-3 font-medium text-zinc-700 group-hover:text-zinc-900 transition-colors">Active Status</span>
                    </label>
                </div>

                <div class="pt-6 border-t border-zinc-100 flex justify-end">
                    <button type="submit"
                        class="px-8 py-3 btn-gold rounded-full font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                        Create Blog
                    </button>
                    <a href="{{ route('admin.blogs.index') }}"
                        class="px-8 py-3 ml-4 bg-zinc-200 text-zinc-700 rounded-full font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg hover:bg-zinc-300">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/super-build/ckeditor.js"></script>
<script>
    CKEDITOR.ClassicEditor
        .create(document.querySelector('#description'), {
            toolbar: {
                items: [
                    'undo', 'redo', '|',
                    'heading', '|',
                    'fontFamily', 'fontSize', 'fontColor', 'fontBackgroundColor', '|',
                    'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript', 'code', '|',
                    'link', 'imageInsert', 'insertTable', 'mediaEmbed', '|',
                    'bulletedList', 'numberedList', 'outdent', 'indent', '|',
                    'blockQuote', 'horizontalLine', 'specialCharacters', '|',
                    'sourceEditing', '|',
                    'alignment'
                ],
                shouldNotGroupWhenFull: true
            },
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif',
                    'Outfit, sans-serif',
                    'Playfair Display, serif'
                ],
                supportAllValues: true
            },
            fontSize: {
                options: [
                    9, 11, 13, 'default', 17, 19, 21, 24, 28, 32, 36
                ],
                supportAllValues: true
            },
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    }
                ]
            },
            htmlSupport: {
                allow: [{
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }]
            },
            placeholder: 'Enter the main blog content here...',
            removePlugins: [
                'AIAssistant', 'CKBox', 'CKFinder', 'EasyImage', 'RealTimeCollaborativeEditing',
                'RealTimeCollaborativeComments', 'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory', 'PresenceList', 'Comments',
                'TrackChanges', 'RevisionHistory', 'Pagination', 'WProofreader', 'MathType',
                'SlashCommand', 'Template', 'DocumentOutline', 'FormatPainter',
                'TableOfContents', 'PasteFromOfficeEnhanced', 'ExportPdf', 'ExportWord',
                'CloudServices', 'Users', 'TrackChangesEditing', 'TrackChangesUI',
                'TrackChangesData', 'CommentsEditing', 'CommentsUI', 'CommentsData',
                'RealTimeCollaborativeTrackChangesEditing', 'RealTimeCollaborativeTrackChangesUI',
                'RealTimeCollaborativeCommentsEditing', 'RealTimeCollaborativeCommentsUI',
                'RevisionHistoryEditing', 'RevisionHistoryUI', 'RevisionHistoryData',
                'CaseChange', 'MultiLevelList', 'ImportWord'
            ]
        })
        .catch(error => {
            console.error(error);
        });

    function previewImage(input) {
        const previewContainer = document.getElementById('image-preview');
        const previewImg = document.getElementById('preview-img');
        const dropZone = document.getElementById('drop-zone');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewContainer.classList.remove('hidden');
                dropZone.classList.add('border-amber-400', 'bg-amber-50/50');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeImage() {
        const input = document.getElementById('file-upload');
        const previewContainer = document.getElementById('image-preview');
        const previewImg = document.getElementById('preview-img');
        const dropZone = document.getElementById('drop-zone');

        input.value = '';
        previewImg.src = '#';
        previewContainer.classList.add('hidden');
        dropZone.classList.remove('border-amber-400', 'bg-amber-50/50');
    }

    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('file-upload');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        dropZone.classList.add('border-amber-400', 'bg-amber-50');
    }

    function unhighlight(e) {
        dropZone.classList.remove('border-amber-400', 'bg-amber-50');
    }

    dropZone.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;

        fileInput.files = files;
        previewImage(fileInput);
    }
</script>
@endpush

@endsection