<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\MetalColor;

class NewArrivalsController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'images', 'variants', 'metalColor'])
            ->where('status', 'active')
            ->where('is_new', true);

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
        if ($request->has('price')) {
            $prices = $request->input('price');
            if (is_array($prices)) {
                $query->where(function ($q) use ($prices) {
                    foreach ($prices as $priceRange) {
                        // Clean string: "₹10,000 - ₹20,000" -> "10000-20000"
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
            return view('frontend.pages.partials.products-grid', compact('products'))->render();
        }

        return view('frontend.pages.new-arrivals', compact(
            'products',
            'categories',
            'genders',
            'metalColors',
            'metalPurities',
            'sizes',
            'weightRanges'
        ));
    }
}
