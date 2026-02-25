@extends('layouts.admin')

@section('title', 'Bulk Import Products')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.products.index') }}" class="p-2 bg-white rounded-lg border border-zinc-200 hover:bg-zinc-50 transition-colors shadow-sm text-zinc-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <h1 class="text-2xl sm:text-3xl font-premium font-bold text-zinc-900 tracking-wide">Bulk Import Products</h1>
    </div>

    <a href="{{ route('admin.products.import.template') }}" class="flex items-center space-x-2 px-6 py-2.5 bg-zinc-800 text-white hover:bg-zinc-900 rounded-lg shadow-md transition-all font-bold text-sm tracking-wide">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
        </svg>
        <span>Download Template</span>
    </a>
</div>

@if($errors->any())
<div class="mb-6 p-4 bg-red-50 text-red-700 rounded-xl border border-red-200">
    <div class="flex items-start">
        <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <ul class="list-disc pl-4 space-y-1">
            @foreach($errors->all() as $error)
            <li class="font-medium text-sm">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-8">
        {{-- Upload Form --}}
        <div class="bg-white rounded-2xl shadow-xl shadow-zinc-200/40 border border-zinc-100 overflow-hidden">
            <div class="p-8 border-b border-zinc-100 bg-zinc-50/50">
                <h2 class="text-xl font-bold text-zinc-900 mb-2 font-heading font-premium">Upload File</h2>
                <p class="text-zinc-500 text-sm">Upload your Excel file containing product data. Please ensure it matches the template structure.</p>
            </div>

            <form action="{{ route('admin.products.import.process') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                <div class="mb-8">
                    <label class="block mb-4 font-semibold text-zinc-700">Select File <span class="text-amber-500">*</span></label>
                    <div class="mt-1 flex justify-center px-6 pt-10 pb-12 border-2 border-dashed border-zinc-300 rounded-xl hover:bg-zinc-50 hover:border-amber-400 transition-colors group cursor-pointer" onclick="document.getElementById('file').click()">
                        <div class="space-y-4 text-center">
                            <div class="w-16 h-16 bg-amber-50 rounded-full flex items-center justify-center mx-auto text-amber-500 group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="flex text-sm text-zinc-600 justify-center">
                                <label for="file" class="relative cursor-pointer bg-white rounded-md font-bold text-amber-600 hover:text-amber-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-amber-500">
                                    <span>Upload a file</span>
                                    <input id="file" name="file" type="file" class="sr-only" accept=".xlsx, .xls, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-zinc-500">XLS, XLSX up to 10MB</p>
                            <p id="file-name" class="text-sm font-semibold text-zinc-800 hidden mt-4 px-4 py-2 bg-zinc-100 rounded-lg"></p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-6 border-t border-zinc-100 gap-4">
                    <button type="submit" class="px-8 py-3 btn-gold hover:shadow-xl transition-all font-bold tracking-wide transform hover:-translate-y-0.5 rounded-lg shadow-md inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                        </svg>
                        Start Import
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Instructions Side Panel --}}
    <div class="space-y-6">
        <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl border border-amber-100/50 p-6 shadow-lg shadow-amber-100/20">
            <h3 class="text-lg font-bold text-amber-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Import Instructions
            </h3>

            <div class="space-y-4 text-sm text-amber-800">
                <p>1. <strong>Download the template</strong> to see the exact structure required.</p>
                <p>2. Keep the headers exactly as provided in the template file.</p>
                <p>3. Field <strong>SKU</strong> is required and unique. If an SKU exists, the record will be <strong>updated</strong>. Otherwise, a new product is created.</p>
                <p>4. Setting <strong>image_url</strong> with a valid public HTTP URL will automatically download, compress (80% JPEG), and save the image into the local system! Existing images will be replaced.</p>
                <p>5. If providing brand or category names, ensure they match exactly, otherwise new ones will be auto-generated.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-zinc-100 p-6 shadow-sm">
            <h3 class="font-bold text-zinc-900 mb-4 font-heading border-b border-zinc-100 pb-3">Required Fields</h3>
            <ul class="space-y-3 text-sm">
                <li class="flex items-start">
                    <svg class="w-4 h-4 text-red-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-zinc-600"><strong class="text-zinc-800">name</strong> (Product Title)</span>
                </li>
                <li class="flex items-start">
                    <svg class="w-4 h-4 text-red-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-zinc-600"><strong class="text-zinc-800">sku</strong> (Unique Identifier)</span>
                </li>
                <li class="flex items-start">
                    <svg class="w-4 h-4 text-red-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-zinc-600"><strong class="text-zinc-800">category_name</strong> (Category Title)</span>
                </li>
                <li class="flex items-start">
                    <svg class="w-4 h-4 text-red-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-zinc-600"><strong class="text-zinc-800">price</strong> (Base Price numeric)</span>
                </li>
            </ul>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('file').addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            document.getElementById('file-name').textContent = 'Selected: ' + e.target.files[0].name;
            document.getElementById('file-name').classList.replace('hidden', 'inline-block');
        }
    });

    // Handle drag and drop visuals
    const dropZone = document.querySelector('.mt-1.flex.justify-center');

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
        dropZone.classList.add('bg-zinc-50', 'border-amber-400');
    }

    function unhighlight(e) {
        dropZone.classList.remove('bg-zinc-50', 'border-amber-400');
    }

    dropZone.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        let dt = e.dataTransfer;
        let files = dt.files;
        document.getElementById('file').files = files;

        if (files.length > 0) {
            document.getElementById('file-name').textContent = 'Selected: ' + files[0].name;
            document.getElementById('file-name').classList.replace('hidden', 'inline-block');
        }
    }
</script>
@endpush
@endsection