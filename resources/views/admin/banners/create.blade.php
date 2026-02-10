@extends('layouts.admin')

@section('title', 'Add Banner')

@section('content')

<h1 class="text-3xl font-premium font-bold mb-6 text-zinc-900">Add Banner</h1>

@if ($errors->any())
<div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
    <ul class="list-disc pl-5">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="bg-white p-8 rounded-xl shadow-lg border border-zinc-100">
    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="mb-4">
            <label class="font-bold text-zinc-700 mb-2 block font-heading">Title *</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}"
                class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5 @error('title') border-red-500 @enderror"
                required>
            @error('title')
            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="font-bold text-zinc-700 mb-2 block font-heading">Description</label>
            <textarea name="desc"
                class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5"
                rows="3">{{ old('desc') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="font-bold text-zinc-700 mb-2 block font-heading">Banner Section</label>
            <select name="type"
                class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">
                <option value="top" {{ old('type') == 'top' ? 'selected' : '' }}>Top Banner (Slider)</option>
                <option value="middle" {{ old('type') == 'middle' ? 'selected' : '' }}>Middle Section Banner</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="font-bold text-zinc-700 mb-2 block font-heading">Image</label>
            <input type="file" name="image" id="imageInput" accept="image/png, image/jpeg, image/webp"
                class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5 @error('image') border-red-500 @enderror">
            @error('image')
            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" name="status" value="1" class="sr-only peer">
                <div
                    class="w-11 h-6 bg-zinc-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-amber-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500">
                </div>
                <span class="ml-3 font-medium text-zinc-700">Active Status</span>
            </label>
        </div>

        <button type="submit"
            class="px-8 py-3 btn-gold rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg">
            Save Banner
        </button>
        <a href="{{ route('admin.banners.index') }}"
            class="px-8 py-3 ml-4 bg-zinc-200 text-zinc-700 rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg hover:bg-zinc-300">
            Cancel
        </a>

    </form>
</div>

@endsection