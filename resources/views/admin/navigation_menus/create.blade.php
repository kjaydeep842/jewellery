@extends('layouts.admin')

@section('title', 'Add Navigation Menu')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.navigation_menus.index') }}" class="text-zinc-500 hover:text-amber-600 flex items-center mb-2 transition-colors">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back to List
    </a>
    <h1 class="text-3xl font-premium font-bold text-zinc-900 tracking-wide">Add Navigation Menu</h1>
</div>

@if($errors->any())
<div class="p-4 mb-6 bg-red-50 text-red-700 border border-red-200 rounded-xl">
    <ul class="list-disc list-inside">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="bg-white border border-zinc-100 rounded-2xl shadow-xl shadow-zinc-200/50 p-8 max-w-2xl animate-enter">
    <form action="{{ route('admin.navigation_menus.store') }}" method="POST">
        @csrf
        <div class="space-y-6">
            <div>
                <label for="title" class="block text-sm font-bold text-zinc-700 mb-2 uppercase tracking-wider">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                    class="w-full px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all outline-none"
                    placeholder="e.g. New Arrivals">
            </div>

            <div>
                <label for="route_name" class="block text-sm font-bold text-zinc-700 mb-2 uppercase tracking-wider">Route Name (if dynamic)</label>
                <input type="text" name="route_name" id="route_name" value="{{ old('route_name') }}"
                    class="w-full px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all outline-none"
                    placeholder="e.g. page.new-arrivals">
            </div>

            <div>
                <label for="url" class="block text-sm font-bold text-zinc-700 mb-2 uppercase tracking-wider">Direct URL (if not route)</label>
                <input type="text" name="url" id="url" value="{{ old('url') }}"
                    class="w-full px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all outline-none"
                    placeholder="e.g. /custom-page">
            </div>

            <div>
                <label for="order" class="block text-sm font-bold text-zinc-700 mb-2 uppercase tracking-wider">Display Order</label>
                <input type="number" name="order" id="order" value="{{ old('order', 0) }}" required
                    class="w-full px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all outline-none">
            </div>

            <div>
                <label for="status" class="block text-sm font-bold text-zinc-700 mb-2 uppercase tracking-wider">Status</label>
                <select name="status" id="status" required
                    class="w-full px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all outline-none">
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="pt-4">
                <button type="submit"
                    class="w-full py-4 bg-zinc-900 text-amber-500 font-bold rounded-xl shadow-lg hover:bg-black transition-all transform hover:-translate-y-1 uppercase tracking-widest text-sm border border-amber-500/20">
                    Create Menu Item
                </button>
            </div>
        </div>
    </form>
</div>

@endsection