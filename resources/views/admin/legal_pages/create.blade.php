@extends('layouts.admin')

@section('title', 'Admin - Add Legal Page')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-fade-in-up">

    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-black font-heading tracking-tight">
            Add New Legal Page
        </h1>
        <a href="{{ route('admin.legal-pages.index') }}"
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
            <form action="{{ route('admin.legal-pages.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-zinc-700 mb-2">
                            Page Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow shadow-sm placeholder-zinc-400"
                            placeholder="e.g., Terms & Conditions">
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-zinc-700 mb-2">
                            Page Type <span class="text-red-500">*</span>
                        </label>
                        <select name="type" id="type" required
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow shadow-sm bg-white">
                            <option value="" disabled {{ old('type') ? '' : 'selected' }}>Select Type</option>
                            <option value="terms" {{ old('type') == 'terms' ? 'selected' : '' }}>Terms & Conditions</option>
                            <option value="privacy" {{ old('type') == 'privacy' ? 'selected' : '' }}>Privacy Policy</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="content_editor" class="block text-sm font-medium text-zinc-700 mb-2">
                        Content <span class="text-red-500">*</span>
                    </label>
                    <textarea name="content" id="content_editor" rows="15"
                        class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow shadow-sm placeholder-zinc-400"
                        placeholder="Enter the legal content here...">{{ old('content') }}</textarea>
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
                        Create Legal Page
                    </button>
                    <a href="{{ route('admin.legal-pages.index') }}"
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
        .create(document.querySelector('#content_editor'), {
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
            placeholder: 'Enter the legal content here...',
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
</script>
@endpush

@endsection