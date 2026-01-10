@extends('layouts.admin')

@section('title', 'Add Order')

@section('content')

    <h1 class="text-3xl font-premium font-bold mb-6 text-zinc-900">Add Order</h1>

    <div class="bg-white p-8 rounded-xl shadow-lg border border-zinc-100 animate-enter">

        <form action="{{ route('admin.orders.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="font-bold text-zinc-700 mb-2 block font-heading">Customer Name</label>
                <input type="text" name="customer_name"
                    class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5"
                    required>
            </div>

            <div class="mb-4">
                <label class="font-bold text-zinc-700 mb-2 block font-heading">Email</label>
                <input type="email" name="email"
                    class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">
            </div>

            <div class="mb-4">
                <label class="font-bold text-zinc-700 mb-2 block font-heading">Phone</label>
                <input type="text" name="phone"
                    class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">
            </div>

            <div class="mb-4">
                <label class="font-bold text-zinc-700 mb-2 block font-heading">Total Amount</label>
                <input type="number" step="0.01" name="total_amount"
                    class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5"
                    required>
            </div>

            <div class="mb-4">
                <label class="font-bold text-zinc-700 mb-2 block font-heading">Status</label>
                <select name="status"
                    class="w-full border-zinc-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow p-2.5">
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            <button
                class="px-8 py-3 btn-gold rounded-lg font-bold text-lg tracking-wide transform hover:-translate-y-1 transition-all shadow-lg">Save
                Order</button>
        </form>

    </div>

@endsection