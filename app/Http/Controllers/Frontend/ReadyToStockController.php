<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\MetalColor;
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

        // Filter by Price Range
        if ($request->filled('price_range')) {
            $priceRanges = is_array($request->price_range) ? $request->price_range : [$request->price_range];

            $query->where(function ($q) use ($priceRanges) {
                foreach ($priceRanges as $range) {
                    switch ($range) {
                        case '10000-20000':
                            $q->orWhereBetween('price', [10000, 20000]);
                            break;
                        case '20000-40000':
                            $q->orWhereBetween('price', [20000, 40000]);
                            break;
                        case '40000-60000':
                            $q->orWhereBetween('price', [40000, 60000]);
                            break;
                        case '60000-80000':
                            $q->orWhereBetween('price', [60000, 80000]);
                            break;
                    }
                }
            });
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
            'weightRanges'
        ));
    }
}
