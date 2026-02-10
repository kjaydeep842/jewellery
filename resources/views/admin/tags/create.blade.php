@extends('layouts.admin')

@section('title', 'Add Tag')

@section('content')

<h1 class="text-3xl font-premium font-bold mb-6 text-zinc-900">Add Tag</h1>

<div class="bg-white p-8 rounded-xl shadow-lg border border-zinc-100 animate-enter">

    <form action="{{ route('admin.tags.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="font-bold text-zinc-700 mb-2 block font-heading">Tag Name</label>
            <input type="text" name="name"
                class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5"
                required>
        </div>

        <div class="mb-4">
            <label class="relative inline-flex items-center cursor-pointer group">
                <input type="checkbox" name="status" value="active" class="sr-only peer" checked>
                <div class="relative w-11 h-6 bg-zinc-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-amber-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500 transition-colors"></div>
                <span class="ml-3 font-medium text-zinc-700 group-hover:text-zinc-900 transition-colors">Active Status</span>
            </label>
        </div>

        <button
            class="px-8 py-3 btn-gold rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg">Save
            Tag</button>
        <a href="{{ route('admin.tags.index') }}"
            class="px-8 py-3 ml-4 bg-zinc-200 text-zinc-700 rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg hover:bg-zinc-300">
            Cancel
        </a>
    </form>

</div>

@endsection