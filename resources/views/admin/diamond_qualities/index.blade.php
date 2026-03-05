@extends('layouts.admin')

@section('title', 'Diamond Qualities')

@section('content')

<div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
    <h1 class="text-2xl sm:text-3xl font-premium font-bold text-zinc-900 tracking-wide">Diamond Qualities</h1>

    <a href="{{ route('admin.diamond_qualities.create') }}"
        class="flex items-center space-x-2 px-6 py-2.5 btn-gold rounded-lg shadow-lg hover:shadow-xl transition-all font-bold tracking-wide transform hover:-translate-y-0.5">
        <span class="text-xl">+</span>
        <span>Add Diamond Quality</span>
    </a>
</div>

@if(session('success'))
<div class="p-4 mb-6 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg flex items-center">
    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    {{ session('success') }}
</div>
@endif

<div class="bg-white border border-zinc-100 rounded-xl shadow-lg shadow-zinc-200/50 overflow-x-auto animate-enter p-4">
    <table id="diamondQualitiesTable" class="w-full text-left border-collapse stripe hover">
        <thead class="bg-zinc-50 text-zinc-900 border-b border-zinc-200">
            <tr>
                <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">ID</th>
                <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Name</th>
                <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Sort Order</th>
                <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Status</th>
                <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-zinc-100 text-sm">
            @foreach($diamond_qualities as $quality)
            <tr class="group hover:bg-amber-50/50 transition-colors">
                <td class="p-4 text-zinc-500">#{{ $quality->id }}</td>
                <td class="p-4 font-bold text-zinc-800">{{ $quality->name }}</td>
                <td class="p-4 text-zinc-600">{{ $quality->sort_order }}</td>
                <td class="p-4">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer toggle-status"
                            data-id="{{ $quality->id }}"
                            {{ $quality->status ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-zinc-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-amber-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                    </label>
                </td>
                <td class="p-4">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin.diamond_qualities.edit', $quality->id) }}"
                            class="p-2 bg-white border border-zinc-200 rounded-lg text-amber-600 hover:bg-amber-50 hover:border-amber-200 transition-all shadow-sm" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                            </svg>
                        </a>
                        <form action="{{ route('admin.diamond_qualities.destroy', $quality->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 bg-white border border-zinc-200 rounded-lg text-red-500 hover:bg-red-50 hover:border-red-200 transition-all shadow-sm" title="Delete">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#diamondQualitiesTable').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search...",
                lengthMenu: "Show _MENU_ entries"
            },
            columnDefs: [{
                orderable: false,
                targets: [4]
            }]
        });

        $(document).on('change', '.toggle-status', function() {
            let id = $(this).data('id');

            fetch(`/admin/diamond_qualities/${id}/toggle`, {
                    method: "PATCH",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // accessible notification or toast could go here
                    console.log(data.message);
                })
                .catch(err => {
                    console.error('Error toggling status:', err);
                    // revert checkbox if using real UI feedback
                    $(this).prop('checked', !$(this).is(':checked'));
                    alert('Failed to update status.');
                });
        });
    });
</script>
@endpush