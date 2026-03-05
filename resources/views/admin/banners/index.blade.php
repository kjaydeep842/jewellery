@extends('layouts.admin')

@section('title', 'Banners')

@section('content')

    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
        <h1 class="text-2xl sm:text-3xl font-premium font-bold text-zinc-900 tracking-wide">Banners</h1>

        <a href="{{ route('admin.banners.create') }}"
            class="flex items-center space-x-2 px-6 py-2.5 btn-gold rounded-lg shadow-lg hover:shadow-xl transition-all font-bold tracking-wide transform hover:-translate-y-0.5">
            <span class="text-xl">+</span>
            <span>Add Banner</span>
        </a>
    </div>

@if(session('success'))
    <div class="p-4 mb-6 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        {{ session('success') }}
    </div>
@endif

    <div class="bg-white border border-zinc-100 rounded-xl shadow-lg shadow-zinc-200/50 overflow-x-auto animate-enter p-4">
        <table id="bannersTable" class="w-full text-left border-collapse stripe hover">
            <thead class="bg-zinc-50 text-zinc-900 border-b border-zinc-200">
                <tr>
                    <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">ID</th>
                    <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Title</th>
                    <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Section</th>
                    <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Product Banner?</th>
                    <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Image</th>
                    <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Status</th>
                    <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-100 text-sm">
                @foreach($banners as $banner)
                <tr class="group hover:bg-amber-50/50 transition-colors">
                    <td class="p-4 text-zinc-500">#{{ $banner->id }}</td>
                    <td class="p-4 font-bold text-zinc-800">{{ $banner->title }}</td>
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $banner->type == 'top' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700' }}">
                            {{ ucfirst($banner->type) }}
                        </span>
                    </td>
                    <td class="p-4">
                        @if($banner->is_product_banner)
                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-bold">Yes</span>
                        @else
                            <span class="text-gray-400 text-xs">-</span>
                        @endif
                    </td>
                    <td class="p-4">
                        @if($banner->image)
                            <div class="h-12 w-24 rounded-lg overflow-hidden border border-zinc-200 shadow-sm relative group/img">
                                <img src="{{ $banner->imageUrl() }}" class="w-full h-full object-cover transition-transform duration-500 group-hover/img:scale-110">
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
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.banners.edit', $banner->id) }}" 
                               class="p-2 bg-white border border-zinc-200 rounded-lg text-amber-600 hover:bg-amber-50 hover:border-amber-200 transition-all shadow-sm" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                            <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-white border border-zinc-200 rounded-lg text-red-500 hover:bg-red-50 hover:border-red-200 transition-all shadow-sm" title="Delete">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#bannersTable').DataTable({
            responsive: false,
            autoWidth: false,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search banners...",
                lengthMenu: "Show _MENU_ entries"
            },
            columnDefs: [
                { orderable: false, targets: [2, 4] } // Disable sorting on Image and Actions
            ]
        });

        // Event Delegation for Status Toggle (Works across pages)
        $(document).on('change', '.toggle-status', function() {
            let id = $(this).data('id');
            
            fetch(`/admin/banners/${id}/toggle`, {
                method: "PATCH",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                }
            })
            .then(() => {
                // Optional: Show toast notification
            })
            .catch(err => console.error('Error toggling status:', err));
        });
    });
</script>
@endpush

@endsection
