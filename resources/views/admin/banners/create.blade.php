@extends('layouts.admin')

@section('title', 'Add Banner')

@section('content')

<h1 class="text-2xl font-bold mb-5">Add Banner</h1>

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
    <form action="{{ route('admin.banners.store') }}" 
          method="POST" 
          enctype="multipart/form-data">

        @csrf

        <div class="mb-4">
            <label class="block font-medium mb-1">Title *</label>
            <input type="text" name="title"
                   class="w-full border-gray-300 rounded-lg p-2"
                   required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Description</label>
            <textarea name="desc"
                      class="w-full border-gray-300 rounded-lg p-2"
                      rows="3"></textarea>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Image</label>
            <input type="file" name="image"
                   class="w-full border-gray-300 rounded-lg p-2">
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="status" value="1" class="mr-2">
                <span class="font-medium">Active</span>
            </label>
        </div>

        <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
            Save Banner
        </button>

    </form>
</div>

@endsection
