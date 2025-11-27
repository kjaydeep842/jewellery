@extends('layouts.admin')

@section('title', 'Edit Subcategory')

@section('content')

<h1 class="text-2xl font-bold mb-4">Edit Subcategory</h1>

<div class="bg-white p-6 rounded shadow-md">

    <form action="{{ route('admin.subcategories.update', $subcategory->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-4">
            <label class="font-medium">Category</label>
            <select name="category_id" class="w-full border p-2 rounded">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ $subcategory->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="font-medium">Subcategory Name</label>
            <input type="text" name="name" class="w-full border p-2 rounded"
                   value="{{ $subcategory->name }}">
            @error('name')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>

        <button class="px-4 py-2 bg-indigo-600 text-white rounded">Update</button>
    </form>

</div>

@endsection
