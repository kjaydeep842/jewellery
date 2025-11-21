@extends('layouts.admin')

@section('title', 'Add Order')

@section('content')

<h1 class="text-2xl font-bold mb-4">Add Order</h1>

<div class="bg-white p-6 rounded-xl shadow-md">

    <form action="{{ route('admin.orders.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="font-medium">Customer Name</label>
            <input type="text" name="customer_name" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="font-medium">Email</label>
            <input type="email" name="email" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="font-medium">Phone</label>
            <input type="text" name="phone" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="font-medium">Total Amount</label>
            <input type="number" step="0.01" name="total_amount" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="font-medium">Status</label>
            <select name="status" class="w-full border p-2 rounded">
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>

        <button class="px-4 py-2 bg-indigo-600 text-white rounded">Save</button>
    </form>

</div>

@endsection
