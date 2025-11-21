@extends('layouts.admin')

@section('title', 'Add Product')

@section('content')

<h1 class="text-2xl font-bold mb-4">Add Product</h1>

<div class="bg-white p-6 rounded shadow-md">

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="font-medium">Name</label>
                <input type="text" name="name" class="w-full border p-2 rounded" required>
            </div>

           <div>
                <label class="font-medium">Category</label>
                <select name="category_id" class="w-full border p-2 rounded" required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="mb-4">
            <label class="font-medium">Description</label>
            <textarea name="description" class="w-full border p-2 rounded"
                      rows="4" required></textarea>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="font-medium">Price</label>
                <input type="number" step="0.01" name="price" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="font-medium">Image</label>
                <input type="file" name="image" class="w-full border p-2 rounded">
            </div>
        </div>

        <button class="px-4 py-2 bg-indigo-600 text-white rounded">Save</button>
    </form>

</div>

@endsection
