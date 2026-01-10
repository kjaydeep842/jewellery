@extends('layouts.admin')

@section('title', 'Edit Subcategory')

@section('content')

    <h1 class="text-3xl font-premium font-bold mb-6 text-zinc-900">Edit Subcategory</h1>

    <div class="bg-white p-8 rounded-xl shadow-lg border border-zinc-100 animate-enter">

        <form action="{{ route('admin.subcategories.update', $subcategory->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-4">
                <label class="font-bold text-zinc-700 mb-2 block font-heading">Category</label>
                <select name="category_id"
                    class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $subcategory->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label class="font-bold text-zinc-700 mb-2 block font-heading">Subcategory Name</label>
                <input type="text" name="name"
                    class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5"
                    value="{{ $subcategory->name }}">
                @error('name')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
            </div>

            <button
                class="px-8 py-3 btn-gold rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg">Update
                Subcategory</button>
        </form>

    </div>

@endsection