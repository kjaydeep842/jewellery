<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Models\Banner;
use App\Models\Category;
use App\Models\MetalColor;
use App\Models\Shape;
use App\Models\DiamondQuality;
use App\Models\Metal;
use App\Models\ProductVariant;

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
        if ($request->filled('price')) {
            // Checkbox logic takes precedence
            $priceRanges = is_array($request->price) ? $request->price : [$request->price];

            $query->where(function ($q) use ($priceRanges) {
                foreach ($priceRanges as $range) {
                    // Clean string: "₹ 0 - ₹ 10,000" -> "0-10000"
                    $rangeClean = str_replace(['₹', ',', ' '], '', $range);
                    $parts = explode('-', $rangeClean);
                    if (count($parts) == 2) {
                        $min = (int) $parts[0];
                        $max = (int) $parts[1];
                        $q->orWhereBetween('selling_price', [$min, $max]);
                    }
                }
            });
        } elseif ($request->filled('min_price') && $request->filled('max_price')) {
            // Slider logic (Effective only if no specific ranges checked)
            $minPrice = (int) $request->min_price;
            $maxPrice = (int) $request->max_price;

            // If max price is at the slider limit (100000), treat it as open-ended or just high
            if ($maxPrice >= 100000) {
                $query->where('selling_price', '>=', $minPrice);
            } else {
                $query->whereBetween('selling_price', [$minPrice, $maxPrice]);
            }
        }

        // Filter by Diamond Shape
        if ($request->has('diamond_shape')) {
            $shapes = $request->input('diamond_shape');
            if (is_array($shapes)) {
                $query->whereHas('diamondShape', function ($q) use ($shapes) {
                    $q->whereIn('name', $shapes);
                });
            }
        }

        // Filter by New Arrival (is_new)
        if ($request->has('is_new') && $request->input('is_new') == 1) {
            $query->where('is_new', 1);
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
        $categories = Category::all();
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
        $shapes = Shape::where('status', 1)->pluck('name'); // Fetch active shapes

        if ($request->ajax()) {
            return view('frontend.products.partials.grid', compact('products'));
        }

        return view('frontend.products.index', compact(
            'products',
            'categories',
            'genders',
            'metalColors',
            'metalPurities',
            'metalPurities',
            'sizes',
            'weightRanges',
            'shapes'
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
            ->with(['category', 'subcategory', 'images', 'variants', 'stones', 'reviews.user', 'metalColor', 'diamondShape'])
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

        // Fetch active vertical banner for the similar products section
        $verticalBanner = Banner::where('status', 1)
            ->where(function ($q) {
                $q->where('type', 'prod_vertical')
                    ->orWhere('is_prod_vertical', 1);
            })
            ->latest()
            ->first();

        // Fetch attributes for dynamic selection
        $metals = Metal::where('status', 1)->orderBy('sort_order', 'asc')->get();
        $diamondQualities = DiamondQuality::where('status', 1)->orderBy('sort_order', 'asc')->get();
        $shapes = Shape::where('status', 1)->get();
        $metalColors = MetalColor::where('status', 1)->get();

        return view('frontend.products.show', compact(
            'product',
            'relatedProducts',
            'banners',
            'verticalBanner',
            'metals',
            'diamondQualities',
            'shapes',
            'metalColors'
        ));

    }

    /**
     * Calculate dynamic price via AJAX when variations change.
     */
    public function calculatePrice(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $size = $request->input('size');
        $color = $request->input('color');
        $purity = $request->input('purity');
        $diamondQuality = $request->input('diamond_quality');
        $shape = $request->input('shape');

        $variants = ProductVariant::where('product_id', $product->id)->get();

        $bestVariant = null;

        foreach ($variants as $variant) {
            $isMatch = true;

            // Check Size (if variant has it)
            if (!empty($variant->size)) {
                if (!$size || strtolower(trim($variant->size)) !== strtolower(trim($size))) {
                    $isMatch = false;
                }
            } elseif ($size) {
                // Variant has no size but user selected one
                $isMatch = false;
            }

            if (!$isMatch)
                continue;

            // Check Color
            if (!empty($variant->color)) {
                if (!$color || strtolower(trim($variant->color)) !== strtolower(trim($color))) {
                    $isMatch = false;
                }
            } elseif ($color) {
                $isMatch = false;
            }

            if (!$isMatch)
                continue;

            // Check Purity
            if (!empty($variant->material_purity)) {
                if (!$purity || strtolower(trim($variant->material_purity)) !== strtolower(trim($purity))) {
                    $isMatch = false;
                }
            } elseif ($purity) {
                $isMatch = false;
            }

            if (!$isMatch)
                continue;

            // Check Diamond Quality
            if (!empty($variant->diamond_quality)) {
                if (!$diamondQuality || strtolower(trim($variant->diamond_quality)) !== strtolower(trim($diamondQuality))) {
                    $isMatch = false;
                }
            } elseif ($diamondQuality) {
                $isMatch = false;
            }

            if (!$isMatch)
                continue;

            // Check Shape
            if (!empty($variant->shape)) {
                if (!$shape || strtolower(trim($variant->shape)) !== strtolower(trim($shape))) {
                    $isMatch = false;
                }
            } elseif ($shape) {
                $isMatch = false;
            }

            if ($isMatch) {
                $bestVariant = $variant;
                break; // Found an exact match
            }
        }

        // Fallback to base product selling price if variant not matched perfectly
        $finalPrice = $bestVariant ? $bestVariant->price : $product->selling_price;

        // 2. Proportionally break down the flat variant price according to original base base structures
        $baseGold = (float) $product->price_gold_value ?: 1;
        $baseDiamond = (float) $product->price_diamond_value ?: 0;
        $baseMaking = (float) $product->making_charges ?: 0;

        $baseSubtotal = $baseGold + $baseDiamond + $baseMaking;
        if ($baseSubtotal <= 0)
            $baseSubtotal = 1;

        $goldRatio = $baseGold / $baseSubtotal;
        $diamondRatio = $baseDiamond / $baseSubtotal;
        $makingRatio = $baseMaking / $baseSubtotal;

        $variantSubtotal = (float) $finalPrice;
        $calculatedGst = round($variantSubtotal * 0.03, 2);
        $grandTotal = round($variantSubtotal * 1.03, 2);

        $newGold = round($variantSubtotal * $goldRatio, 2);
        $newDiamond = round($variantSubtotal * $diamondRatio, 2);
        $newMaking = round($variantSubtotal * $makingRatio, 2);

        return response()->json([
            'status' => 'success',
            'data' => [
                'productGoldRate' => $newGold,
                'productDiamondAmount' => $newDiamond,
                'productMakingCharge' => $newMaking,
                'productGSTCharge' => $calculatedGst,
                'productFinalAmountWithGST' => $grandTotal,
                'rawGrandTotal' => $grandTotal
            ]
        ]);
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

        $suggestions = collect();

        // 1. Match category names
        $categories = \App\Models\Category::where('name', 'like', "%{$query}%")
            ->select('name')
            ->take(3)
            ->get()
            ->pluck('name');

        foreach ($categories as $catName) {
            $suggestions->push(['name' => $catName, 'type' => 'category']);
        }

        // 2. Match product names (distinct)
        $products = Product::where('status', 'active')
            ->where('name', 'like', "%{$query}%")
            ->select('name', 'slug')
            ->take(8)
            ->get();

        foreach ($products as $product) {
            if (!$suggestions->contains('name', $product->name)) {
                $suggestions->push(['name' => $product->name, 'slug' => $product->slug, 'type' => 'product']);
            }
        }

        return response()->json($suggestions->take(6)->values());
    }
}
