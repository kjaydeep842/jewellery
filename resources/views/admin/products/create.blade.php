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

        <!-- Core Jewelry Details (New) -->
        <div class="mb-8 border-t border-zinc-100 pt-6">
            <h3 class="text-xl font-bold text-zinc-800 mb-4 font-heading">Jewelry Specifications</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">Metal Type</label>
                    <select name="metal_type" class="w-full border-zinc-300 rounded-lg p-2.5">
                        <option value="Gold">Gold</option>
                        <option value="Silver">Silver</option>
                        <option value="Platinum">Platinum</option>
                        <option value="Diamond">Diamond</option>
                    </select>
                </div>
                <div>
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">Metal Purity</label>
                    <input type="text" name="metal_purity" placeholder="e.g. 18k, 22k, 925"
                        class="w-full border-zinc-300 rounded-lg p-2.5">
                </div>
                <div>
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">Occasion</label>
                    <select name="occasion" class="w-full border-zinc-300 rounded-lg p-2.5">
                        <option value="">Select Occasion</option>
                        <option value="Wedding">Wedding</option>
                        <option value="Engagement">Engagement</option>
                        <option value="Daily Wear">Daily Wear</option>
                        <option value="Party">Party</option>
                        <option value="Gift">Gift</option>
                    </select>
                </div>
                <div>
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">Gender</label>
                    <select name="gender" class="w-full border-zinc-300 rounded-lg p-2.5">
                        <option value="Women">Women</option>
                        <option value="Men">Men</option>
                        <option value="Unisex">Unisex</option>
                        <option value="Kids">Kids</option>
                    </select>
                </div>
                <div>
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">Making Charges</label>
                    <input type="number" step="0.01" name="making_charges" placeholder="0.00"
                        class="w-full border-zinc-300 rounded-lg p-2.5">
                </div>
                <div>
                    <label class="font-bold text-zinc-700 mb-2 block font-heading">Tax Rate (%)</label>
                    <input type="number" step="0.01" name="tax_rate" value="3.00"
                        class="w-full border-zinc-300 rounded-lg p-2.5">
                </div>
            </div>
        </div>

        <!-- Dynamic Variants Section -->
        <div class="mb-8 border-t border-zinc-100 pt-6" x-data="{ variants: [] }">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-zinc-800 font-heading">Product Variants</h3>
                <button type="button"
                    @click="variants.push({size: '', color: '', purity: '', sku: '', price: '', stock: ''})"
                    class="px-4 py-2 bg-zinc-800 text-white rounded-lg text-sm hover:bg-zinc-700">
                    + Add Variant
                </button>
            </div>

            <template x-if="variants.length === 0">
                <p class="text-zinc-500 italic text-sm">No variants added yet.</p>
            </template>

            <div class="space-y-3">
                <template x-for="(variant, index) in variants" :key="index">
                    <div class="grid grid-cols-6 gap-2 bg-zinc-50 p-3 rounded-lg border border-zinc-200 items-end">
                        <div>
                            <label class="text-xs font-bold text-zinc-600">Size</label>
                            <input type="text" :name="`variants[${index}][size]`" x-model="variant.size"
                                class="w-full text-sm border-zinc-300 rounded" placeholder="Size">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-zinc-600">Color</label>
                            <input type="text" :name="`variants[${index}][color]`" x-model="variant.color"
                                class="w-full text-sm border-zinc-300 rounded" placeholder="Color">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-zinc-600">SKU</label>
                            <input type="text" :name="`variants[${index}][sku]`" x-model="variant.sku"
                                class="w-full text-sm border-zinc-300 rounded" placeholder="SKU" required>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-zinc-600">Price</label>
                            <input type="number" step="0.01" :name="`variants[${index}][price]`" x-model="variant.price"
                                class="w-full text-sm border-zinc-300 rounded" placeholder="0.00" required>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-zinc-600">Stock</label>
                            <input type="number" :name="`variants[${index}][stock_quantity]`" x-model="variant.stock"
                                class="w-full text-sm border-zinc-300 rounded" placeholder="Qty">
                        </div>
                        <div>
                            <button type="button" @click="variants.splice(index, 1)"
                                class="text-red-500 text-sm hover:underline">Remove</button>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Dynamic Stones Section -->
        <div class="mb-8 border-t border-zinc-100 pt-6" x-data="{ stones: [] }">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-zinc-800 font-heading">Diamond / Stone Details</h3>
                <button type="button"
                    @click="stones.push({type: 'Diamond', shape: 'Round', count: 0, weight: 0, clarity: '', color: ''})"
                    class="px-4 py-2 bg-zinc-800 text-white rounded-lg text-sm hover:bg-zinc-700">
                    + Add Stone Info
                </button>
            </div>

            <template x-if="stones.length === 0">
                <p class="text-zinc-500 italic text-sm">No stone details added.</p>
            </template>

            <div class="space-y-3">
                <template x-for="(stone, index) in stones" :key="index">
                    <div class="grid grid-cols-7 gap-2 bg-zinc-50 p-3 rounded-lg border border-zinc-200 items-end">
                        <div>
                            <label class="text-xs font-bold text-zinc-600">Type</label>
                            <input type="text" :name="`stones[${index}][type]`" x-model="stone.type"
                                class="w-full text-sm border-zinc-300 rounded" placeholder="Type">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-zinc-600">Shape</label>
                            <input type="text" :name="`stones[${index}][shape]`" x-model="stone.shape"
                                class="w-full text-sm border-zinc-300 rounded" placeholder="Shape">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-zinc-600">Count</label>
                            <input type="number" :name="`stones[${index}][total_count]`" x-model="stone.count"
                                class="w-full text-sm border-zinc-300 rounded" placeholder="Qty">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-zinc-600">Weight (ct)</label>
                            <input type="number" step="0.001" :name="`stones[${index}][total_weight]`"
                                x-model="stone.weight" class="w-full text-sm border-zinc-300 rounded" placeholder="Cts">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-zinc-600">Clar/Col</label>
                            <input type="text" :name="`stones[${index}][clarity]`" x-model="stone.clarity"
                                class="w-full text-sm border-zinc-300 rounded" placeholder="SI-IJ">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-zinc-600">Price/Addon</label>
                            <input type="number" :name="`stones[${index}][stone_price]`"
                                class="w-full text-sm border-zinc-300 rounded" placeholder="0.00">
                        </div>
                        <div>
                            <button type="button" @click="stones.splice(index, 1)"
                                class="text-red-500 text-sm hover:underline">Remove</button>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <button
            class="px-8 py-3 btn-gold rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg">Save
            Product</button>
        <a href="{{ route('admin.products.index') }}"
            class="px-8 py-3 ml-4 bg-zinc-200 text-zinc-700 rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg hover:bg-zinc-300">
            Cancel
        </a>
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

        $('#category').change(function() {
            var categoryId = $(this).val();
            if (categoryId) {
                $.ajax({
                    url: '/admin/categories/' + categoryId + '/subcategories',
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#subcategory').empty();
                        $('#subcategory').append('<option value="">-- Select Subcategory --</option>');
                        $.each(data, function(key, value) {
                            $('#subcategory').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#subcategory').empty();
                $('#subcategory').append('<option value="">-- Select Subcategory --</option>');
            }
        });
    });
</script>


@endsection