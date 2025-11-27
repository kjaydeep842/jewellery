@extends('layouts.admin')

@section('title', 'Tags')

@section('content')

<div class="flex justify-between mb-5">
    <h1 class="text-2xl font-bold">Tags</h1>
@if ($errors->any())
    <div class="bg-red-200 text-red-800 p-2 rounded mb-3">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

    <a href="{{ route('admin.tags.create') }}"
       class="px-4 py-2 bg-indigo-600 text-white rounded">
        + Add Tag
    </a>
</div>

@if(session('success'))
    <div class="p-2 bg-green-200 text-green-800 mb-3 rounded">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white p-4 rounded shadow-md">
    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-2 border">Name</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tags as $tag)
            <tr>
                <td class="p-2 border">{{ $tag->name }}</td>
                <td class="p-2 border">{{ ucfirst($tag->status) }}</td>
                <td class="p-2 border">
                    <a href="{{ route('admin.tags.edit', $tag->id) }}"
                       class="text-blue-600">Edit</a>

                    <form action="{{ route('admin.tags.destroy', $tag->id) }}"
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
        {{ $tags->links() }}
    </div>
</div>

@endsection
