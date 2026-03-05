@extends('layouts.admin')

@section('title', 'Edit Color')

@section('content')

<h1 class="text-3xl font-premium font-bold mb-6 text-zinc-900">Edit Color: {{ $color->name }}</h1>

<div class="bg-white p-8 rounded-xl shadow-lg border border-zinc-100 animate-enter">

    <form action="{{ route('admin.colors.update', $color->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label class="font-bold text-zinc-700 mb-2 block font-heading">Color Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $color->name) }}"
                class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5"
                placeholder="e.g., Red, Blue, Gold"
                required>
            @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="font-bold text-zinc-700 mb-2 block font-heading">Color Code (Hex)</label>
            <div class="flex gap-3 items-center">
                <input type="color" id="colorPicker" value="{{ old('code', $color->code ?? '#000000') }}"
                    class="h-12 w-16 border-zinc-300 rounded-lg cursor-pointer">
                <input type="text" name="code" id="colorCode" value="{{ old('code', $color->code) }}"
                    class="flex-1 border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5"
                    placeholder="#000000">
            </div>
            <p class="text-xs text-zinc-500 mt-1">Hex color code for visual representation (optional)</p>
            @error('code')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-8">
            <label class="font-bold text-zinc-700 mb-2 block font-heading">Status</label>
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" name="status" value="1" class="sr-only peer" {{ old('status', $color->status) ? 'checked' : '' }}>
                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                <span class="ms-3 text-sm font-medium text-gray-900">Active</span>
            </label>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="px-8 py-3 btn-gold rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg">
                Update Color
            </button>
            <a href="{{ route('admin.colors.index') }}"
                class="px-8 py-3 bg-zinc-200 text-zinc-700 rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg hover:bg-zinc-300 hover:text-zinc-900">
                Cancel
            </a>
        </div>
    </form>

</div>

@push('scripts')
<script>
    // Sync color picker with text input
    const colorPicker = document.getElementById('colorPicker');
    const colorCode = document.getElementById('colorCode');

    colorPicker.addEventListener('input', function() {
        colorCode.value = this.value;
    });

    colorCode.addEventListener('input', function() {
        if (/^#[0-9A-F]{6}$/i.test(this.value)) {
            colorPicker.value = this.value;
        }
    });

    // Initialize from existing value
    if (colorCode.value && /^#[0-9A-F]{6}$/i.test(colorCode.value)) {
        colorPicker.value = colorCode.value;
    }
</script>
@endpush

@endsection