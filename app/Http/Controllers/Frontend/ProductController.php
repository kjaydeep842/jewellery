<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Models\Banner;
use App\Models\Category;
use App\Models\MetalColor;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'images', 'variants', 'metalColor'])
            ->where('status', 'active');

        // Search logic - Check if search term matches a category first
        if ($request->has('search') && $request->input('search')) {
            $search = $request->input('search');

            // Check if search term matches a category name (case-insensitive)
            $matchingCategory = Category::whereRaw('LOWER(name) = ?', [strtolower($search)])->first();

            if ($matchingCategory) {
                // If search matches a category, convert to category filter
                // This ensures the category filter UI shows correctly
                // Use the actual category name from database (proper case)
                $request->merge(['category' => [$matchingCategory->name]]);
                // Remove search parameter to avoid confusion
                $request->request->remove('search');
            } else {
                // Otherwise, do regular text search
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            }
        }

        // Filter by Category
        if ($request->has('category')) {
            $categories = $request->input('category');
            if (is_array($categories)) {
                $query->whereHas('category', function ($q) use ($categories) {
                    $q->whereIn('name', $categories);
                });
            }
        }

        // Filter by Gender
        if ($request->has('gender')) {
            $genders = $request->input('gender');
            if (is_array($genders)) {
                $query->whereIn('gender', $genders);
            }
        }

        // Filter by Metal Color
        if ($request->has('metal_color')) {
            $colors = $request->input('metal_color');
            if (is_array($colors)) {
                $query->whereHas('metalColor', function ($q) use ($colors) {
                    $q->whereIn('name', $colors);
                });
            }
        }

        // Filter by Metal Purity
        if ($request->has('metal_purity')) {
            $purities = $request->input('metal_purity');
            if (is_array($purities)) {
                $query->whereIn('metal_purity', $purities);
            }
        }

        // Filter by Size (using Variants)
        if ($request->has('size')) {
            $sizes = $request->input('size');
            if (is_array($sizes)) {
                $query->whereHas('variants', function ($q) use ($sizes) {
                    $q->whereIn('size', $sizes);
                });
            }
        }

        // Filter by Weight
        if ($request->has('weight')) {
            $weights = $request->input('weight');
            if (is_array($weights)) {
                $query->where(function ($q) use ($weights) {
                    foreach ($weights as $weightRange) {
                        $parts = explode('-', $weightRange);
                        if (count($parts) == 2) {
                            $min = (float) $parts[0];
                            $max = (float) $parts[1];
                            $q->orWhereBetween('weight', [$min, $max]);
                        }
                    }
                });
            }
        }

        // Filter by Price
        if ($request->has('price')) {
            $prices = $request->input('price');
            if (is_array($prices)) {
                $query->where(function ($q) use ($prices) {
                    foreach ($prices as $priceRange) {
                        $range = str_replace(['₹', ',', ' '], '', $priceRange);
                        $parts = explode('-', $range);
                        if (count($parts) == 2) {
                            $min = (int) $parts[0];
                            $max = (int) $parts[1];
                            $q->orWhereBetween('selling_price', [$min, $max]);
                        }
                    }
                });
            }
        }

        // Sorting
        $sort = $request->input('sort', 'newest');
        switch ($sort) {
            case 'price_low_high':
                $query->orderBy('selling_price', 'asc');
                break;
            case 'price_high_low':
                $query->orderBy('selling_price', 'desc');
                break;
            case 'popularity':
                $query->orderBy('views', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate(12)->withQueryString();

        // Fetch Filter Options
        $categories = Category::pluck('name');
        $genders = Product::distinct()->pluck('gender')->filter();
        $metalColors = MetalColor::pluck('name');
        $metalPurities = Product::distinct()->pluck('metal_purity')->filter();
        $sizes = [10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20];
        $weightRanges = [
            '0-2' => '0-2 g',
            '2-5' => '2-5 g',
            '5-10' => '5-10 g',
            '10-20' => '10-20 g',
            '20-30' => '20-30 g'
        ];

        if ($request->ajax()) {
            return view('frontend.products.partials.grid', compact('products'));
        }

        return view('frontend.products.index', compact(
            'products',
            'categories',
            'genders',
            'metalColors',
            'metalPurities',
            'sizes',
            'weightRanges'
        ));
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

        return view('frontend.products.show', compact('product', 'relatedProducts', 'banners'));

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
            $html = view('frontend.partials.home_product_slider', compact('products'))->render();

        } else {
            $html = view('frontend.partials.home_products', compact('products'))->render();

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
