@extends('layouts.admin')

@section('title', 'Edit Return & Exchange Policy')

@section('content')

<h1 class="text-3xl font-premium font-bold mb-6 text-zinc-900">Edit Policy</h1>

<div class="bg-white p-8 rounded-xl shadow-lg border border-zinc-100 animate-enter max-w-4xl">

    <form action="{{ route('admin.returns.update', $return->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label class="font-bold text-zinc-700 mb-2 block font-heading">Title</label>
            <input type="text" name="title" value="{{ $return->title }}"
                class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5"
                required>
            @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="font-bold text-zinc-700 mb-2 block font-heading">Content</label>
            <textarea name="content"
                class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5"
                rows="6" required>{{ $return->content }}</textarea>
            @error('content')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="relative inline-flex items-center cursor-pointer group">
                <input type="checkbox" name="status" value="1" class="sr-only peer" {{ $return->status ? 'checked' : '' }}>
                <div class="relative w-11 h-6 bg-zinc-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-amber-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-zinc-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500 transition-colors"></div>
                <span class="ml-3 font-medium text-zinc-700 group-hover:text-zinc-900 transition-colors">Active Status</span>
            </label>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="px-8 py-3 btn-gold rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg">
                Update Policy
            </button>
            <a href="{{ route('admin.returns.index') }}"
                class="px-8 py-3 bg-zinc-200 text-zinc-700 rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg hover:bg-zinc-300">
                Cancel
            </a>
        </div>

    </form>

</div>

@endsection