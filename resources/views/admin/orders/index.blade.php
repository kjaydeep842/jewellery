@extends('layouts.admin')

@section('title', 'Orders')

@section('content')

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-premium font-bold text-zinc-900 tracking-wide">Orders</h1>

        <a href="{{ route('admin.orders.create') }}"
            class="flex items-center space-x-2 px-6 py-2.5 btn-gold rounded-lg shadow-lg hover:shadow-xl transition-all font-bold tracking-wide transform hover:-translate-y-0.5">
            <span class="text-xl">+</span>
            <span>Add Order</span>
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

    <div class="bg-white border border-zinc-100 rounded-xl shadow-lg shadow-zinc-200/50 overflow-hidden animate-enter p-4">
        <table id="ordersTable" class="w-full text-left border-collapse stripe hover">
            <thead class="bg-zinc-50 text-zinc-900 border-b border-zinc-200">
                <tr>
                    <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Order ID</th>
                    <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Customer</th>
                    <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Total</th>
                    <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Status</th>
                    <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Date</th>
                    <th class="p-4 font-bold font-heading text-sm uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-100 text-sm">
                @foreach($orders as $order)
                <tr class="group hover:bg-amber-50/50 transition-colors">
                    <td class="p-4 font-bold text-zinc-800">#{{ $order->id }}</td>
                    <td class="p-4 text-zinc-600">{{ $order->user ? $order->user->name : 'Guest' }}</td>
                    <td class="p-4 font-bold text-zinc-900">₹{{ number_format($order->total_amount, 2) }}</td>
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                            {{ $order->status === 'completed' ? 'bg-emerald-100 text-emerald-700' : 
                               ($order->status === 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-zinc-100 text-zinc-600') }}">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="p-4 text-zinc-500">{{ $order->created_at->format('M d, Y') }}</td>
                    <td class="p-4">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.orders.show', $order->id) }}" 
                               class="p-2 bg-white border border-zinc-200 rounded-lg text-amber-600 hover:bg-amber-50 hover:border-amber-200 transition-all shadow-sm" title="View">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
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
            $('#ordersTable').DataTable({
                responsive: true,
                autoWidth: false,
                order: [[4, 'desc']], // Sort by Date (Column 4) descending
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search orders...",
                    lengthMenu: "Show _MENU_ entries"
                },
                columnDefs: [
                    { orderable: false, targets: 5 } // Disable sorting on Action column
                ]
            });
        });
    </script>
    @endpush

@endsection
