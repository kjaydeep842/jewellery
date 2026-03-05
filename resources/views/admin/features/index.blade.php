@extends('layouts.admin')

@section('title', 'Admin - Features')

@section('content')

<div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4 animate-fade-in-down">
    <h1 class="text-3xl font-bold text-amber-950 font-heading tracking-tight">
        Features
    </h1>

    <a href="{{ route('admin.features.create') }}"
        class="flex items-center space-x-2 px-6 py-2.5 btn-gold rounded-full shadow-lg hover:shadow-xl transition-all font-bold tracking-wide transform hover:-translate-y-0.5 group">
        <span class="text-xl group-hover:rotate-90 transition-transform duration-300">+</span>
        <span>Add Feature</span>
    </a>
</div>

@if(session('success'))
<div class="mb-6 p-4 rounded-xl bg-green-50/50 border border-green-200 text-green-700 flex items-center shadow-sm animate-fade-in-up">
    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-2xl shadow-xl border border-zinc-100 overflow-hidden animate-fade-in-up"
    style="animation-delay: 0.1s;">
    <div class="overflow-x-auto">
        <table id="featuresTable" class="w-full text-left border-collapse">
            <thead class="bg-zinc-50/50 border-b border-zinc-100">
                <tr>
                    <th class="p-5 font-bold font-heading text-xs uppercase tracking-wider text-zinc-500">ID</th>
                    <th class="p-5 font-bold font-heading text-xs uppercase tracking-wider text-zinc-500">Title</th>
                    <th class="p-5 font-bold font-heading text-xs uppercase tracking-wider text-zinc-500">Description</th>
                    <th class="p-5 font-bold font-heading text-xs uppercase tracking-wider text-zinc-500">Icon</th>
                    <th class="p-5 font-bold font-heading text-xs uppercase tracking-wider text-zinc-500 text-center">Status</th>
                    <th class="p-5 font-bold font-heading text-xs uppercase tracking-wider text-zinc-500 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-50">
                @foreach($features as $feature)
                <tr class="group hover:bg-amber-50/30 transition-colors duration-200">
                    <td class="p-5 text-zinc-500 font-mono text-sm">#{{ $feature->id }}</td>
                    <td class="p-5 font-medium text-zinc-800">{{ $feature->title }}</td>
                    <td class="p-5 text-zinc-600 text-sm max-w-xs truncate">{{ Str::limit($feature->description, 50) }}</td>
                    <td class="p-5">
                        @if($feature->image)
                        <div class="h-10 w-10 rounded-full overflow-hidden border border-zinc-200 shadow-sm relative group/img bg-white p-1">
                            <img src="{{ Storage::url($feature->image) }}"
                                class="w-full h-full object-contain transition-transform duration-500 group-hover/img:scale-110"
                                alt="{{ $feature->title }}">
                        </div>
                        @else
                        <span class="text-zinc-400 text-xs italic px-2 py-1 bg-zinc-100 rounded">No icon</span>
                        @endif
                    </td>
                    <td class="p-5 text-center">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer toggle-status"
                                data-id="{{ $feature->id }}"
                                {{ $feature->status ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-zinc-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-amber-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                        </label>
                    </td>
                    <td class="p-5 text-right">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('admin.features.edit', $feature->id) }}"
                                class="p-2 bg-white border border-zinc-200 rounded-lg text-amber-600 hover:bg-amber-50 hover:border-amber-300 hover:text-amber-700 transition-all shadow-sm group/edit" title="Edit">
                                <svg class="w-4 h-4 transform group-hover/edit:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>
                            </a>
                            <form action="{{ route('admin.features.destroy', $feature->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this feature?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-white border border-zinc-200 rounded-lg text-red-500 hover:bg-red-50 hover:border-red-300 hover:text-red-700 transition-all shadow-sm group/delete" title="Delete">
                                    <svg class="w-4 h-4 transform group-hover/delete:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTable with custom settings
        var table = $('#featuresTable').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search features...",
                lengthMenu: "Display _MENU_",
                paginate: {
                    first: '«',
                    last: '»',
                    next: '›',
                    previous: '‹'
                }
            },
            columnDefs: [{
                    orderable: false,
                    targets: [2, 4]
                }, // Disable sorting on Icon and Actions
                {
                    className: "dt-center",
                    targets: [3]
                } // Center align Status column
            ],
            dom: '<"flex flex-col sm:flex-row justify-between items-center mb-4 space-y-2 sm:space-y-0"<"flex items-center"l><"flex items-center"f>>rt<"flex flex-col sm:flex-row justify-between items-center mt-4 space-y-2 sm:space-y-0"ip>',
            initComplete: function() {
                // Custom styling for search input
                $('.dataTables_filter input').addClass('px-4 py-2 border border-zinc-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent text-sm transition-all shadow-sm');
                // Custom styling for length select
                $('.dataTables_length select').addClass('px-8 py-2 border border-zinc-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent text-sm cursor-pointer shadow-sm bg-white');
            }
        });

        // Toggle Status Logic
        $(document).on('change', '.toggle-status', function() {
            let id = $(this).data('id');
            let checkbox = $(this);

            // Add loading state opacity
            checkbox.closest('label').addClass('opacity-50 pointer-events-none');

            fetch(`/admin/features/${id}/toggle`, {
                    method: "PATCH",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    // Success handling (optional toast could go here)
                    console.log('Status updated:', data.message);
                })
                .catch(err => {
                    console.error('Error toggling status:', err);
                    // Revert checkbox state on error
                    checkbox.prop('checked', !checkbox.prop('checked'));
                    alert('Failed to update status. Please try again.');
                })
                .finally(() => {
                    // Remove loading state
                    checkbox.closest('label').removeClass('opacity-50 pointer-events-none');
                });
        });
    });
</script>
<style>
    /* Custom Pagination Styling Overrides */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 0.5rem !important;
        margin: 0 0.25rem !important;
        border: 1px solid transparent !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #fef3c7 !important;
        /* amber-100 */
        color: #d97706 !important;
        /* amber-600 */
        border: 1px solid #fcd34d !important;
        /* amber-300 */
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: linear-gradient(to right, #d97706, #b45309) !important;
        /* amber-600 to amber-700 */
        color: white !important;
        border: none !important;
        box-shadow: 0 2px 4px rgba(217, 119, 6, 0.3);
    }
</style>
@endpush

@endsection