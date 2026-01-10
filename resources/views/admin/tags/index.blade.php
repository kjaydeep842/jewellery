@extends('layouts.admin')

@section('title', 'Tags')

@section('content')

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-premium font-bold text-zinc-900 tracking-wide">Tags</h1>

        <a href="{{ route('admin.tags.create') }}"
            class="flex items-center space-x-2 px-6 py-2.5 btn-gold rounded-lg shadow-lg hover:shadow-xl transition-all font-bold tracking-wide transform hover:-translate-y-0.5">
            <span class="text-xl">+</span>
            <span>Add Tag</span>
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="p-4 mb-6 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border border-zinc-100 rounded-xl shadow-lg shadow-zinc-200/50 overflow-hidden animate-enter">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-zinc-50/50 border-b border-zinc-100/80">
                        <th class="p-5 text-xs font-bold uppercase text-zinc-400 tracking-widest font-heading">Name</th>
                        <th class="p-5 text-xs font-bold uppercase text-zinc-400 tracking-widest font-heading">Status</th>
                        <th class="p-5 text-xs font-bold uppercase text-zinc-400 tracking-widest font-heading">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-zinc-100">
    <div class="bg-white border border-zinc-100 rounded-xl shadow-lg shadow-zinc-200/50 overflow-hidden animate-enter p-4">
        <table id="tagsTable" class="w-full text-left border-collapse stripe hover">
            <thead class="bg-zinc-50 text-zinc-900 border-b border-zinc-200">
                <tr>
                    <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">ID</th>
                    <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Name</th>
                    <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-100 text-sm">
                @foreach($tags as $tag)
                <tr class="group hover:bg-amber-50/50 transition-colors">
                    <td class="p-4 text-zinc-500">#{{ $tag->id }}</td>
                    <td class="p-4 font-bold text-zinc-800">{{ $tag->name }}</td>
                    <td class="p-4">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.tags.edit', $tag->id) }}"
                               class="p-2 bg-white border border-zinc-200 rounded-lg text-amber-600 hover:bg-amber-50 hover:border-amber-200 transition-all shadow-sm" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                            <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
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

    @push('scripts')
    <script>
        $(document).ready(function() {
            $('#tagsTable').DataTable({
                responsive: true,
                autoWidth: false,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search tags...",
                    lengthMenu: "Show _MENU_ entries"
                },
                columnDefs: [
                    { orderable: false, targets: 2 } // Action column
                ]
            });
        });
    </script>
    @endpush

@endsection