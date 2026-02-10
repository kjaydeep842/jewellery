@extends('layouts.admin')

@section('title', 'Admin - Edit Feature')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-fade-in-up">

    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-black font-heading tracking-tight">
            Edit Feature: {{ $feature->title }}
        </h1>
        <a href="{{ route('admin.features.index') }}"
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
            <form action="{{ route('admin.features.update', $feature->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="title" class="block text-sm font-medium text-zinc-700 mb-2">
                            Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title', $feature->title) }}"
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow shadow-sm placeholder-zinc-400"
                            placeholder="e.g., Fast & Secure Shipping" required>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-zinc-700 mb-2">
                            Description <span class="text-red-500">*</span>
                        </label>
                        <textarea name="description" id="description" rows="3" required
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow shadow-sm placeholder-zinc-400"
                            placeholder="e.g., We provide fast and secure shipping for all orders.">{{ old('description', $feature->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 mb-2">
                            Current Icon
                        </label>
                        @if($feature->image)
                        <div class="relative w-32 h-32 rounded-xl overflow-hidden border border-zinc-200 shadow-md bg-zinc-50 p-4">
                            <img src="{{ Storage::url($feature->image) }}" class="w-full h-full object-contain">
                            <div class="absolute inset-x-0 bottom-0 bg-black/60 text-white text-xs text-center py-1 backdrop-blur-sm">
                                Current
                            </div>
                        </div>
                        @else
                        <div class="w-32 h-32 rounded-xl border-2 border-dashed border-zinc-300 flex items-center justify-center bg-zinc-50 text-zinc-400">
                            <span class="text-sm italic">No image</span>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="border-t border-zinc-100 pt-8">
                    <label class="block text-sm font-medium text-zinc-700 mb-2">
                        Update Icon (Optional)
                    </label>

                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-zinc-300 border-dashed rounded-xl hover:border-amber-400 transition-colors cursor-pointer bg-zinc-50"
                        id="drop-zone">
                        <!-- Existing Upload Layout Reused -->
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-zinc-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-zinc-600 justify-center">
                                <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-amber-600 hover:text-amber-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-amber-500">
                                    <span>Upload a file</span>
                                    <input id="file-upload" name="image" type="file" class="sr-only" accept="image/*" onchange="previewImage(this)">
                                </label>
                                <p class="pl-1">to replace current</p>
                            </div>
                            <p class="text-xs text-zinc-500">
                                Leave blank to keep current image
                            </p>
                        </div>
                    </div>

                    <!-- Preview for New Image -->
                    <div id="image-preview" class="mt-4 hidden w-32 animate-fade-in">
                        <p class="text-xs font-semibold text-zinc-500 uppercase tracking-wide mb-1">New Selection:</p>
                        <div class="relative w-32 h-32 rounded-lg overflow-hidden border border-amber-300 shadow-md ring-2 ring-amber-100">
                            <img id="preview-img" src="#" alt="Preview" class="w-full h-full object-contain bg-white p-2">
                            <button type="button" onclick="removeImage()" class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 shadow-sm transition-colors" title="Remove selection">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex items-center pt-4">
                    <label class="relative inline-flex items-center cursor-pointer group">
                        <input type="checkbox" name="status" value="1" class="sr-only peer" {{ $feature->status ? 'checked' : '' }}>
                        <div class="relative w-11 h-6 bg-zinc-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-amber-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500 transition-colors"></div>
                        <span class="ml-3 font-medium text-zinc-700 group-hover:text-zinc-900 transition-colors">Active Status</span>
                    </label>
                </div>

                <div class="pt-6 border-t border-zinc-100 flex justify-end">
                    <button type="submit"
                        class="px-8 py-3 btn-gold rounded-full font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                        Update Feature
                    </button>
                    <a href="{{ route('admin.features.index') }}"
                        class="px-8 py-3 ml-4 bg-zinc-200 text-zinc-700 rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg hover:bg-zinc-300">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>

@push('scripts')
<script>
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
        const dropZone = document.getElementById('drop-zone');

        input.value = '';
        previewContainer.classList.add('hidden');
        dropZone.classList.remove('border-amber-400', 'bg-amber-50/50');
    }
</script>
@endpush

@endsection