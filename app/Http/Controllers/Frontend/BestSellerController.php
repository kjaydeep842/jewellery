<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\MetalColor;
use App\Models\Shape;

class BestSellerController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'images', 'variants', 'metalColor'])
            ->where('status', 'active')
            ->where('is_bestseller', true);

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
                        // Parse weight range: "0-2", "2-5", etc.
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
        $shapes = Shape::where('status', 1)->pluck('name');

        if ($request->ajax()) {
            return view('frontend.pages.partials.products_grid', compact('products'))->render();
        }

        return view('frontend.pages.best-seller', compact(
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
