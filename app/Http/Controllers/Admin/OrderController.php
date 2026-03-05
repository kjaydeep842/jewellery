<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        try {
            $orders = Order::latest()->paginate(10);
            return view('admin.orders.index', compact('orders'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to load orders. ' . $e->getMessage()]);
        }
    }

    public function create()
    {
        return view('admin.orders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'total_amount' => 'required|numeric',
            'status' => 'required|string',
        ]);

        try {
            Order::create($request->all());

            return redirect()->route('admin.orders.index')
                ->with('success', 'Order created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create order. ' . $e->getMessage()])->withInput();
        }
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'total_amount' => 'required|numeric',
            'status' => 'required|string',
        ]);

        try {
            $order->update($request->all());

            return redirect()->route('admin.orders.index')
                ->with('success', 'Order updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update order. ' . $e->getMessage()])->withInput();
        }
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        try {
            $order->delete();

            return redirect()->route('admin.orders.index')
                ->with('success', 'Order deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete order. ' . $e->getMessage()]);
        }
    }
}
