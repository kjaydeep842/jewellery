@extends('layouts.admin')

@section('title', 'Edit Tag')

@section('content')

<h1 class="text-2xl font-bold mb-4">Edit Tag</h1>

<div class="bg-white p-6 rounded shadow-md">

    <form action="{{ route('admin.tags.update', $tag->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="font-medium">Tag Name</label>
            <input type="text"
                   name="name"
                   value="{{ old('name', $tag->name) }}"
                   class="w-full border p-2 rounded"
                   required>
        </div>

        <div class="mb-4">
            <label class="font-medium">Status</label>
            <select name="status" class="w-full border p-2 rounded">
                <option value="active" {{ $tag->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $tag->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button class="px-4 py-2 bg-indigo-600 text-white rounded">Update</button>
    </form>

</div>

@endsection
