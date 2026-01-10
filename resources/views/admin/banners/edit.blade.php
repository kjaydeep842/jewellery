@extends('layouts.admin')

@section('title', 'Edit Banner')

@section('content')

    <h1 class="text-3xl font-premium font-bold mb-6 text-zinc-900">Edit Banner</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white p-8 rounded-xl shadow-lg border border-zinc-100 animate-enter">

        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="font-bold text-zinc-700 mb-2 block font-heading">Title *</label>
                <input type="text" name="title"
                    class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5"
                    value="{{ $banner->title }}" required>
            </div>

            <div class="mb-4">
                <label class="font-bold text-zinc-700 mb-2 block font-heading">Description</label>
                <textarea name="desc"
                    class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5"
                    rows="3">{{ $banner->desc }}</textarea>
            </div>

            <div class="mb-4">
                <label class="font-bold text-zinc-700 mb-2 block font-heading">Current Image</label>
                @if($banner->image)
                    <div class="mb-3">
                        <img src="{{ $banner->imageUrl() }}"
                            class="h-24 rounded-lg shadow-md border border-zinc-200 object-cover">
                    </div>
                @endif

                <input type="file" name="image"
                    class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="status" value="1" class="sr-only peer" {{ $banner->status ? 'checked' : '' }}>
                    <div
                        class="w-11 h-6 bg-zinc-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-amber-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500">
                    </div>
                    <span class="ml-3 font-medium text-zinc-700">Active Status</span>
                </label>
            </div>

            <button
                class="px-8 py-3 btn-gold rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg">
                Update Banner
            </button>

        </form>
    </div>

@endsection