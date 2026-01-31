@extends('layouts.admin')

@section('title', 'Order Details #' . $order->id)

@section('content')

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <h1 class="text-3xl font-premium font-bold text-zinc-900 tracking-wide">Order #{{ $order->id }}</h1>
            <p class="text-zinc-500 mt-1">Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
        </div>

        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.orders.index') }}"
                class="px-5 py-2.5 bg-white border border-zinc-200 text-zinc-600 font-bold rounded-lg hover:bg-zinc-50 transition-all shadow-sm">
                &larr; Back
            </a>
            <button onclick="window.print()"
                class="px-5 py-2.5 bg-zinc-800 text-white font-bold rounded-lg hover:bg-zinc-700 transition-all shadow-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                    </path>
                </svg>
                Print Invoice
            </button>
            <a href="{{ route('admin.orders.edit', $order->id) }}"
                class="px-5 py-2.5 btn-gold font-bold rounded-lg shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                Edit Order
            </a>
        </div>
    </div>

    <!-- Order Status & Customer Banner -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Customer Info -->
        <div class="bg-white p-6 rounded-xl border border-zinc-100 shadow-sm md:col-span-2">
            <h2 class="text-lg font-bold font-heading mb-4 text-zinc-800 border-b pb-2">Customer Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs uppercase text-zinc-400 font-bold tracking-wider mb-1">Name</label>
                    <p class="text-zinc-900 font-medium text-lg">
                        {{ $order->customer_name ?: ($order->user ? $order->user->name : 'N/A') }}
                    </p>
                </div>
                <div>
                    <label class="block text-xs uppercase text-zinc-400 font-bold tracking-wider mb-1">Email</label>
                    <p class="text-zinc-900 font-medium">{{ $order->email ?: ($order->user ? $order->user->email : 'N/A') }}
                    </p>
                </div>
                <div>
                    <label class="block text-xs uppercase text-zinc-400 font-bold tracking-wider mb-1">Phone</label>
                    <p class="text-zinc-900 font-medium">{{ $order->phone ?: 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-xs uppercase text-zinc-400 font-bold tracking-wider mb-1">Payment
                        Method</label>
                    <p class="text-zinc-900 font-medium uppercase">{{ $order->payment_method ?? 'Cash On Delivery' }}</p>
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-xs uppercase text-zinc-400 font-bold tracking-wider mb-2">Shipping Address</label>
                <div class="text-zinc-700 bg-zinc-50 p-4 rounded-lg border border-zinc-100 italic">
                    @if($order->address)
                        <p class="font-bold text-zinc-900 not-italic mb-1">{{ $order->address->name }}</p>
                        <p>{{ $order->address->address_line_1 }}</p>
                        @if($order->address->address_line_2)
                            <p>{{ $order->address->address_line_2 }}</p>
                        @endif
                        <p>{{ $order->address->city }}, {{ $order->address->state }} {{ $order->address->zip }}</p>
                        <p>{{ $order->address->country }}</p>
                        <p class="mt-2 text-sm text-zinc-500 not-italic">
                            <span class="font-bold text-zinc-600">Tel:</span> {{ $order->address->phone }}
                        </p>
                    @else
                        <p class="text-zinc-400">No address provided</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="bg-white p-6 rounded-xl border border-zinc-100 shadow-sm">
            <h2 class="text-lg font-bold font-heading mb-4 text-zinc-800 border-b pb-2">Order Summary</h2>

            <div class="flex justify-between items-center mb-4">
                <span class="text-zinc-500 font-medium">Status</span>
                <span class="px-3 py-1 rounded-full text-sm font-bold uppercase tracking-wider
                            {{ $order->status === 'completed' ? 'bg-emerald-100 text-emerald-700' :
        ($order->status === 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-zinc-100 text-zinc-600') }}">
                    {{ $order->status }}
                </span>
            </div>

            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-zinc-500">Subtotal</span>
                    <span class="font-bold">₹{{ number_format($order->total_amount, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-zinc-500">Tax/Fees</span>
                    <span class="font-bold">₹0.00</span>
                </div>
                <div class="border-t pt-3 mt-3 flex justify-between items-center">
                    <span class="text-lg font-bold font-heading">Total</span>
                    <span class="text-2xl font-bold text-amber-600">₹{{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Items -->
    <div class="bg-white rounded-xl border border-zinc-100 shadow-sm overflow-hidden">
        <h2 class="p-6 text-lg font-bold font-heading text-zinc-800 border-b border-zinc-100 bg-zinc-50/50">
            Order Items
        </h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-zinc-50 border-b border-zinc-100">
                    <tr>
                        <th class="p-4 font-bold text-xs uppercase text-zinc-400 tracking-wider">Product</th>
                        <th class="p-4 font-bold text-xs uppercase text-zinc-400 tracking-wider text-center">Qty</th>
                        <th class="p-4 font-bold text-xs uppercase text-zinc-400 tracking-wider text-right">Price</th>
                        <th class="p-4 font-bold text-xs uppercase text-zinc-400 tracking-wider text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    {{-- Assuming 'items' relationship exists. If not, this part needs adjustment based on DB structure --}}
                    @if($order->items && $order->items->count() > 0)
                        @foreach($order->items as $item)
                            <tr>
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 bg-zinc-100 rounded-lg flex-shrink-0">
                                            {{-- Image Placeholder --}}
                                            @if($item->product && $item->product->image)
                                                <img src="{{ asset('storage/' . $item->product->image) }}"
                                                    class="w-full h-full object-cover rounded-lg">
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-bold text-zinc-800">{{ $item->product_name ?? 'Product Unavailable' }}
                                            </p>
                                            <p class="text-xs text-zinc-500">Ref: {{ $item->product_id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-center font-bold text-zinc-600">{{ $item->quantity }}</td>
                                <td class="p-4 text-right text-zinc-600">₹{{ number_format($item->price, 2) }}</td>
                                <td class="p-4 text-right font-bold text-zinc-900">
                                    ₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="p-8 text-center text-zinc-400 italic">
                                No items found explicitly linked to this order (or items relationship missing).
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection