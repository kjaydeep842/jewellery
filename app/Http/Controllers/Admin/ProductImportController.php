<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\Color;
use App\Models\Tag;
use App\Models\MetalColor;
use App\Models\Shape;
use App\Models\Size;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductImportController extends Controller
{
    public function showImportForm()
    {
        return view('admin.products.import');
    }

    public function downloadTemplate()
    {
        $path = storage_path('app/public/product_import_template.xlsx');

        $writer = SimpleExcelWriter::create($path);

        $columns = [
            // Basic
            'name',
            'slug',
            'sku',
            'category_name',
            'subcategory_name',
            'brand_name',
            'unit_name',
            'color_name',
            'tags',
            'price',
            'discount_price',
            'stock',
            'short_description',
            'description',

            // Flags
            'status',
            'is_featured',
            'is_new',
            'is_bestseller',
            'is_ready_to_stock',

            // Media
            'main_image_url',
            'gallery_image_urls',
            'video_url',

            // Specifications
            'material',
            'weight',
            'metal_type',
            'metal_color_name',
            'metal_purity',
            'gender',
            'occasion',
            'making_charges',
            'tax_rate',

            // Diamond Details
            'diamond_type',
            'diamond_shape_name',
            'diamond_color',
            'diamond_clarity',
            'diamond_carat',
            'diamond_count',
            'diamond_weight',
            'diamond_price',

            // Price Breakup
            'price_gold_value',
            'price_diamond_value',
            'price_gst',
            'price_subtotal',
            'price_grand_total',

            // Variants
            'variants',

            // SEO
            'meta_title',
            'meta_description',
            'meta_keywords'
        ];

        $writer->addRow(array_combine($columns, [
            // Basic
            'Diamond Ring 18K',
            'diamond-ring-18k',
            'SKU-001X',
            'Rings',
            'Diamond Rings',
            'Tattsvi',
            'Piece',
            'Gold',
            'Ring,18K,Diamond',
            '50000',
            '45000',
            '10',
            'Beautiful 18K ring',
            'Full HTML description here',

            // Flags
            'active',
            'yes',
            'yes',
            'no',
            'yes',

            // Media
            'https://example.com/main_image.jpg',
            'https://example.com/gal1.jpg,https://example.com/gal2.jpg',
            'https://youtube.com/watch?v=123',

            // Specifications
            'Gold',
            '5.2',
            'Gold',
            'Rose Gold',
            '18KT',
            'Women',
            'Wedding',
            '1500',
            '3',

            // Diamond Details
            'Natural',
            'Round',
            'E-F',
            'VVS',
            '1.5',
            '1',
            '1.5',
            '35000',

            // Price Breakup
            '10000',
            '35000',
            '1350',
            '46500',
            '47850',

            // Variants
            'Size 12:5|Size 14:3',

            // SEO
            'Buy Diamond Ring 18K Online',
            'Best quality diamond ring...',
            'ring,diamond'
        ]));

        return response()->download($path)->deleteFileAfterSend(true);
    }

    public function processImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:10240'
        ]);

        $path = $request->file('file')->getRealPath();

        $stats = [
            'total' => 0,
            'success' => 0,
            'failed' => 0,
            'skipped' => 0
        ];

        $errors = [];

        try {
            $extension = $request->file('file')->getClientOriginalExtension() ?: 'xlsx';
            $reader = SimpleExcelReader::create($path, $extension);

            $reader->getRows()->each(function (array $row) use (&$stats, &$errors) {
                $stats['total']++;

                try {
                    // Check required fields
                    foreach (['name', 'sku', 'price', 'category_name'] as $field) {
                        if (empty($row[$field])) {
                            throw new \Exception("Missing required field: $field");
                        }
                    }

                    // Pivot / Relationships resolution
                    $category = Category::firstOrCreate(
                        ['name' => trim($row['category_name'])],
                        ['slug' => Str::slug($row['category_name'])]
                    );

                    $subcategory_id = null;
                    if (!empty($row['subcategory_name'])) {
                        $subcategory = Subcategory::firstOrCreate(
                            ['name' => trim($row['subcategory_name']), 'category_id' => $category->id],
                            ['slug' => Str::slug($row['subcategory_name'])]
                        );
                        $subcategory_id = $subcategory->id;
                    }

                    $brand_id = null;
                    if (!empty($row['brand_name'])) {
                        $brand = Brand::firstOrCreate(
                            ['name' => trim($row['brand_name'])],
                            ['slug' => Str::slug($row['brand_name']), 'status' => true]
                        );
                        $brand_id = $brand->id;
                    }

                    $unit_id = null;
                    if (!empty($row['unit_name'])) {
                        $unit = Unit::firstOrCreate(['name' => trim($row['unit_name'])], ['status' => true]);
                        $unit_id = $unit->id;
                    }

                    $color_id = null;
                    if (!empty($row['color_name'])) {
                        $color = Color::firstOrCreate(['name' => trim($row['color_name'])], ['status' => true]);
                        $color_id = $color->id;
                    }

                    $metal_color_id = null;
                    if (!empty($row['metal_color_name'])) {
                        $mColor = MetalColor::firstOrCreate(['name' => trim($row['metal_color_name'])], ['status' => true]);
                        $metal_color_id = $mColor->id;
                    }

                    $diamond_shape_id = null;
                    if (!empty($row['diamond_shape_name'])) {
                        $dShape = Shape::firstOrCreate(['name' => trim($row['diamond_shape_name'])], ['status' => true]);
                        $diamond_shape_id = $dShape->id;
                    }

                    // Parsing Boolean Values
                    $parseBool = fn($val) => in_array(strtolower(trim($val ?? '')), ['yes', '1', 'true']);

                    $productData = [
                        'name' => $row['name'],
                        'slug' => !empty($row['slug']) ? Str::slug($row['slug']) : Str::slug($row['name']),
                        'category_id' => $category->id,
                        'subcategory_id' => $subcategory_id,
                        'brand_id' => $brand_id,
                        'unit_id' => $unit_id,
                        'color_id' => $color_id,

                        'price' => (float) $row['price'],
                        'discount_price' => !empty($row['discount_price']) ? (float) $row['discount_price'] : null,
                        'stock' => isset($row['stock']) ? (int) $row['stock'] : 0,
                        'short_description' => $row['short_description'] ?? null,
                        'description' => $row['description'] ?? null,
                        'status' => strtolower(trim($row['status'] ?? 'active')) === 'active' ? 'active' : 'inactive',

                        'is_featured' => $parseBool($row['is_featured'] ?? ''),
                        'is_new' => $parseBool($row['is_new'] ?? ''),
                        'is_bestseller' => $parseBool($row['is_bestseller'] ?? ''),
                        'is_ready_to_stock' => $parseBool($row['is_ready_to_stock'] ?? ''),

                        'video_url' => $row['video_url'] ?? null,

                        'material' => $row['material'] ?? null,
                        'weight' => !empty($row['weight']) ? (float)$row['weight'] : null,
                        'metal_type' => $row['metal_type'] ?? null,
                        'metal_color_id' => $metal_color_id,
                        'metal_purity' => $row['metal_purity'] ?? null,
                        'gender' => $row['gender'] ?? null,
                        'occasion' => $row['occasion'] ?? null,
                        'making_charges' => !empty($row['making_charges']) ? (float)$row['making_charges'] : null,
                        'tax_rate' => !empty($row['tax_rate']) ? (float)$row['tax_rate'] : null,

                        'diamond_type' => $row['diamond_type'] ?? null,
                        'diamond_shape_id' => $diamond_shape_id,
                        'diamond_color' => $row['diamond_color'] ?? null,
                        'diamond_clarity' => $row['diamond_clarity'] ?? null,
                        'diamond_carat' => !empty($row['diamond_carat']) ? (float)$row['diamond_carat'] : null,
                        'diamond_count' => !empty($row['diamond_count']) ? (int)$row['diamond_count'] : null,
                        'diamond_weight' => !empty($row['diamond_weight']) ? (float)$row['diamond_weight'] : null,
                        'diamond_price' => !empty($row['diamond_price']) ? (float)$row['diamond_price'] : null,

                        'price_gold_value' => !empty($row['price_gold_value']) ? (float)$row['price_gold_value'] : null,
                        'price_diamond_value' => !empty($row['price_diamond_value']) ? (float)$row['price_diamond_value'] : null,
                        'price_gst' => !empty($row['price_gst']) ? (float)$row['price_gst'] : null,
                        'price_subtotal' => !empty($row['price_subtotal']) ? (float)$row['price_subtotal'] : null,
                        'price_grand_total' => !empty($row['price_grand_total']) ? (float)$row['price_grand_total'] : null,

                        'meta_title' => $row['meta_title'] ?? null,
                        'meta_description' => $row['meta_description'] ?? null,
                        'meta_keywords' => $row['meta_keywords'] ?? null,
                    ];

                    $product = Product::updateOrCreate(
                        ['sku' => $row['sku']],
                        $productData
                    );

                    // Tags
                    if (!empty($row['tags'])) {
                        $tagNames = array_map('trim', explode(',', $row['tags']));
                        $tagIds = [];
                        foreach ($tagNames as $tName) {
                            if (!empty($tName)) {
                                $tag = Tag::firstOrCreate(['name' => $tName], ['slug' => Str::slug($tName), 'status' => 'active']);
                                $tagIds[] = $tag->id;
                            }
                        }
                        $product->tags()->sync($tagIds);
                    } else {
                        $product->tags()->detach();
                    }

                    // Variants
                    if (!empty($row['variants'])) {
                        $varStrings = array_map('trim', explode('|', $row['variants']));
                        $processedSizes = [];
                        ProductVariant::where('product_id', $product->id)->delete();
                        foreach ($varStrings as $varString) {
                            $parts = explode(':', $varString);
                            $sizeName = trim($parts[0] ?? '');
                            $stock = (int) trim($parts[1] ?? '0');

                            if (!empty($sizeName) && !in_array($sizeName, $processedSizes)) {
                                Size::firstOrCreate(['number' => $sizeName], ['sort_order' => 0, 'status' => true]);
                                $processedSizes[] = $sizeName;
                                ProductVariant::create([
                                    'product_id' => $product->id,
                                    'size' => $sizeName,
                                    'stock_quantity' => $stock,
                                    'sku' => $product->sku . '-' . Str::slug($sizeName),
                                    'price' => $product->price,
                                ]);
                            }
                        }
                    }

                    // Image Handling
                    if (!empty($row['main_image_url'])) {
                        try {
                            $fileContents = @file_get_contents($row['main_image_url']);
                            if ($fileContents) {
                                $manager = new ImageManager(new Driver());
                                $img = $manager->read($fileContents);
                                $encoded = $img->toJpeg(80);

                                $filename = 'products/' . uniqid() . '.jpg';
                                Storage::disk('public')->put($filename, $encoded->toString());

                                if ($product->image && Storage::disk('public')->exists($product->image)) {
                                    Storage::disk('public')->delete($product->image);
                                }
                                $product->update(['image' => $filename]);
                            }
                        } catch (\Exception $imgEx) {
                            Log::error("Failed to process main_image_url for SKU {$row['sku']} : " . $imgEx->getMessage());
                        }
                    }

                    // Gallery Images
                    if (!empty($row['gallery_image_urls'])) {
                        $urls = array_map('trim', explode(',', $row['gallery_image_urls']));

                        // Clear out existing gallery images if updating
                        $existingImages = ProductImage::where('product_id', $product->id)->get();
                        foreach ($existingImages as $existingImg) {
                            if (Storage::disk('public')->exists($existingImg->image_path)) {
                                Storage::disk('public')->delete($existingImg->image_path);
                            }
                            $existingImg->delete();
                        }

                        foreach ($urls as $url) {
                            if (!empty($url)) {
                                try {
                                    $fileContents = @file_get_contents($url);
                                    if ($fileContents) {
                                        $manager = new ImageManager(new Driver());
                                        $img = $manager->read($fileContents);
                                        $encoded = $img->toJpeg(80);

                                        $filename = 'products/gallery/' . uniqid() . '.jpg';
                                        Storage::disk('public')->put($filename, $encoded->toString());

                                        ProductImage::create([
                                            'product_id' => $product->id,
                                            'image_path' => $filename,
                                        ]);
                                    }
                                } catch (\Exception $imgEx) {
                                    Log::error("Gallery image failed for {$url} (SKU {$row['sku']}): " . $imgEx->getMessage());
                                }
                            }
                        }
                    }

                    $stats['success']++;
                } catch (\Exception $e) {
                    $stats['failed']++;
                    $errors[] = "Row {$stats['total']} (SKU: " . ($row['sku'] ?? 'N/A') . ") failed: " . $e->getMessage();
                }
            });

            return redirect()->route('admin.products.index')
                ->with('import_stats', $stats)
                ->with('import_errors', $errors);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to process file: ' . $e->getMessage()]);
        }
    }
}
