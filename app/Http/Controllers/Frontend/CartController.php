<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartController extends Controller
{
    private function getCart()
    {
        if (Auth::check()) {
            return Cart::firstOrCreate(
                ['user_id' => Auth::id(), 'status' => 'active'],
                ['session_id' => null]
            );
        }

        $sessionId = session()->get('cart_session_id');
        if (!$sessionId) {
            $sessionId = Str::uuid();
            session()->put('cart_session_id', $sessionId);
        }

        return Cart::firstOrCreate(
            ['session_id' => $sessionId, 'status' => 'active'],
            ['user_id' => null]
        );
    }

    public function index()
    {
        $cart = $this->getCart();
        $cartItems = $cart->items()->with(['product', 'variant'])->get();
        return view('frontend.checkout.cart', compact('cartItems'));
    }

    public function headerIndex()
    {
        $cart = $this->getCart();
        $cartItems = $cart->items()->with(['product', 'variant'])->get();

        $totalMrp = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        $discount = 0; // Logic for discount can be added here
        $platformFee = 20;
        $totalAmount = $totalMrp - $discount + $platformFee;

        // Fetch similar products (e.g., random 4 items)
        $similarProducts = Product::inRandomOrder()->take(4)->get();

        return view('frontend.cart.header-index', compact('cartItems', 'totalMrp', 'discount', 'platformFee', 'totalAmount', 'similarProducts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'variant_id' => 'nullable|exists:product_variants,id',
        ]);

        $cart = $this->getCart();
        $product = Product::find($request->product_id);

        $price = $product->sale_price ?? $product->price;
        // If variant adds to price, logic would go here. For now simpler.

        $cartItem = CartItem::updateOrCreate(
            [
                'cart_id' => $cart->id,
                'product_id' => $request->product_id,
                'product_variant_id' => $request->variant_id,
            ],
            [
                'quantity' => \DB::raw('quantity + ' . $request->quantity),
                'price' => $price
            ]
        );

        return redirect()->route('cart.index')->with('success', 'Item added to cart.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::findOrFail($id);
        $cartItem->update(['quantity' => $request->quantity]);

        return redirect()->back()->with('success', 'Cart updated.');
    }

    public function destroy($id)
    {
        CartItem::destroy($id);
        return redirect()->back()->with('success', 'Item removed from cart.');
    }
}
