@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')

<h1 class="text-2xl font-bold mb-4">Edit Product</h1>

<div class="bg-white p-6 rounded shadow-md">

    <form action="{{ route('admin.products.update', $product->id) }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="font-medium">Name</label>
                <input type="text" name="name" class="w-full border p-2 rounded"
                       value="{{ $product->name }}" required>
            </div>

            <div>
                <label class="font-medium">Category</label>
                <select name="category_id" class="w-full border p-2 rounded" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="mb-4">
            <label class="font-medium">Description</label>
            <textarea name="description" class="w-full border p-2 rounded"
                      rows="4" required>{{ $product->description }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">

            <div>
                <label class="font-medium">Price</label>
                <input type="number" step="0.01" name="price"
                       class="w-full border p-2 rounded"
                       value="{{ $product->price }}" required>
            </div>

            <div>
                <label class="font-medium">Image</label>
                <input type="file" name="image" class="w-full border p-2 rounded">

                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         class="w-20 h-20 mt-2 rounded">
                @endif
            </div>

        </div>

        <button class="px-4 py-2 bg-indigo-600 text-white rounded">Update</button>
    </form>

</div>

@endsection
