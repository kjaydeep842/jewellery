<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductStone;
use App\Models\Review;
use App\Models\User;

class ProductDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ensure Categories & Subcategories exist
        $catRing = Category::firstOrCreate(['name' => 'Rings'], ['slug' => 'rings']);
        $subEngagement = Subcategory::firstOrCreate(['name' => 'Engagement Rings', 'category_id' => $catRing->id], ['slug' => 'engagement-rings']);

        $catNecklace = Category::firstOrCreate(['name' => 'Necklaces'], ['slug' => 'necklaces']);
        $subPendant = Subcategory::firstOrCreate(['name' => 'Pendants', 'category_id' => $catNecklace->id], ['slug' => 'pendants']);

        // 2. Create a "Gracious Oval Solitaire Diamond Ring" (From Image)
        $ring = Product::updateOrCreate(
            ['slug' => 'gracious-oval-solitaire-diamond-ring'],
            [
                'name' => 'Gracious Oval Solitaire Diamond Ring',
                'category_id' => $catRing->id,
                'subcategory_id' => $subEngagement->id,
                'description' => 'A stunning oval solitaire diamond ring set in 18k Gold. Perfect for your special moment.',
                'price' => 37657.00,
                'making_charges' => 2500.00,
                'tax_rate' => 3.00,
                'metal_type' => 'Gold',
                'metal_purity' => '18k',
                'gender' => 'Women',
                'occasion' => 'Engagement',
                'stock' => 10,
                'status' => 'active',
                'image' => 'products/ring-sample.png' // Placeholder
            ]
        );

        // 3. Add Variants (Resizeable, Color choices)
        // Sizes 6 to 10, Colors: Yellow, White, Rose
        $colors = ['Yellow', 'White', 'Rose'];
        $sizes = ['6', '7', '8', '9', '10'];

        foreach ($colors as $color) {
            foreach ($sizes as $size) {
                ProductVariant::firstOrCreate(
                    [
                        'product_id' => $ring->id,
                        'size' => $size,
                        'color' => $color,
                    ],
                    [
                        'sku' => 'RNG-' . strtoupper(substr($color, 0, 1)) . '-' . $size,
                        'material_purity' => '18k',
                        'diamond_quality' => 'SI-IJ',
                        'price' => 37657.00 + ($size * 100), // Slight price variation by size
                        'stock_quantity' => 5
                    ]
                );
            }
        }

        // 4. Add Stones (Diamond Details)
        ProductStone::firstOrCreate(
            ['product_id' => $ring->id, 'type' => 'Diamond'],
            [
                'shape' => 'Oval',
                'total_count' => 1,
                'total_weight' => 0.50, // 50 cents
                'clarity' => 'SI',
                'color' => 'IJ',
                'setting_type' => 'Prong',
                'stone_price' => 15000.00
            ]
        );

        // 5. Add Reviews
        Review::create([
            'user_id' => 1, // Assuming admin/user ID 1 exists
            'product_id' => $ring->id,
            'rating' => 5,
            'comment' => 'Absolutely stunning ring! My fiancee loves it.',
            'is_approved' => true
        ]);

        Review::create([
            'user_id' => 1,
            'product_id' => $ring->id,
            'rating' => 4,
            'comment' => 'Great quality, but size was slightly loose.',
            'is_approved' => true
        ]);
    }
}
