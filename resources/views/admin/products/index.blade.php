@extends('layouts.admin')

@section('title', 'Products')

@section('content')

<div class="flex justify-between mb-5">
    <h1 class="text-2xl font-bold">Products</h1>

    <a href="{{ route('admin.products.create') }}"
       class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
       + Add Product
    </a>
</div>

@if(session('success'))
    <div class="p-3 mb-4 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white shadow-md rounded-lg p-4">
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="p-3 text-left">Image</th>
                <th class="p-3 text-left">Name</th>
                <th class="p-3 text-left">Category</th>
                <th class="p-2 border">Tags</th>
                <th class="p-3 text-left">Price</th>
                <th class="p-3 text-left">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($products as $product)
            <tr class="border-b">
            <td class="p-3">
                @if ($product->image)
                    <div class="w-9 h-9 overflow-hidden rounded border">
                        <img src="{{ asset('storage/' . $product->image) }}"
                            class="w-full h-full object-cover">
                    </div>
                @else
                    <span class="text-gray-400">No Image</span>
                @endif
            </td>

                
                <td class="p-3 border">{{ $product->name }}</td>
                <td class="p-3 border">{{ $product->category?->name ?? 'No Category' }}</td>
                <td class="p-3 border">
                        @foreach($product->tags as $tag)
                            <span class="bg-gray-200 text-gray-800 px-2 py-1 rounded text-xs">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                </td>

                <td class="p-3 border">₹{{ number_format($product->price, 2) }}</td>
             

                <td class="p-3 border space-x-2">

                    <a href="{{ route('admin.products.edit', $product->id) }}"
                       class="text-blue-600 hover:underline">Edit</a>

                    <form action="{{ route('admin.products.destroy', $product->id) }}"
                          method="POST" class="inline-block"
                          onsubmit="return confirm('Are you sure want to delete?');">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:underline">
                            Delete
                        </button>
                    </form>

                </td>

            </tr>
            @endforeach
        </tbody>

    </table>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>

@endsection
