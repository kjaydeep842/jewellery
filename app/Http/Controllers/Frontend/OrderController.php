<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->latest()->get();
        return view('frontend.orders.index', compact('orders'));
    }

    public function cancelForm(Order $order)
    {
        // Ensure the order belongs to the authenticated user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Only allow cancellation if order is not already delivered, completed, cancelled, or refunded
        if (in_array($order->status, ['delivered', 'completed', 'cancelled', 'refunded', 'returned'])) {
            return redirect()->route('orders.index')->with('error', 'This order cannot be cancelled.');
        }

        return view('frontend.orders.cancel', compact('order'));
    }

    public function cancel(Request $request, Order $order)
    {
        // Ensure the order belongs to the authenticated user
        if ($order->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        // Update status to cancelled
        $order->update([
            'status' => 'cancelled',
            'cancel_reason' => $request->reason,
            'cancel_comment' => $request->comment
        ]);

        return response()->json(['success' => true]);
    }
}
