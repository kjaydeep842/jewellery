@extends('layouts.admin')

@section('title', 'Banners')

@section('content')

<div class="flex justify-between mb-5">
    <h1 class="text-2xl font-bold">Banners</h1>

    <a href="{{ route('admin.banners.create') }}"
       class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
       + Add Banner
    </a>
</div>

@if(session('success'))
    <div class="p-3 mb-4 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white shadow-md rounded-lg p-4">
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="p-3 text-left">ID</th>
                <th class="p-3 text-left">Title</th>
                <th class="p-3 text-left">Image</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-left">Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($banners as $banner)
            <tr class="border-b">
                <td class="p-3">{{ $banner->id }}</td>
                <td class="p-3">{{ $banner->title }}</td>

                <td class="p-3">
                    @if($banner->image)
                        <img src="{{ $banner->imageUrl() }}" class="h-12 w-24 object-cover rounded">
                    @else
                        <span class="text-gray-400 text-sm">No image</span>
                    @endif
                </td>

                <td class="p-3">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer toggle-status" 
                               data-id="{{ $banner->id }}"
                               {{ $banner->status ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-300 peer-focus:ring-4 peer-focus:ring-indigo-300 
                                    rounded-full peer  
                                    peer-checked:bg-indigo-600
                                    transition-all"></div>
                    </label>
                </td>

                <td class="p-3 space-x-4">

                    <a href="{{ route('admin.banners.edit', $banner->id) }}"
                       class="text-blue-600 hover:underline">
                        Edit
                    </a>

                    <form action="{{ route('admin.banners.destroy', $banner->id) }}"
                          method="POST"
                          class="inline-block"
                          onsubmit="return confirm('Delete this banner?');">
                        @csrf
                        @method('DELETE')

                        <button class="text-red-600 hover:underline">
                            Delete
                        </button>
                    </form>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="p-3 text-center text-gray-500">No banners found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

<script>
document.querySelectorAll('.toggle-status').forEach((toggle) => {
    toggle.addEventListener('change', function () {
        let id = this.dataset.id;

        fetch(`/admin/banners/${id}/toggle`, {
            method: "PATCH",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            }
        });
    });
});
</script>

@endsection
