@extends('layouts.admin')

@section('title', 'Edit Diamond Quality')

@section('content')

<h1 class="text-3xl font-premium font-bold mb-6 text-zinc-900">Edit Diamond Quality</h1>

<div class="bg-white p-8 rounded-xl shadow-lg border border-zinc-100 animate-enter max-w-2xl">

    <form action="{{ route('admin.diamond_qualities.update', $diamond_quality->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="font-bold text-zinc-700 mb-2 block font-heading">Quality Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ $diamond_quality->name }}"
                class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5"
                required>
        </div>

        <div class="mb-4">
            <label class="font-bold text-zinc-700 mb-2 block font-heading">Sort Order</label>
            <input type="number" name="sort_order" value="{{ $diamond_quality->sort_order }}"
                class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">
        </div>

        <div class="mb-6">
            <label class="inline-flex items-center cursor-pointer">
                <!-- Hidden input to handle unchecked state -->
                <input type="hidden" name="status" value="0">
                <input type="checkbox" name="status" value="1" class="sr-only peer" {{ $diamond_quality->status ? 'checked' : '' }}>
                <div class="w-11 h-6 bg-zinc-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-amber-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                <span class="ml-3 text-sm font-medium text-zinc-700">Active</span>
            </label>
        </div>

        <div class="flex items-center">
            <button
                class="px-8 py-3 btn-gold rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg">
                Update
            </button>
            <a href="{{ route('admin.diamond_qualities.index') }}"
                class="px-8 py-3 ml-4 bg-zinc-200 text-zinc-700 rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg hover:bg-zinc-300 text-center">
                Cancel
            </a>
        </div>
    </form>

</div>

@endsection