@extends('layouts.admin')

@section('title', 'Add Product')

@section('content')

<h1 class="text-2xl font-bold mb-4">Add Product</h1>

<div class="bg-white p-6 rounded shadow-md">

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Name + Category --}}
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="font-medium">Product Name</label>
                <input type="text" name="name" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="font-medium">Category</label>
                <select name="category_id" id="category" class="w-full border p-2 rounded" required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
            {{-- Subcategory + Tags --}}
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="font-medium">Subcategory</label>
                    <select name="subcategory_id" id="subcategory" class="w-full border p-2 rounded">
                        <option value="">-- Select Subcategory --</option>
                        @foreach($subcategories as $sub)
                            <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="font-medium">Tags</label>
                    <select name="tags[]" id="tags" multiple class="w-full border p-2 rounded">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>




       

        {{-- Price fields --}}
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="font-medium">Price</label>
                <input type="number" step="0.01" name="price" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="font-medium">Discount Price</label>
                <input type="number" step="0.01" name="discount_price" class="w-full border p-2 rounded">
            </div>
        </div>

        {{-- SKU + Stock --}}
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="font-medium">SKU</label>
                <input type="text" name="sku" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="font-medium">Stock</label>
                <input type="number" name="stock" class="w-full border p-2 rounded">
            </div>
        </div>

        {{-- Material + Weight --}}
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="font-medium">Material</label>
                <input type="text" name="material" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="font-medium">Weight (in grams)</label>
                <input type="number" step="0.01" name="weight" class="w-full border p-2 rounded">
            </div>
        </div>

        {{-- Status --}}
        <div class="mb-4">
            <label class="font-medium">Status</label>
            <select name="status" class="w-full border p-2 rounded">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

       
        {{-- Description --}}
        <div class="mb-4">
            <label class="font-medium">Description</label>
            <textarea name="description" class="w-full border p-2 rounded" rows="4"></textarea>
        </div>

        {{-- Image uploads --}}
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="font-medium">Main Image</label>
                <input type="file" name="image" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="font-medium">Gallery Images</label>
                <input type="file" multiple name="images[]" class="w-full border p-2 rounded">
            </div>
        </div>

        <button class="px-4 py-2 bg-indigo-600 text-white rounded">Save Product</button>
    </form>

</div>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('#tags').select2({
        placeholder: "Select Tags",
        allowClear: true,
        width: '100%'
    });
});
</script>


@endsection
