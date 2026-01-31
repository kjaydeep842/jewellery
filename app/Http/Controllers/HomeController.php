<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

use App\Models\Banner;
use App\Models\Shape;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch specific categories if needed, or just all for now
        $categories = Category::all();

        // Fetch featured products (latest 8 for now)
        $products = Product::with(['images', 'category'])->latest()->take(10)->get();

        // Fetch active top banners
        $banners = Banner::where('status', 1)->where('type', 'top')->latest()->get();

        // Fetch active middle banners
        $middleBanners = Banner::where('status', 1)->where('type', 'middle')->latest()->get();

        // Fetch active shapes
        $shapes = Shape::where('status', 1)->get();

        return view('home', compact('categories', 'products', 'banners', 'middleBanners', 'shapes'));
    }

    public function filterProducts(Request $request)
    {
        $categoryId = $request->category_id;

        \Illuminate\Support\Facades\Log::info("FilterProducts called with category_id: " . $categoryId);

        if ($categoryId == 'all') {
            $products = Product::with(['images', 'category'])->latest()->take(10)->get();
        } else {
            $products = Product::with(['images', 'category'])
                ->where('category_id', $categoryId)
                ->latest()
                ->take(10)
                ->get();
        }

        \Illuminate\Support\Facades\Log::info("Found " . $products->count() . " products.");

        $html = view('partials.home_products', compact('products'))->render();

        return response()->json(['html' => $html]);
    }
}
