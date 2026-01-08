@extends('layouts.admin')

@section('title', 'Banners')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-zinc-800">Banners</h1>

    <a href="{{ route('admin.banners.create') }}"
       class="flex items-center space-x-2 px-5 py-2.5 bg-gradient-to-r from-amber-400 to-yellow-500 text-zinc-900 rounded-lg hover:from-amber-500 hover:to-yellow-600 shadow-lg shadow-amber-500/20 transition-all font-bold tracking-wide border border-amber-300">
       <span class="text-lg">+</span>
       <span>Add Banner</span>
    </a>
</div>

@if(session('success'))
    <div class="p-4 mb-6 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        {{ session('success') }}
    </div>
@endif

<div class="bg-white border border-zinc-100 rounded-2xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-zinc-50 border-b border-zinc-100">
                    <th class="p-4 text-xs font-bold uppercase text-zinc-500 tracking-wider">ID</th>
                    <th class="p-4 text-xs font-bold uppercase text-zinc-500 tracking-wider">Title</th>
                    <th class="p-4 text-xs font-bold uppercase text-zinc-500 tracking-wider">Image</th>
                    <th class="p-4 text-xs font-bold uppercase text-zinc-500 tracking-wider">Status</th>
                    <th class="p-4 text-xs font-bold uppercase text-zinc-500 tracking-wider">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-zinc-100">
                @forelse ($banners as $banner)
                <tr class="hover:bg-zinc-50/50 transition-colors">
                    <td class="p-4 text-zinc-500">#{{ $banner->id }}</td>
                    <td class="p-4 font-medium text-zinc-700">{{ $banner->title }}</td>

                    <td class="p-4">
                        @if($banner->image)
                            <div class="h-12 w-24 rounded-lg overflow-hidden border border-zinc-200 shadow-sm">
                                <img src="{{ $banner->imageUrl() }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <span class="text-zinc-400 text-xs italic">No image</span>
                        @endif
                    </td>

                    <td class="p-4">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer toggle-status" 
                                   data-id="{{ $banner->id }}"
                                   {{ $banner->status ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-zinc-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-amber-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                        </label>
                    </td>

                    <td class="p-4">
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('admin.banners.edit', $banner->id) }}"
                               class="p-2 bg-white border border-zinc-200 rounded-lg text-emerald-600 hover:text-emerald-700 hover:border-emerald-300 transition-all shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>

                            <form action="{{ route('admin.banners.destroy', $banner->id) }}"
                                  method="POST"
                                  class="inline-block"
                                  onsubmit="return confirm('Delete this banner?');">
                                @csrf
                                @method('DELETE')

                                <button class="p-2 bg-white border border-zinc-200 rounded-lg text-rose-600 hover:text-rose-700 hover:border-rose-300 transition-all shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-zinc-400">No banners found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

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
