@extends('layouts.admin')

@section('title', 'Add Product')

@section('content')

    <h1 class="text-3xl font-premium font-bold mb-6 text-zinc-900">Add Product</h1>

    <div class="bg-white p-8 rounded-xl shadow-lg border border-zinc-100 animate-enter">

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Name + Category --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">Product Name</label>
                    <input type="text" name="name"
                        class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5"
                        required>
                </div>

                <div>
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">Category</label>
                    <select name="category_id" id="category"
                        class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5"
                        required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- Subcategory + Tags --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">Subcategory</label>
                    <select name="subcategory_id" id="subcategory"
                        class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">
                        <option value="">-- Select Subcategory --</option>
                        @foreach($subcategories as $sub)
                            <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">Tags</label>
                    <select name="tags[]" id="tags" multiple
                        class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>






            {{-- Price fields --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">Price</label>
                    <input type="number" step="0.01" name="price"
                        class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5"
                        required>
                </div>

                <div>
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">Discount Price</label>
                    <input type="number" step="0.01" name="discount_price"
                        class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">
                </div>
            </div>

            {{-- SKU + Stock --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">SKU</label>
                    <input type="text" name="sku"
                        class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">
                </div>

                <div>
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">Stock</label>
                    <input type="number" name="stock"
                        class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">
                </div>
            </div>

            {{-- Material + Weight --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">Material</label>
                    <input type="text" name="material"
                        class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">
                </div>

                <div>
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">Weight (in grams)</label>
                    <input type="number" step="0.01" name="weight"
                        class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">
                </div>
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label class="font-bold text-zinc-700 mb-2 block font-heading">Status</label>
                <select name="status"
                    class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>


            {{-- Description --}}
            <div class="mb-4">
                <label class="font-bold text-zinc-700 mb-2 block font-heading">Description</label>
                <textarea name="description"
                    class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5"
                    rows="4"></textarea>
            </div>

            {{-- Image uploads --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">Main Image</label>
                    <input type="file" name="image"
                        class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">
                </div>

                <div>
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">Gallery Images</label>
                    <input type="file" multiple name="images[]"
                        class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">
                </div>
            </div>

            <button
                class="px-8 py-3 btn-gold rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg">Save
                Product</button>
        </form>

    </div>


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#tags').select2({
                placeholder: "Select Tags",
                allowClear: true,
                width: '100%'
            });
        });
    </script>


@endsection