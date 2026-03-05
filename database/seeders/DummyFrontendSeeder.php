<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Shape;
use App\Models\Product;
use App\Models\Style;
use App\Models\Feature;
use App\Models\Review;
use App\Models\User;

class DummyFrontendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Add Banner
        $this->seedBanners();

        // Add Shapes
        $this->seedShapes();

        // Add Categories
        $this->seedCategories();

        // Add Products (Bestseller, 18KT, Launch)
        $this->seedProducts();

        // Add Features
        $this->seedFeatures();

        // Add Styles (Insta style)
        $this->seedStyles();

        // Add Reviews
        $this->seedReviews();

        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    private function copyImage($sourceName, $destinationFolder)
    {
        $sourcePath = public_path('assets/' . $sourceName);
        if (File::exists($sourcePath)) {
            $fileName = uniqid() . '_' . $sourceName;
            $destinationPath = $destinationFolder . '/' . $fileName;
            Storage::disk('public')->put($destinationPath, File::get($sourcePath));
            return $destinationPath;
        }
        return null;
    }

    private function seedBanners()
    {
        Banner::truncate();

        $image = $this->copyImage('banner.png', 'banners');

        Banner::create([
            'title' => 'Timeless Elegance, Modern Soul',
            'desc'  => 'Discover our exclusive collection designed for modern elegance.',
            'image' => $image,
            'type'  => 'home',
            'status' => true,
        ]);
    }

    private function seedShapes()
    {
        Shape::truncate();

        $shapes = [
            'Round' => 'round_shape.png',
            'Princess' => 'princess_shape.png',
            'Emerald' => 'embral.png',
            'Asscher' => 'asscher.png',
            'Marquise' => 'marquies.png',
            'Oval' => 'oval_shape.png',
            'Radiant' => 'radiant.png',
            'Pear' => 'pear.png',
            'Heart' => 'heart.png',
            'Cushion' => 'cushion.png'
        ];

        foreach ($shapes as $name => $imageFile) {
            $imagePath = $this->copyImage($imageFile, 'shapes');
            Shape::create([
                'name' => $name,
                'image' => $imagePath,
                'status' => true,
            ]);
        }
    }

    private function seedCategories()
    {
        Category::truncate();

        $categories = [
            'Rings' => 'category1.png',
            'Pendants' => 'category2.png',
            'Bracelets' => 'category3.png',
            'Earrings' => 'category4.png'
        ];

        foreach ($categories as $name => $imageFile) {
            $imagePath = $this->copyImage($imageFile, 'categories');
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'image' => $imagePath,
            ]);
        }
    }

    private function seedProducts()
    {
        // Don't truncate to not destroy earlier seeders totally, 
        // Just add some fresh ones to match front page.
        $catRings = Category::where('name', 'Rings')->first();
        if (!$catRings) return;

        $products = [
            [
                'name' => '18kt Gold Ring - The Radiant',
                'sku' => '18K-RAD-01',
                'price' => 45000,
                'image' => 'premium_c1.png',
                'is_bestseller' => true,
                'is_featured' => true,
                'description' => 'A stunning radiant cut 18k gold ring.'
            ],
            [
                'name' => '18kt Gold Ring - The Sparkle',
                'sku' => '18K-SPK-02',
                'price' => 52000,
                'image' => 'premium_c2.png',
                'is_bestseller' => true,
                'description' => 'A beautiful sparkling gold ring with intricate design.'
            ],
            [
                'name' => '18kt Gold Ring - The Forever',
                'sku' => '18K-FOR-03',
                'price' => 61000,
                'image' => 'premium_c3.png',
                'is_bestseller' => true,
                'is_featured' => true,
                'description' => 'Timeless forever ring that captures elegance.'
            ],
            [
                'name' => '18kt Gold Ring - The Eternity',
                'sku' => '18K-ETR-04',
                'price' => 74500,
                'image' => 'premium_c4.png',
                'is_featured' => true,
                'description' => 'Eternity band showcasing pure craftsmanship.'
            ],
            [
                'name' => 'Gracious Oval Solitaire',
                'sku' => 'GOS-05',
                'price' => 37657,
                'image' => 'launch_ring.png',
                'is_bestseller' => false,
                'is_featured' => true,
                'description' => 'Gracious Oval Solitaire perfect for engagement.'
            ],
            [
                'name' => 'Timeless Diamond Bracelet',
                'sku' => 'TDB-06',
                'price' => 110000,
                'image' => 'launch_bracelet.png',
                'is_featured' => true,
                'description' => 'Exquisite diamond bracelet for every occasion.'
            ]
        ];

        foreach ($products as $prodInput) {
            $imagePath = $this->copyImage($prodInput['image'], 'products');

            Product::updateOrCreate(
                ['sku' => $prodInput['sku']],
                [
                    'name' => $prodInput['name'],
                    'slug' => Str::slug($prodInput['name']),
                    'category_id' => $catRings->id,
                    'price' => $prodInput['price'],
                    'stock' => 10,
                    'status' => 'active',
                    'image' => $imagePath,
                    'description' => $prodInput['description'],
                    'is_featured' => $prodInput['is_featured'] ?? false,
                    'is_bestseller' => $prodInput['is_bestseller'] ?? false,
                    'metal_type' => 'Gold',
                    'metal_purity' => '18k'
                ]
            );
        }
    }

    private function seedFeatures()
    {
        Feature::truncate();

        $features = [
            ['title' => 'Hallmarked Jewellery', 'image' => 'cer1.png'],
            ['title' => 'Insured Shipping', 'image' => 'cer1.png'],
            ['title' => 'Free Resizing', 'image' => 'cer1.png'],
            ['title' => 'Lifetime Exchange', 'image' => 'cer1.png'],
            ['title' => '100% Refund', 'image' => 'cer1.png'],
        ];

        foreach ($features as $feature) {
            $imagePath = $this->copyImage($feature['image'], 'features');
            Feature::create([
                'title' => $feature['title'],
                'image' => $imagePath,
                'description' => 'We offer the best ' . strtolower($feature['title']) . ' for our customers.',
                'status' => true,
            ]);
        }
    }

    private function seedStyles()
    {
        Style::truncate();

        $styles = ['U1.png', 'U2.png', 'U3.png', 'U4.png', 'Uniq1.png', 'Uniq2.png'];

        foreach ($styles as $styleImg) {
            $imagePath = $this->copyImage($styleImg, 'styles');
            Style::create([
                'image' => $imagePath,
                'status' => true,
            ]);
        }
    }

    private function seedReviews()
    {
        Review::truncate();

        $user = User::firstOrCreate([
            'email' => 'customer@example.com'
        ], [
            'name' => 'Happy Customer',
            'password' => bcrypt('password')
        ]);

        $product = Product::first();
        if (!$product) return;

        Review::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'rating' => 5,
            'comment' => "I am very happy with my purchase. The quality of the diamond is exceptionally beautiful.",
            'is_approved' => true
        ]);

        Review::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'rating' => 4,
            'comment' => "Amazing jewelry, highly recommend it to everyone looking for premium products.",
            'is_approved' => true
        ]);
    }
}
