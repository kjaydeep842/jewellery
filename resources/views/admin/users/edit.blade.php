@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')

<h1 class="text-3xl font-premium font-bold mb-6 text-zinc-900">Edit User</h1>

<div class="bg-white p-8 rounded-xl shadow-lg border border-zinc-100 animate-enter">

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="font-bold text-zinc-700 mb-2 block font-heading">Name</label>
            <input type="text" name="name"
                class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5"
                value="{{ $user->name }}" required>
        </div>

        <div class="mb-4">
            <label class="font-bold text-zinc-700 mb-2 block font-heading">Email</label>
            <input type="email" name="email"
                class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5"
                value="{{ $user->email }}" required>
        </div>


        <div class="mb-4">
            <label class="font-bold text-zinc-700 mb-2 block font-heading">Is Admin?</label>
            <select name="is_admin"
                class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">
                <option value="0" {{ $user->is_admin == 0 ? 'selected' : '' }}>No</option>
                <option value="1" {{ $user->is_admin == 1 ? 'selected' : '' }}>Yes</option>
            </select>
        </div>


        <div class="mb-4">
            <label class="font-bold text-zinc-700 mb-2 block font-heading">New Password (optional)</label>
            <input type="password" name="password"
                class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">
            <p class="text-sm text-gray-500">Leave blank if you don't want to change.</p>
        </div>

        <button
            class="px-8 py-3 btn-gold rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg">Update
            User</button>
        <a href="{{ route('admin.users.index') }}"
            class="px-8 py-3 ml-4 bg-zinc-200 text-zinc-700 rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg hover:bg-zinc-300">
            Cancel
        </a>
    </form>

</div>

@endsection