@extends('layouts.admin')

@section('title', 'Categories')

@section('content')

<div class="flex justify-between mb-5">
    <h1 class="text-2xl font-bold">Categories</h1>

    <a href="{{ route('admin.categories.create') }}"
       class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
       + Add Category
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
                <th class="p-3 text-left">ID</th>
                <th class="p-3 text-left">Name</th>
                <th class="p-3 text-left">Slug</th>
                <th class="p-3 text-left">Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($categories as $category)
            <tr class="border-b">
                <td class="p-3">{{ $category->id }}</td>
                <td class="p-3">{{ $category->name }}</td>
                <td class="p-3">{{ $category->slug }}</td>

                <td class="p-3 space-x-2">
                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                       class="text-blue-600 hover:underline">Edit</a>

                    <form action="{{ route('admin.categories.destroy', $category->id) }}"
                          method="POST"
                          class="inline-block"
                          onsubmit="return confirm('Delete this category?');">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-3 text-center text-gray-500">
                    No categories found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</div>

@endsection
