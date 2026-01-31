<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Auth::user()->wishlists()->with('product')->get();
        return view('frontend.wishlist.index', compact('wishlists'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = Auth::user();
        $exists = Wishlist::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($exists) {
            $exists->delete();
            return redirect()->back()->with('success', 'Product removed from wishlist.');
        } else {
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $request->product_id,
            ]);
            return redirect()->back()->with('success', 'Product added to wishlist.');
        }
    }

    public function destroy($id)
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
        $wishlist->delete();
        return redirect()->back()->with('success', 'Item removed from wishlist.');
    }
}
