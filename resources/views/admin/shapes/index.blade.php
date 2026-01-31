@extends('layouts.admin')

@section('title', 'Shapes')

@section('content')

    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
        <h1 class="text-2xl sm:text-3xl font-premium font-bold text-zinc-900 tracking-wide">Shapes</h1>

        <a href="{{ route('admin.shapes.create') }}"
            class="flex items-center space-x-2 px-6 py-2.5 btn-gold rounded-lg shadow-lg hover:shadow-xl transition-all font-bold tracking-wide transform hover:-translate-y-0.5">
            <span class="text-xl">+</span>
            <span>Add Shape</span>
        </a>
    </div>

    @if(session('success'))
        <div class="p-4 mb-6 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border border-zinc-100 rounded-xl shadow-lg shadow-zinc-200/50 overflow-x-auto animate-enter p-4">
        <table id="shapesTable" class="w-full text-left border-collapse stripe hover">
            <thead class="bg-zinc-50 text-zinc-900 border-b border-zinc-200">
                <tr>
                    <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">ID</th>
                    <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Image</th>
                    <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Name</th>
                    <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Status</th>
                    <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-100 text-sm">
                @foreach($shapes as $shape)
                    <tr class="group hover:bg-amber-50/50 transition-colors">
                        <td class="p-4 font-bold text-zinc-800">#{{ $shape->id }}</td>
                        <td class="p-4">
                            <img src="{{ asset('storage/' . $shape->image) }}" alt="{{ $shape->name }}"
                                class="h-10 w-10 object-contain rounded-md border border-zinc-200 bg-zinc-50">
                        </td>
                        <td class="p-4 font-bold text-zinc-800">{{ $shape->name }}</td>
                        <td class="p-4">
                            <span
                                class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                                            {{ $shape->status ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                {{ $shape->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.shapes.edit', $shape->id) }}"
                                    class="p-2 bg-white border border-zinc-200 rounded-lg text-amber-600 hover:bg-amber-50 hover:border-amber-200 transition-all shadow-sm"
                                    title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.shapes.destroy', $shape->id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-2 bg-white border border-zinc-200 rounded-lg text-red-500 hover:bg-red-50 hover:border-red-200 transition-all shadow-sm"
                                        title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
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

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#shapesTable').DataTable({
                    responsive: true,
                    autoWidth: false,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search shapes...",
                        lengthMenu: "Show _MENU_ entries"
                    },
                    columnDefs: [
                        { orderable: false, targets: [1, 4] } // Disable sorting on Image and Actions
                    ]
                });
            });
        </script>
    @endpush

@endsection