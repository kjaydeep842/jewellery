@extends('layouts.admin')

@section('title', 'Add Category')

@section('content')

    <h1 class="text-3xl font-premium font-bold mb-6 text-zinc-900">Add Category</h1>

    <div class="bg-white p-8 rounded-xl shadow-lg border border-zinc-100 animate-enter">

        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="font-bold text-zinc-700 mb-2 block font-heading">Name</label>
                <input type="text" name="name"
                    class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5"
                    required>
            </div>

            <div class="mb-4">
                <label class="font-bold text-zinc-700 mb-2 block font-heading">Description</label>
                <textarea name="description"
                    class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5"
                    rows="4"></textarea>
            </div>

            <button
                class="px-8 py-3 btn-gold rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg">Save
                Category</button>
        </form>

    </div>

@endsection