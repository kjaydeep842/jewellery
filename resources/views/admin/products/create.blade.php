@extends('layouts.admin')

@section('title', 'Add Product')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-zinc-800">Add New Product</h1>
        <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 bg-zinc-800 text-white rounded-lg hover:bg-zinc-700 font-semibold shadow-sm transition-all flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to List
        </a>
    </div>

    @if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        <strong class="font-bold">Whoops!</strong>
        <span class="block sm:inline">There were some problems with your input.</span>
        <ul class="mt-2 list-disc list-inside text-sm">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-lg border border-zinc-100 p-8" x-data="{ variants: [] }">
        @csrf

        {{-- 1. Basic Product Info --}}
        <div class="mb-8 border-b border-gray-100 pb-6">
            <h2 class="text-xl font-bold text-zinc-900 mb-4 font-heading border-l-4 border-amber-500 pl-3">Basic Product Info</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-4">
                <div>
                    <label class="block font-semibold text-zinc-700 mb-2">Product Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500" required>
                </div>
                <div>
                    <label class="block font-semibold text-zinc-700 mb-2">Slug (Auto)</label>
                    <input type="text" name="slug" value="{{ old('slug') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500">
                </div>
                <div>
                    <label class="block font-semibold text-zinc-700 mb-2">SKU</label>
                    <input type="text" name="sku" value="{{ old('sku') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500">
                </div>

                {{-- Categories & Masters --}}
                <div>
                    <label class="block font-semibold text-zinc-700 mb-2">Category <span class="text-red-500">*</span></label>
                    <select name="category_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500" required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-semibold text-zinc-700 mb-2">Subcategory</label>
                    <select name="subcategory_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500">
                        <option value="">-- Select Subcategory --</option>
                        @foreach($subcategories as $sub)
                        <option value="{{ $sub->id }}" {{ old('subcategory_id') == $sub->id ? 'selected' : '' }}>{{ $sub->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-semibold text-zinc-700 mb-2">Brand</label>
                    <select name="brand_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500">
                        <option value="">-- Select Brand --</option>
                        @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-semibold text-zinc-700 mb-2">Unit</label>
                    <select name="unit_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500">
                        <option value="">-- Select Unit --</option>
                        @foreach($units as $unit)
                        <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>{{ $unit->name }} ({{ $unit->code }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-semibold text-zinc-700 mb-2">Color (Generic)</label>
                    <select name="color_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500">
                        <option value="">-- Select Color --</option>
                        @foreach($colors as $color)
                        <option value="{{ $color->id }}" {{ old('color_id') == $color->id ? 'selected' : '' }}>{{ $color->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-2 lg:col-span-3">
                    <label class="block font-semibold text-zinc-700 mb-3">Tags</label>
                    <div class="bg-zinc-50 border border-zinc-200 rounded-lg p-4">
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
                            @foreach($tags as $tag)
                            <label class="relative flex items-center cursor-pointer group">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                    {{ (collect(old('tags'))->contains($tag->id)) ? 'checked' : '' }}
                                    class="peer sr-only">
                                <div class="w-full px-4 py-2.5 bg-white border-2 border-zinc-200 rounded-lg text-center text-sm font-medium text-zinc-700 transition-all
                                    peer-checked:bg-amber-50 peer-checked:border-amber-500 peer-checked:text-amber-700 peer-checked:shadow-md
                                    hover:border-amber-300 hover:shadow-sm
                                    flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4 opacity-0 peer-checked:opacity-100 transition-opacity text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>{{ $tag->name }}</span>
                                </div>
                            </label>
                            @endforeach
                        </div>
                        @if($tags->isEmpty())
                        <p class="text-zinc-500 text-sm text-center py-4">No tags available. <a href="{{ route('admin.tags.create') }}" class="text-amber-600 hover:underline">Create one</a></p>
                        @endif
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-zinc-700 mb-2">Price (Base) <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500" required>
                </div>
                <div>
                    <label class="block font-semibold text-zinc-700 mb-2">Discount Price</label>
                    <input type="number" step="0.01" name="discount_price" value="{{ old('discount_price') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500">
                </div>
                <div>
                    <label class="block font-semibold text-zinc-700 mb-2">Total/Global Stock</label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500">
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-zinc-700 mb-2">Short Description</label>
                <textarea name="short_description" rows="2" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500">{{ old('short_description') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-zinc-700 mb-2">Description</label>
                <textarea name="description" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500">{{ old('description') }}</textarea>
            </div>

            {{-- Flags --}}
            <div class="flex gap-6 mt-6">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="status" value="active" class="sr-only peer" checked>
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                    <span class="ms-3 text-sm font-medium text-gray-900">Active</span>
                </label>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ old('is_featured') ? 'checked' : '' }}>
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                    <span class="ms-3 text-sm font-medium text-gray-900">Featured</span>
                </label>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_new" value="1" class="sr-only peer" {{ old('is_new') ? 'checked' : '' }}>
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                    <span class="ms-3 text-sm font-medium text-gray-900">New Arrival</span>
                </label>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_bestseller" value="1" class="sr-only peer" {{ old('is_bestseller') ? 'checked' : '' }}>
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                    <span class="ms-3 text-sm font-medium text-gray-900">Bestseller</span>
                </label>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_ready_to_stock" value="1" class="sr-only peer" {{ old('is_ready_to_stock') ? 'checked' : '' }}>
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                    <span class="ms-3 text-sm font-medium text-gray-900">Ready To Stock</span>
                </label>
            </div>
        </div>

        {{-- 2. Media --}}
        <div class="mb-8 border-b border-gray-100 pb-6">
            <h2 class="text-xl font-bold text-zinc-900 mb-4 font-heading border-l-4 border-amber-500 pl-3">Media</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-semibold text-zinc-700 mb-2">Main Image</label>
                    <input type="file" name="image" class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                </div>
                <div>
                    <label class="block font-semibold text-zinc-700 mb-2">Video URL (YouTube/Vimeo)</label>
                    <input type="url" name="video_url" value="{{ old('video_url') }}" placeholder="https://..." class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500">
                </div>
                <div class="md:col-span-2">
                    <label class="block font-semibold text-zinc-700 mb-2">Gallery Images</label>
                    <input type="file" name="images[]" multiple class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-zinc-50 file:text-zinc-700 hover:file:bg-zinc-100">
                </div>
            </div>
        </div>

        {{-- 3. Detailed Info (Jewellery) --}}
        <div class="mb-8 border-b border-gray-100 pb-6">
            <h2 class="text-xl font-bold text-zinc-900 mb-4 font-heading border-l-4 border-amber-500 pl-3">Jewellery Specifications</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block font-semibold text-zinc-700 mb-2">Material</label>
                    <input type="text" name="material" value="{{ old('material') }}" placeholder="e.g. Gold" class="w-full border-gray-300 rounded-lg shadow-sm p-2.5">
                </div>
                <div>
                    <label class="block font-semibold text-zinc-700 mb-2">Total Weight (grams)</label>
                    <input type="number" step="0.001" name="weight" value="{{ old('weight') }}" class="w-full border-gray-300 rounded-lg shadow-sm p-2.5">
                </div>
                <div>
                    <label class="block font-semibold text-zinc-700 mb-2">Metal Type (Master)</label>
                    <select name="metal_type" class="w-full border-gray-300 rounded-lg p-2.5">
                        <option value="">Select Metal</option>
                        @foreach($metals as $metal)
                        <option value="{{ $metal->name }}" {{ old('metal_type') == $metal->name ? 'selected' : '' }}>{{ $metal->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-semibold text-zinc-700 mb-2">Metal Purity</label>
                    <input type="text" name="metal_purity" value="{{ old('metal_purity') }}" placeholder="e.g. 18KT" class="w-full border-gray-300 rounded-lg shadow-sm p-2.5">
                </div>
                <div>
                    <label class="block font-semibold text-zinc-700 mb-2">Metal Color</label>
                    <select name="metal_color_id" class="w-full border-gray-300 rounded-lg p-2.5">
                        <option value="">Select Color</option>
                        @foreach($metalColors as $mc)
                        <option value="{{ $mc->id }}" {{ old('metal_color_id') == $mc->id ? 'selected' : '' }}>{{ $mc->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-semibold text-zinc-700 mb-2">Gender</label>
                    <select name="gender" class="w-full border-gray-300 rounded-lg p-2.5">
                        <option value="">Select Gender</option>
                        <option value="Women">Women</option>
                        <option value="Men">Men</option>
                        <option value="Unisex">Unisex</option>
                        <option value="Kids">Kids</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold text-zinc-700 mb-2">Occasion</label>
                    <input type="text" name="occasion" value="{{ old('occasion') }}" class="w-full border-gray-300 rounded-lg shadow-sm p-2.5">
                </div>
                <div>
                    <label class="block font-semibold text-zinc-700 mb-2">Making Charges (Specs)</label>
                    <input type="number" step="0.01" name="making_charges" value="{{ old('making_charges') }}" class="w-full border-gray-300 rounded-lg shadow-sm p-2.5">
                </div>
                <div>
                    <label class="block font-semibold text-zinc-700 mb-2">Tax Rate (%)</label>
                    <input type="number" step="0.01" name="tax_rate" value="{{ old('tax_rate', 3.00) }}" class="w-full border-gray-300 rounded-lg shadow-sm p-2.5">
                </div>
            </div>
        </div>

        {{-- 4. Diamond Details --}}
        <div class="mb-8 border-b border-gray-100 pb-6">
            <h2 class="text-xl font-bold text-zinc-900 mb-4 font-heading border-l-4 border-amber-500 pl-3">Diamond Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-zinc-600 mb-1">Stone Type</label>
                    <input type="text" name="diamond_type" placeholder="e.g. Natural Diamond" value="{{ old('diamond_type') }}" class="w-full border-gray-300 rounded-lg shadow-sm p-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-zinc-600 mb-1">Shape</label>
                    <select name="diamond_shape_id" class="w-full border-gray-300 rounded-lg shadow-sm p-2 text-sm">
                        <option value="">Select Shape</option>
                        @foreach($shapes as $shape)
                        <option value="{{ $shape->id }}" {{ old('diamond_shape_id') == $shape->id ? 'selected' : '' }}>{{ $shape->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-zinc-600 mb-1">Color</label>
                    <select name="diamond_color" class="w-full border-gray-300 rounded-lg shadow-sm p-2 text-sm">
                        <option value="">Select Color</option>
                        @foreach($colors as $color)
                        <option value="{{ $color->name }}" {{ old('diamond_color') == $color->name ? 'selected' : '' }}>{{ $color->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-zinc-600 mb-1">Clarity</label>
                    <select name="diamond_clarity" class="w-full border-gray-300 rounded-lg shadow-sm p-2 text-sm">
                        <option value="">Select Clarity</option>
                        @foreach($diamondQualities as $clarity)
                        <option value="{{ $clarity->name }}" {{ old('diamond_clarity') == $clarity->name ? 'selected' : '' }}>{{ $clarity->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-zinc-600 mb-1">Carat</label>
                    <input type="number" step="0.001" name="diamond_carat" placeholder="0.000" value="{{ old('diamond_carat') }}" class="w-full border-gray-300 rounded-lg shadow-sm p-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-zinc-600 mb-1">Count</label>
                    <input type="number" name="diamond_count" placeholder="Total stones" value="{{ old('diamond_count') }}" class="w-full border-gray-300 rounded-lg shadow-sm p-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-zinc-600 mb-1">Weight</label>
                    <input type="number" step="0.001" name="diamond_weight" placeholder="Weight" value="{{ old('diamond_weight') }}" class="w-full border-gray-300 rounded-lg shadow-sm p-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-zinc-600 mb-1">Price</label>
                    <input type="number" step="0.01" name="diamond_price" placeholder="Price" value="{{ old('diamond_price') }}" class="w-full border-gray-300 rounded-lg shadow-sm p-2 text-sm">
                </div>
            </div>
        </div>

        {{-- 5. Price Breakup --}}
        <div class="mb-8 border-b border-gray-100 pb-6">
            <h2 class="text-xl font-bold text-zinc-900 mb-4 font-heading border-l-4 border-amber-500 pl-3">Price Breakup</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-zinc-600 mb-1">Gold Value</label>
                    <input type="number" step="0.01" name="price_gold_value" value="{{ old('price_gold_value') }}" class="w-full border-gray-300 rounded-lg shadow-sm p-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-zinc-600 mb-1">Diamond Value</label>
                    <input type="number" step="0.01" name="price_diamond_value" value="{{ old('price_diamond_value') }}" class="w-full border-gray-300 rounded-lg shadow-sm p-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-zinc-600 mb-1">Making Charges</label>
                    <input type="number" step="0.01" name="price_making_charges" value="{{ old('price_making_charges') }}" class="w-full border-gray-300 rounded-lg shadow-sm p-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-zinc-600 mb-1">GST Amount</label>
                    <input type="number" step="0.01" name="price_gst" value="{{ old('price_gst') }}" class="w-full border-gray-300 rounded-lg shadow-sm p-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-zinc-600 mb-1">Subtotal</label>
                    <input type="number" step="0.01" name="price_subtotal" value="{{ old('price_subtotal') }}" class="w-full border-gray-300 rounded-lg shadow-sm p-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-zinc-600 mb-1">Grand Total</label>
                    <input type="number" step="0.01" name="price_grand_total" value="{{ old('price_grand_total') }}" class="w-full border-gray-300 rounded-lg shadow-sm p-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-zinc-600 mb-1">Selling Price</label>
                    <input type="number" step="0.01" name="selling_price" value="{{ old('selling_price') }}" class="w-full bg-amber-50 border-amber-300 rounded-lg shadow-sm p-2 text-sm font-bold text-amber-900">
                </div>
            </div>
        </div>

        {{-- 6. Variants --}}
        <div class="mb-8 border-b border-gray-100 pb-6">
            <div class="flex justify-between items-center mb-4 border-l-4 border-amber-500 pl-3">
                <h2 class="text-xl font-bold text-zinc-900 font-heading">Variants (Sizes & Stock)</h2>
                <button type="button" @click="variants.push({size: '', stock: ''})" class="bg-zinc-800 text-white px-3 py-1 rounded hover:bg-zinc-700 text-sm">
                    + Add Size Variant
                </button>
            </div>

            <template x-if="variants.length === 0">
                <p class="text-gray-500 italic mb-4">No variants added. Product will use global stock.</p>
            </template>

            <div class="space-y-3">
                <template x-for="(variant, index) in variants" :key="index">
                    <div class="flex items-end gap-3 p-3 bg-zinc-50 border rounded-lg">
                        <div class="w-1/3">
                            <label class="text-xs font-bold text-gray-500 uppercase">Size</label>
                            <select :name="`variants[${index}][size]`" x-model="variant.size" class="w-full border-gray-300 rounded text-sm h-9">
                                <option value="">Select Size</option>
                                @foreach($sizes as $size)
                                <option value="{{ $size->number ?? $size->name }}">{{ $size->number ?? $size->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-1/3">
                            <label class="text-xs font-bold text-gray-500 uppercase">Stock</label>
                            <input type="number" :name="`variants[${index}][stock]`" x-model="variant.stock" placeholder="Qty" class="w-full border-gray-300 rounded text-sm h-9">
                        </div>
                        <div>
                            <button type="button" @click="variants.splice(index, 1)" class="text-red-500 text-sm font-semibold hover:underline">Remove</button>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        {{-- 7. SEO Info --}}
        <div class="mb-8">
            <h2 class="text-xl font-bold text-zinc-900 mb-4 font-heading border-l-4 border-amber-500 pl-3">SEO Details</h2>
            <div class="space-y-4">
                <div>
                    <label class="block font-semibold text-zinc-700 mb-2">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title') }}" class="w-full border-gray-300 rounded-lg shadow-sm p-2.5">
                </div>
                <div>
                    <label class="block font-semibold text-zinc-700 mb-2">Meta Description</label>
                    <textarea name="meta_description" rows="2" class="w-full border-gray-300 rounded-lg shadow-sm p-2.5">{{ old('meta_description') }}</textarea>
                </div>
                <div>
                    <label class="block font-semibold text-zinc-700 mb-2">Meta Keywords</label>
                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords') }}" placeholder="Comma separated keywords" class="w-full border-gray-300 rounded-lg shadow-sm p-2.5">
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-6 border-t border-zinc-100 gap-4 mt-8">
            <a href="{{ route('admin.products.index') }}" class="px-8 py-3 bg-zinc-100 hover:bg-zinc-200 text-zinc-700 font-bold rounded-lg shadow-sm transition-all">
                Cancel
            </a>
            <button type="submit" class="px-8 py-3 btn-gold hover:shadow-xl transition-all font-bold tracking-wide transform hover:-translate-y-0.5 rounded-lg shadow-md">
                Save Product
            </button>
        </div>

    </form>
</div>
@endsection