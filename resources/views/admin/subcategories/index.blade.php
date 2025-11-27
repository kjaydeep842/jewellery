@extends('layouts.admin')

@section('title', 'Subcategories')

@section('content')

<div class="flex justify-between mb-5">
    <h1 class="text-2xl font-bold">Subcategories</h1>

   <a href="{{ route('admin.subcategories.create') }}"
   class="px-4 py-2 bg-indigo-600 text-white rounded mb-4 inline-block">
    + Add Subcategory
</a>
</div>




<div class="bg-white p-4 rounded shadow-md">
    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-2 border">Name</th>
                <th class="p-2 border">Category</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subcategories as $subcategory)
            <tr>
                <td class="p-2 border">{{ $subcategory->name }}</td>
                <td class="p-2 border">{{ $subcategory->category->name }}</td>
                <td class="p-2 border">
                    <a href="{{ route('admin.subcategories.edit', $subcategory->id) }}"
                       class="text-blue-600">Edit</a>

                    <form action="{{ route('admin.subcategories.destroy', $subcategory->id) }}"
                          method="POST" class="inline-block"
                          onsubmit="return confirm('Are you sure?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 ml-2">Delete</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $subcategories->links() }}
    </div>
</div>
@endsection
