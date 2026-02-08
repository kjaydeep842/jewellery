<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    private function getCartData()
    {
        $cart = Cart::where('user_id', Auth::id())->where('status', 'active')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return null;
        }

        $cartItems = $cart->items;
        $totalMrp = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        $discount = 0;
        $platformFee = 20;
        $totalAmount = $totalMrp - $discount + $platformFee;

        return compact('cartItems', 'totalMrp', 'discount', 'platformFee', 'totalAmount');
    }

    public function address()
    {
        $addresses = Auth::user()->addresses;
        $cartData = $this->getCartData();

        if (!$cartData) {
            return redirect()->route('cart.index');
        }

        return view('frontend.checkout.address', array_merge(compact('addresses'), $cartData));
    }

    public function createAddress()
    {
        $cartData = $this->getCartData();

        if (!$cartData) {
            return redirect()->route('cart.index');
        }

        return view('frontend.checkout.add-address', $cartData);
    }

    public function storeAddress(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address_line_1' => 'required|string',
            'area' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
            'country' => 'required|string',
            'type' => 'required|in:home,office',
        ]);

        Auth::user()->addresses()->create($request->all());

        return redirect()->route('checkout.address');
    }

    public function editAddress($id)
    {
        $address = Auth::user()->addresses()->findOrFail($id);
        $cartData = $this->getCartData();

        if (!$cartData) {
            return redirect()->route('cart.index');
        }

        return view('frontend.checkout.add-address', array_merge(compact('address'), $cartData));
    }

    public function updateAddress(Request $request, $id)
    {
        $address = Auth::user()->addresses()->findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address_line_1' => 'required|string',
            'area' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
            'country' => 'required|string',
            'type' => 'required|in:home,office',
        ]);

        $address->update($request->all());

        return redirect()->route('checkout.address');
    }

    public function selectAddress($id)
    {
        // In a real app, store selected address in session
        session()->put('selected_address_id', $id);
        return redirect()->route('checkout.payment');
    }

    public function payment()
    {
        $addressId = session()->get('selected_address_id');
        if (!$addressId) {
            return redirect()->route('checkout.address');
        }

        $address = Address::find($addressId);
        $cartData = $this->getCartData();

        if (!$cartData) {
            return redirect()->route('cart.index');
        }

        return view('frontend.checkout.payment', array_merge(compact('address'), $cartData));
    }

    public function processOrder(Request $request)
    {
        $cart = Cart::where('user_id', Auth::id())->where('status', 'active')->first();
        if (!$cart) {
            return redirect()->route('cart.index');
        }

        $address = Address::find(session()->get('selected_address_id'));
        $total = $cart->items->sum(fn($item) => $item->price * $item->quantity);

        DB::transaction(function () use ($cart, $address, $total) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => 'pending',
                'total_amount' => $total,
                'address_id' => $address->id,
                'customer_name' => $address->name, // Or User name
                'email' => Auth::user()->email,
                'phone' => $address->phone,
                // delivery address can be stored as JSON or separate table relation. 
                // For now, simpler usage.
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_variant_id' => $item->product_variant_id,
                    'product_name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
            }

            // Clear cart
            $cart->items()->delete();
            $cart->delete();
        });

        session()->forget('selected_address_id');

        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }
}
