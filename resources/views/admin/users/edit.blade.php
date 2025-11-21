@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')

<h1 class="text-2xl font-bold mb-4">Edit User</h1>

<div class="bg-white p-6 rounded-xl shadow-md">

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="font-medium">Name</label>
            <input type="text" name="name" class="w-full border p-2 rounded"
                   value="{{ $user->name }}" required>
        </div>

        <div class="mb-4">
            <label class="font-medium">Email</label>
            <input type="email" name="email" class="w-full border p-2 rounded"
                   value="{{ $user->email }}" required>
        </div>


        <div class="mb-4">
            <label class="font-medium">Is Admin?</label>
            <select name="is_admin" class="w-full border p-2 rounded">
                <option value="0" {{ $user->is_admin == 0 ? 'selected' : '' }}>No</option>
                <option value="1" {{ $user->is_admin == 1 ? 'selected' : '' }}>Yes</option>
            </select>
        </div>


        <div class="mb-4">
            <label class="font-medium">New Password (optional)</label>
            <input type="password" name="password" class="w-full border p-2 rounded">
            <p class="text-sm text-gray-500">Leave blank if you don't want to change.</p>
        </div>

        <button class="px-4 py-2 bg-indigo-600 text-white rounded">Update</button>
    </form>

</div>

@endsection
