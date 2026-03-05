@extends('layouts.admin')

@section('title', 'Edit Shape')

@section('content')

<h1 class="text-3xl font-premium font-bold mb-6 text-zinc-900">Edit Shape</h1>

<div class="bg-white p-8 rounded-xl shadow-lg border border-zinc-100 animate-enter max-w-2xl">

    <form action="{{ route('admin.shapes.update', $shape->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label class="font-bold text-zinc-700 mb-2 block font-heading">Name</label>
            <input type="text" name="name" value="{{ $shape->name }}"
                class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5"
                required>
        </div>

        <div class="mb-6">
            <label class="font-bold text-zinc-700 mb-2 block font-heading">Image</label>

            @if($shape->image)
            <div class="mb-4">
                <img src="{{ asset('storage/' . $shape->image) }}" alt="Current Image"
                    class="h-24 w-24 object-contain rounded-lg border border-zinc-200 bg-zinc-50 p-2">
            </div>
            @endif

            <div class="flex items-center justify-center w-full">
                <label for="dropzone-file"
                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-zinc-300 border-dashed rounded-lg cursor-pointer bg-zinc-50 hover:bg-zinc-100 transition-colors">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-zinc-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                        </svg>
                        <p class="mb-2 text-sm text-zinc-500"><span class="font-semibold">Click to upload</span> or drag
                            and drop</p>
                        <p class="text-xs text-zinc-500">SVG, PNG, JPG or WEBP (Optional)</p>
                    </div>
                    <input id="dropzone-file" name="image" type="file" class="hidden" />
                </label>
            </div>
        </div>

        <div class="mb-6">
            <label class="relative inline-flex items-center cursor-pointer group">
                <input type="checkbox" name="status" value="1" class="sr-only peer" {{ $shape->status ? 'checked' : '' }}>
                <div class="relative w-11 h-6 bg-zinc-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-amber-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500 transition-colors"></div>
                <span class="ml-3 font-medium text-zinc-700 group-hover:text-zinc-900 transition-colors">Active Status</span>
            </label>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="px-8 py-3 btn-gold rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg">
                Update Shape
            </button>
            <a href="{{ route('admin.shapes.index') }}"
                class="px-6 py-3 bg-zinc-100 text-zinc-600 rounded-lg font-bold hover:bg-zinc-200 transition-colors">Cancel</a>
        </div>

    </form>

</div>

@endsection