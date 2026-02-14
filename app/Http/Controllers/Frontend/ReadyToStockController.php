<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\MetalColor;
use App\Models\Shape;
use Illuminate\Http\Request;

class ReadyToStockController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'images', 'variants', 'metalColor'])
            ->where('status', 'active');
        // ->where('is_ready_to_stock', true);

        // Filter by Category
        if ($request->filled('category')) {
            $categories = is_array($request->category) ? $request->category : [$request->category];
            $query->whereHas('category', function ($q) use ($categories) {
                $q->whereIn('name', $categories);
            });
        }

        // Filter by Gender
        if ($request->filled('gender')) {
            $genders = is_array($request->gender) ? $request->gender : [$request->gender];
            $query->whereIn('gender', $genders);
        }

        // Filter by Metal Color
        if ($request->filled('metal_color')) {
            $metalColors = is_array($request->metal_color) ? $request->metal_color : [$request->metal_color];
            $query->whereHas('metalColor', function ($q) use ($metalColors) {
                $q->whereIn('name', $metalColors);
            });
        }

        // Filter by Metal Purity
        if ($request->filled('metal_purity')) {
            $metalPurities = is_array($request->metal_purity) ? $request->metal_purity : [$request->metal_purity];
            $query->whereIn('metal_purity', $metalPurities);
        }

        // Filter by Size
        if ($request->filled('size')) {
            $sizes = is_array($request->size) ? $request->size : [$request->size];
            $query->whereHas('variants', function ($q) use ($sizes) {
                $q->whereIn('size', $sizes);
            });
        }

        // Filter by Weight Ranges
        if ($request->filled('weight_range')) {
            $weightRanges = is_array($request->weight_range) ? $request->weight_range : [$request->weight_range];

            $query->where(function ($q) use ($weightRanges) {
                foreach ($weightRanges as $range) {
                    switch ($range) {
                        case '0-2':
                            $q->orWhereBetween('weight', [0, 2]);
                            break;
                        case '2-5':
                            $q->orWhereBetween('weight', [2, 5]);
                            break;
                        case '5-10':
                            $q->orWhereBetween('weight', [5, 10]);
                            break;
                        case '10-20':
                            $q->orWhereBetween('weight', [10, 20]);
                            break;
                        case '20-30':
                            $q->orWhereBetween('weight', [20, 30]);
                            break;
                    }
                }
            });
        }

        // Filter by Price
        if ($request->filled('price')) {
            // Checkbox logic takes precedence
            $priceRanges = is_array($request->price) ? $request->price : [$request->price];

            $query->where(function ($q) use ($priceRanges) {
                foreach ($priceRanges as $range) {
                    switch ($range) {
                        case '₹ 0 - ₹ 10,000':
                            $q->orWhereBetween('price', [0, 10000]);
                            break;
                        case '₹ 10,000 - ₹ 20,000':
                            $q->orWhereBetween('price', [10000, 20000]);
                            break;
                        case '₹ 20,000 - ₹ 30,000':
                            $q->orWhereBetween('price', [20000, 30000]);
                            break;
                        case '₹ 30,000 - ₹ 40,000':
                            $q->orWhereBetween('price', [30000, 40000]);
                            break;
                        case '₹ 40,000 - ₹ 50,000':
                            $q->orWhereBetween('price', [40000, 50000]);
                            break;
                        case '₹ 50,000 - ₹ 100,000':
                            $q->orWhereBetween('price', [50000, 100000]);
                            break;
                    }
                }
            });
        } elseif ($request->filled('min_price') && $request->filled('max_price')) {
            // Slider logic (Effective only if no specific ranges checked)
            $minPrice = (int) $request->min_price;
            $maxPrice = (int) $request->max_price;

            // If max price is at the slider limit (100000), treat it as open-ended or just high
            if ($maxPrice >= 100000) {
                $query->where('price', '>=', $minPrice);
            } else {
                $query->whereBetween('price', [$minPrice, $maxPrice]);
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

        // Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'popularity':
                $query->orderBy('popularity', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
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
        $shapes = Shape::where('status', 1)->pluck('name');

        if ($request->ajax()) {
            return view('frontend.pages.partials.readytostock-grid', compact('products'))->render();
        }

        return view('frontend.pages.readytostock', compact(
            'products',
            'categories',
            'genders',
            'metalColors',
            'metalPurities',
            'sizes',
            'weightRanges',
            'shapes'
        ));
    }
}
