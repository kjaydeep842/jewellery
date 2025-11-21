@extends('layouts.admin')

@section('title', 'Users')

@section('content')

<div class="flex justify-between mb-5">
    <h1 class="text-2xl font-bold">Users</h1>

    <a href="{{ route('admin.users.create') }}"
       class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
       + Add User
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
                <th class="p-3 text-left">Email</th>
                <th class="p-3 text-left">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
            <tr class="border-b">
                <td class="p-3">{{ $user->id }}</td>
                <td class="p-3">{{ $user->name }}</td>
                <td class="p-3">{{ $user->email }}</td>

                <td class="p-3 space-x-2">
                    <a href="{{ route('admin.users.edit', $user->id) }}"
                       class="text-blue-600 hover:underline">Edit</a>

                    <form action="{{ route('admin.users.destroy', $user->id) }}"
                          method="POST"
                          class="inline-block"
                          onsubmit="return confirm('Delete this user?');">

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
        {{ $users->links() }}
    </div>
</div>

@endsection
