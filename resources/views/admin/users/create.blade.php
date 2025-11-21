@extends('layouts.admin')

@section('title', 'Add User')

@section('content')

<h1 class="text-2xl font-bold mb-4">Add User</h1>

<div class="bg-white p-6 rounded-xl shadow-md">

   <form action="{{ route('admin.users.store') }}" method="POST">
    @csrf

    <div class="mb-4">
        <label class="font-medium">Name</label>
        <input type="text" name="name" class="w-full border p-2 rounded" required>
    </div>

    <div class="mb-4">
        <label class="font-medium">Email</label>
        <input type="email" name="email" class="w-full border p-2 rounded" required>
    </div>

    <div class="mb-4">
        <label class="font-medium">Password</label>
        <input type="password" name="password" class="w-full border p-2 rounded" required>
    </div>

    <div class="mb-4">
        <label class="font-medium">Is Admin?</label>
        <select name="is_admin" class="w-full border p-2 rounded">
            <option value="0">No</option>
            <option value="1">Yes</option>
        </select>
    </div>

    <button class="px-4 py-2 bg-indigo-600 text-white rounded">Save</button>
</form>

</div>

@endsection
