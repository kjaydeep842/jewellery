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

    public function faqs()
    {
        $faqs = \App\Models\Faq::where('status', true)->get();
        return view('faqs', compact('faqs'));
    }

    public function returnExchange()
    {
        $returns = \App\Models\ReturnExchange::where('status', true)->get();
        return view('return_exchange', compact('returns'));
    }

    public function showContactForm()
    {
        return view('contact');
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
