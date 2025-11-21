@extends('layouts.admin')

@section('title', 'Edit Order')

@section('content')

<h1 class="text-2xl font-bold mb-4">Edit Order</h1>

<div class="bg-white p-6 rounded-xl shadow-md">

    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="font-medium">Customer Name</label>
            <input type="text" name="customer_name" class="w-full border p-2 rounded"
                   value="{{ $order->customer_name }}" required>
        </div>

        <div class="mb-4">
            <label class="font-medium">Email</label>
            <input type="email" name="email" class="w-full border p-2 rounded"
                   value="{{ $order->email }}">
        </div>

        <div class="mb-4">
            <label class="font-medium">Phone</label>
            <input type="text" name="phone" class="w-full border p-2 rounded"
                   value="{{ $order->phone }}">
        </div>

        <div class="mb-4">
            <label class="font-medium">Total Amount</label>
            <input type="number" step="0.01" name="total_amount" class="w-full border p-2 rounded"
                   value="{{ $order->total_amount }}" required>
        </div>

        <div class="mb-4">
            <label class="font-medium">Status</label>
            <select name="status" class="w-full border p-2 rounded">
                <option value="pending" {{ $order->status=='pending'?'selected':'' }}>Pending</option>
                <option value="processing" {{ $order->status=='processing'?'selected':'' }}>Processing</option>
                <option value="completed" {{ $order->status=='completed'?'selected':'' }}>Completed</option>
                <option value="cancelled" {{ $order->status=='cancelled'?'selected':'' }}>Cancelled</option>
            </select>
        </div>

        <button class="px-4 py-2 bg-indigo-600 text-white rounded">Update</button>
    </form>

</div>

@endsection
