@extends('layouts.admin')

@section('title', 'Add Category')

@section('content')

<h1 class="text-2xl font-bold mb-4">Add Category</h1>

<div class="bg-white p-6 rounded-xl shadow-md">

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="font-medium">Name</label>
            <input type="text" name="name" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="font-medium">Description</label>
            <textarea name="description" class="w-full border p-2 rounded"
                      rows="4"></textarea>
        </div>

        <button class="px-4 py-2 bg-indigo-600 text-white rounded">Save</button>
    </form>

</div>

@endsection
