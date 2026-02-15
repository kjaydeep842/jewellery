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

    public function headerIndex()
    {
        $wishlists = Auth::user()->wishlists()->with('product')->get();
        return view('frontend.wishlist.header-index', compact('wishlists'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = Auth::user();
        if (!$user) {
            if ($request->wantsJson()) {
                return response()->json(['status' => 'unauthenticated', 'message' => 'Please login to add to wishlist.'], 401);
            }
            // Store the product ID to add it to the wishlist after login
            session(['pending_wishlist_product_id' => $request->product_id]);
            // Manually set intended URL if not already set (since this route is now public)
            if (!session()->has('url.intended')) {
                session(['url.intended' => url()->previous()]);
            }
            session()->save();
            return redirect()->route('frontend.auth.mobile')->with('error', 'Please login to add to wishlist.');
        }


        $exists = Wishlist::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($exists) {
            $exists->delete();
            $message = 'Product removed from wishlist.';
            $status = 'removed';
        } else {
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $request->product_id,
            ]);
            $message = 'Product added to wishlist.';
            $status = 'added';
        }

        $count = $user->wishlists()->count();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => $status,
                'message' => $message,
                'count' => $count
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    public function destroy($id)
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
        $wishlist->delete();
        return redirect()->back()->with('success', 'Item removed from wishlist.');
    }
}
