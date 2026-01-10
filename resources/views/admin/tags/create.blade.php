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
                <label class="font-bold text-zinc-700 mb-2 block font-heading">Status</label>
                <select name="status"
                    class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <button
                class="px-8 py-3 btn-gold rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg">Save
                Tag</button>
        </form>

    </div>

@endsection