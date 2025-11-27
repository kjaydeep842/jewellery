@extends('layouts.admin')

@section('title', 'Edit Banner')

@section('content')

<h1 class="text-2xl font-bold mb-5">Edit Banner</h1>

@if ($errors->any())
<div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
    <ul class="list-disc pl-5">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="bg-white shadow-md p-6 rounded-lg">

    <form action="{{ route('admin.banners.update', $banner->id) }}" 
          method="POST" 
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium mb-1">Title *</label>
            <input type="text" name="title"
                   class="w-full border-gray-300 rounded-lg p-2"
                   value="{{ $banner->title }}"
                   required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Description</label>
            <textarea name="desc"
                      class="w-full border-gray-300 rounded-lg p-2"
                      rows="3">{{ $banner->desc }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Current Image</label>
            @if($banner->image)
                <img src="{{ $banner->imageUrl() }}" class="h-20 w-40 object-cover rounded mb-3">
            @endif

            <input type="file" name="image"
                   class="w-full border-gray-300 rounded-lg p-2 mt-2">
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="status" value="1"
                       class="mr-2"
                       {{ $banner->status ? 'checked' : '' }}>
                <span class="font-medium">Active</span>
            </label>
        </div>

        <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
            Update Banner
        </button>

    </form>
</div>

@endsection
