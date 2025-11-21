@extends('layouts.admin')

@section('title', 'Orders')

@section('content')

<div class="flex justify-between mb-5">
    <h1 class="text-2xl font-bold">Orders</h1>

    <a href="{{ route('admin.orders.create') }}"
       class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
       + Add Order
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
                <th class="p-3 text-left">Customer</th>
                <th class="p-3 text-left">Email</th>
                <th class="p-3 text-left">Amount</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-left">Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($orders as $order)
            <tr class="border-b">

                <td class="p-3">{{ $order->customer_name }}</td>
                <td class="p-3">{{ $order->email }}</td>
                <td class="p-3">₹{{ number_format($order->total_amount, 2) }}</td>
                <td class="p-3 capitalize">{{ $order->status }}</td>

                <td class="p-3 space-x-2">

                    <a href="{{ route('admin.orders.edit', $order->id) }}"
                       class="text-blue-600 hover:underline">Edit</a>

                    <form action="{{ route('admin.orders.destroy', $order->id) }}"
                          method="POST"
                          class="inline-block"
                          onsubmit="return confirm('Delete this order?');">

                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="5" class="p-3 text-center text-gray-500">
                    No orders found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>

@endsection
