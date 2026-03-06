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

        // Fetch categories that specifically have new arrival products
        $newArrivalCategories = Category::whereHas('products', function ($query) {
            $query->where('is_new', 1)->where('status', 'active');
        })->get()->unique('name');

        // Fetch featured products (latest 8 for now)
        $products = Product::with(['images', 'category'])->latest()->take(10)->get();

        // Fetch active top banners
        $banners = Banner::where('status', 1)->where('type', 'top')->latest()->get();

        // Fetch active middle banners (excluding product banners)
        $middleBanners = Banner::where('status', 1)
            ->where('type', 'middle')
            ->where(function ($query) {
                $query->where('is_product_banner', 0)
                    ->orWhereNull('is_product_banner');
            })
            ->latest()
            ->get();

        // Fetch active shapes
        $shapes = Shape::where('status', 1)->get();

        // Fetch active styles for Unique Style section
        $uniqueStyles = \App\Models\Style::where('status', 1)->get();

        // Best Seller Logic
        $bestSellerId = \App\Models\OrderItem::select('product_id', \Illuminate\Support\Facades\DB::raw('SUM(quantity) as total_quantity'))
            ->whereHas('order', function ($q) {
                $q->where('created_at', '>=', now()->subDays(15));
            })
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->value('product_id');

        $bestSellerProduct = null;
        if ($bestSellerId) {
            $bestSellerProduct = Product::with(['images', 'category'])->find($bestSellerId);
        }

        // Fallback: If no sales in 15 days, get a product marked as bestseller, or just the latest one
        if (!$bestSellerProduct) {
            $bestSellerProduct = Product::with(['images', 'category'])->where('is_bestseller', 1)->first();
        }
        if (!$bestSellerProduct) {
            $bestSellerProduct = Product::with(['images', 'category'])->latest()->first();
        }

        // Fetch Reviews
        // 1. From last 15 days
        // 2. Approved
        // 3. Priority: 5 stars > 4 stars > others
        // 4. Rating >= 4
        // 5. Fallback to latest approved if no recent ones found
        $reviews = \App\Models\Review::with(['user', 'product.images'])
            ->where('is_approved', 1)
            ->where('rating', '>=', 4)
            ->where('created_at', '>=', now()->subDays(15))
            ->orderByDesc('rating') // 5, 4, 3...
            ->orderByDesc('created_at')
            ->take(10)
            ->get();

        if ($reviews->isEmpty()) {
            $reviews = \App\Models\Review::with(['user', 'product.images'])
                ->where('is_approved', 1)
                ->where('rating', '>=', 4)
                ->orderByDesc('rating')
                ->orderByDesc('created_at')
                ->take(10)
                ->get();
        }

        return view('frontend.home', compact('categories', 'newArrivalCategories', 'products', 'banners', 'middleBanners', 'shapes', 'uniqueStyles', 'bestSellerProduct', 'reviews'));

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

        $html = view('frontend.partials.home_products', compact('products'))->render();


        return response()->json(['html' => $html]);
    }

    public function faqs()
    {
        $faqs = \App\Models\Faq::where('status', true)->get();
        return view('frontend.faqs', compact('faqs'));

    }

    public function returnExchange()
    {
        $returns = \App\Models\ReturnExchange::where('status', true)->get();
        return view('frontend.return_exchange', compact('returns'));

    }

    public function showContactForm()
    {
        return view('frontend.contact');

    }

    public function submitContactForm(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        \App\Models\Contact::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_code' => $request->phone_code ?? '+91',
            'phone_number' => $request->phone_number,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}
