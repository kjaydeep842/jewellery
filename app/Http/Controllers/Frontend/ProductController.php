<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Models\Banner;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $query = Product::where('status', 1);

        if (request()->has('search') && request()->input('search')) {
            $search = request()->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $products = $query->latest()->paginate(12);
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

        // Fetch active middle banners for the slider that are marked as product banners
        $banners = Banner::where('status', 1)
            ->where('type', 'middle')
            ->where('is_product_banner', 1)
            ->latest()
            ->get();

        return view('products.show', compact('product', 'relatedProducts', 'banners'));
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

        // Check if the request is for the slider
        if ($request->get('type') === 'slider') {
            $html = view('partials.home_product_slider', compact('products'))->render();
        } else {
            $html = view('partials.home_products', compact('products'))->render();
        }

        return response()->json([
            'success' => true,
            'html' => $html,
            'count' => $products->count()
        ]);
    }
    /**
     * Fetch search suggestions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchSuggestions(Request $request)
    {
        $query = $request->get('query');

        if (!$query) {
            return response()->json([]);
        }

        $suggestions = Product::where('status', 1)
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('tags', 'like', "%{$query}%"); // Assuming tags exist or just name
            })
            ->select('name', 'slug')
            ->latest()
            ->take(5)
            ->get();

        return response()->json($suggestions);
    }
}
