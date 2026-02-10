<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\MetalColor;
use Illuminate\Http\Request;

class TattsvisFavouriteController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'images', 'variants', 'metalColor'])
            ->where('status', 'active')
            ->where('is_featured', true);

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
            $metalColors = $request->input('metal_color');
            if (is_array($metalColors)) {
                $query->whereHas('metalColor', function ($q) use ($metalColors) {
                    $q->whereIn('name', $metalColors);
                });
            }
        }

        // Filter by Metal Purity
        if ($request->has('metal_purity')) {
            $metalPurities = $request->input('metal_purity');
            if (is_array($metalPurities)) {
                $query->whereIn('metal_purity', $metalPurities);
            }
        }

        // Filter by Size
        if ($request->has('size')) {
            $sizes = $request->input('size');
            if (is_array($sizes)) {
                $query->whereHas('variants', function ($q) use ($sizes) {
                    $q->whereIn('size', $sizes);
                });
            }
        }

        // Filter by Weight Ranges
        if ($request->has('weight')) {
            $weightRanges = $request->input('weight');
            if (is_array($weightRanges)) {
                $query->where(function ($q) use ($weightRanges) {
                    foreach ($weightRanges as $range) {
                        [$min, $max] = explode('-', $range);
                        $q->orWhereBetween('weight', [(float) $min, (float) $max]);
                    }
                });
            }
        }

        // Filter by Price
        if ($request->has('price')) {
            $priceRanges = $request->input('price');
            if (is_array($priceRanges)) {
                $query->where(function ($q) use ($priceRanges) {
                    foreach ($priceRanges as $range) {
                        [$min, $max] = explode('-', $range);
                        $q->orWhereBetween('price', [(float) $min, (float) $max]);
                    }
                });
            }
        }

        // Sorting
        if ($request->has('sort')) {
            switch ($request->input('sort')) {
                case 'price_low_high':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high_low':
                    $query->orderBy('price', 'desc');
                    break;
                case 'popularity':
                    $query->orderBy('views', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
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
            return view('frontend.pages.partials.tattsvisfavourite-grid', compact('products'))->render();
        }

        return view('frontend.pages.tattsvisfavourite', compact(
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
