<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\MetalColor;
use App\Models\Shape;
use App\Models\Size;

class NewArrivalsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Product::with(['category', 'images', 'variants', 'metalColor'])
                ->where('status', 'active')
                ->where('is_new', true);

            // Filter Mapping (Key => Relationship/Column)
            $filters = [
                'category'      => ['relation' => 'category', 'column' => 'name'],
                'metal_color'   => ['relation' => 'metalColor', 'column' => 'name'],
                'diamond_shape' => ['relation' => 'diamondShape', 'column' => 'name'],
                'size'          => ['relation' => 'variants', 'column' => 'size'],
            ];

            foreach ($filters as $key => $config) {
                if ($request->has($key) && is_array($request->input($key))) {
                    $values = $request->input($key);
                    $query->whereHas($config['relation'], fn($q) => $q->whereIn($config['column'], $values));
                }
            }

            // Direct Column Filters
            if ($request->has('gender') && is_array($request->input('gender'))) {
                $query->whereIn('gender', $request->input('gender'));
            }

            if ($request->has('metal_purity') && is_array($request->input('metal_purity'))) {
                $query->whereIn('metal_purity', $request->input('metal_purity'));
            }

            // Weight Range Filter
            if ($request->has('weight') && is_array($request->input('weight'))) {
                $query->where(function ($q) use ($request) {
                    foreach ($request->input('weight') as $range) {
                        $parts = explode('-', $range);
                        if (count($parts) === 2) {
                            $q->orWhereBetween('weight', [(float)$parts[0], (float)$parts[1]]);
                        }
                    }
                });
            }

            // Price Filter (Checkbox takes precedence over Slider)
            if ($request->filled('price')) {
                $ranges = is_array($request->price) ? $request->price : [$request->price];
                $query->where(function ($q) use ($ranges) {
                    foreach ($ranges as $range) {
                        $cleanRange = str_replace(['₹', ',', ' '], '', $range);
                        $parts = explode('-', $cleanRange);
                        if (count($parts) === 2) {
                            $q->orWhereBetween('selling_price', [(int)$parts[0], (int)$parts[1]]);
                        }
                    }
                });
            } elseif ($request->filled('min_price') && $request->filled('max_price')) {
                $min = (int)$request->min_price;
                $max = (int)$request->max_price;
                $max >= 100000 ? $query->where('selling_price', '>=', $min) : $query->whereBetween('selling_price', [$min, $max]);
            }

            // Sorting logic
            $sort = $request->input('sort', 'newest');
            $sortMap = [
                'price_low_high' => ['selling_price', 'asc'],
                'price_high_low' => ['selling_price', 'desc'],
                'popularity'     => ['views', 'desc'],
                'newest'         => ['created_at', 'desc'],
            ];
            $order = $sortMap[$sort] ?? $sortMap['newest'];
            $query->orderBy($order[0], $order[1]);

            $products = $query->paginate(12)->withQueryString();

            // Fetch Filter Options (Consider caching these if needed)
            $filterOptions = [
                'categories'    => Category::pluck('name'),
                'genders'       => Product::distinct()->whereNotNull('gender')->pluck('gender'),
                'metalColors'   => MetalColor::pluck('name'),
                'metalPurities' => Product::distinct()->whereNotNull('metal_purity')->pluck('metal_purity'),
                'sizes'         => Size::where('status', 1)->pluck('number'),
                'weightRanges'  => [
                    '0-2' => '0-2 g',
                    '2-5' => '2-5 g',
                    '5-10' => '5-10 g',
                    '10-20' => '10-20 g',
                    '20-30' => '20-30 g'
                ],
                'shapes'        => Shape::where('status', 1)->pluck('name'),
            ];

            if ($request->ajax()) {
                return view('frontend.pages.partials.products_grid', compact('products'))->render();
            }

            return view('frontend.pages.new-arrivals', array_merge(['products' => $products], $filterOptions));
        } catch (\Exception $e) {
            \Log::error('New Arrivals Error: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all()
            ]);

            if ($request->ajax()) {
                return response()->json(['error' => 'Failed to load products.'], 500);
            }

            return back()->with('error', 'Something went wrong while processing your request.');
        }
    }
}
