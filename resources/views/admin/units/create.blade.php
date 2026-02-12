@extends('layouts.admin')

@section('title', 'Add Unit')

@section('content')

<h1 class="text-3xl font-premium font-bold mb-6 text-zinc-900">Add Unit</h1>

<div class="bg-white p-8 rounded-xl shadow-lg border border-zinc-100 animate-enter">

    <form action="{{ route('admin.units.store') }}" method="POST">
        @csrf

        <div class="mb-6">
            <label class="font-bold text-zinc-700 mb-2 block font-heading">Unit Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5"
                placeholder="e.g., Gram, Piece, Carat"
                required>
            @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="font-bold text-zinc-700 mb-2 block font-heading">Unit Code</label>
            <input type="text" name="code" value="{{ old('code') }}"
                class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5"
                placeholder="e.g., g, pcs, ct">
            <p class="text-xs text-zinc-500 mt-1">Short code or abbreviation for the unit (optional)</p>
            @error('code')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-8">
            <label class="font-bold text-zinc-700 mb-2 block font-heading">Status</label>
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" name="status" value="1" class="sr-only peer" checked>
                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                <span class="ms-3 text-sm font-medium text-gray-900">Active</span>
            </label>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="px-8 py-3 btn-gold rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg">
                Save Unit
            </button>
            <a href="{{ route('admin.units.index') }}"
                class="px-8 py-3 bg-zinc-200 text-zinc-700 rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg hover:bg-zinc-300 hover:text-zinc-900">
                Cancel
            </a>
        </div>
    </form>

</div>

@endsection