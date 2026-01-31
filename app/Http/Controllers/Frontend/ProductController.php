<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Product::where('status', 1)->latest()->paginate(12);
        return view('products.index', compact('products'));
    }

    /**
     * Display the specified product.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->with(['category', 'subcategory', 'images', 'variants', 'stones', 'reviews.user'])
            ->firstOrFail();

        // Fetch related products (same category, excluding current)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with('images')
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
    /**
     * Fetch products by category for AJAX calls.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchByCategory(Request $request, $id)
    {
        if ($id === 'all') {
            $products = Product::where('status', 1)
                ->with(['images', 'category'])
                ->latest()
                ->take(10)
                ->get();
        } else {
            $products = Product::where('status', 1)
                ->where('category_id', $id)
                ->with(['images', 'category'])
                ->latest()
                ->take(10)
                ->get();
        }

        $html = view('partials.home_products', compact('products'))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'count' => $products->count()
        ]);
    }
}
