<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\MetalColor;
use App\Models\Shape;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class EighteenKTController extends Controller
{
    public function index(Request $request)
    {

        try {

            $query = Product::with(['category', 'images', 'variants', 'metalColor'])
                ->where('status', 'active')
                ->where('metal_purity', '18K');

            // Filter by Category
            $query->when($request->filled('category'), function ($q) use ($request) {
                $categories = is_array($request->category) ? $request->category : [$request->category];
                $q->whereHas('category', function ($subQ) use ($categories) {
                    $subQ->whereIn('name', $categories);
                });
            });

            // Filter by Gender
            $query->when($request->filled('gender'), function ($q) use ($request) {
                $genders = is_array($request->gender) ? $request->gender : [$request->gender];
                $q->whereIn('gender', $genders);
            });

            // Filter by Metal Color
            $query->when($request->filled('metal_color'), function ($q) use ($request) {
                $colors = is_array($request->metal_color) ? $request->metal_color : [$request->metal_color];
                $q->whereHas('metalColor', function ($subQ) use ($colors) {
                    $subQ->whereIn('name', $colors);
                });
            });

            // Filter by Metal Purity
            $query->when($request->filled('metal_purity'), function ($q) use ($request) {
                $purities = is_array($request->metal_purity) ? $request->metal_purity : [$request->metal_purity];
                $q->whereIn('metal_purity', $purities);
            });

            // Filter by Size (using Variants)
            $query->when($request->filled('size'), function ($q) use ($request) {
                $sizes = is_array($request->size) ? $request->size : [$request->size];
                $q->whereHas('variants', function ($subQ) use ($sizes) {
                    $subQ->whereIn('size', $sizes);
                });
            });

            // Filter by Weight
            $query->when($request->filled('weight'), function ($q) use ($request) {
                $weights = is_array($request->weight) ? $request->weight : [$request->weight];
                $q->where(function ($subQ) use ($weights) {
                    foreach ($weights as $weightRange) {
                        $parts = explode('-', $weightRange);
                        if (count($parts) == 2) {
                            $subQ->orWhereBetween('weight', [(float) $parts[0], (float) $parts[1]]);
                        }
                    }
                });
            });

            // Filter by Price
            $query->when($request->filled('price'), function ($q) use ($request) {
                $priceRanges = is_array($request->price) ? $request->price : [$request->price];
                $q->where(function ($subQ) use ($priceRanges) {
                    foreach ($priceRanges as $range) {
                        $rangeClean = str_replace(['₹', ',', ' '], '', $range);
                        $parts = explode('-', $rangeClean);
                        if (count($parts) == 2) {
                            $subQ->orWhereBetween('selling_price', [(int) $parts[0], (int) $parts[1]]);
                        }
                    }
                });
            }, function ($q) use ($request) {
                // Slider logic fallback if price checkboxes are not selected
                if ($request->filled('min_price') && $request->filled('max_price')) {
                    $minPrice = (int) $request->min_price;
                    $maxPrice = (int) $request->max_price;
                    if ($maxPrice >= 100000) {
                        $q->where('selling_price', '>=', $minPrice);
                    } else {
                        $q->whereBetween('selling_price', [$minPrice, $maxPrice]);
                    }
                }
            });

            // Filter by Diamond Shape
            $query->when($request->filled('diamond_shape'), function ($q) use ($request) {
                $shapes = is_array($request->diamond_shape) ? $request->diamond_shape : [$request->diamond_shape];
                $q->whereHas('diamondShape', function ($subQ) use ($shapes) {
                    $subQ->whereIn('name', $shapes);
                });
            });

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

            // Optimized Master Data Fetching (Cached for 60 minutes)
            $filterData = Cache::remember('18kt_filter_data', 60, function () {
                return [
                    'categories' => Category::all(),
                    'genders' => Product::where('status', 'active')->whereNotNull('gender')->distinct()->pluck('gender'),
                    'metalColors' => MetalColor::where('status', 1)->pluck('name'),
                    'metalPurities' => Product::where('status', 'active')->whereNotNull('metal_purity')->distinct()->pluck('metal_purity'),
                    'shapes' => Shape::where('status', 1)->pluck('name'),
                    'sizes' => ProductVariant::whereNotNull('size')
                        ->select('size')
                        ->distinct()
                        ->get()
                        ->pluck('size')
                        ->sort(function ($a, $b) {
                            return (float) $a <=> (float) $b;
                        })
                        ->values(),
                ];
            });

            // Extract variables
            $categories = $filterData['categories'];
            $genders = $filterData['genders'];
            $metalColors = $filterData['metalColors'];
            $metalPurities = $filterData['metalPurities'];
            $shapes = $filterData['shapes'];
            $sizes = $filterData['sizes'];

            // Static weight ranges
            $weightRanges = [
                '0-2' => '0-2 g',
                '2-5' => '2-5 g',
                '5-10' => '5-10 g',
                '10-20' => '10-20 g',
                '20-30' => '20-30 g'
            ];

            if ($request->ajax()) {

                return view('frontend.pages.partials.products_grid', compact('products'))->render();
            }

            return view('frontend.pages.18kt', compact(
                'products',
                'categories',
                'genders',
                'metalColors',
                'metalPurities',
                'sizes',
                'weightRanges',
                'shapes'
            ));
        } catch (\Exception $e) {
            dd($e->getMessage());
            Log::error('Error in EighteenKTController@index: ' . $e->getMessage());

            if ($request->ajax()) {
                return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
            }

            return redirect()->back()->with('error', 'Unable to load products. Please try again later.');
        }
    }
}
