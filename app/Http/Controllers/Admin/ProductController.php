<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Subcategory;
use App\Models\Tag;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Review;

// Masters
use App\Models\Metal;
use App\Models\MetalColor;
use App\Models\Shape;
use App\Models\DiamondQuality;
use App\Models\Size;

use App\Models\Brand;
use App\Models\Unit;
use App\Models\Color;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::with(['variants', 'category', 'brand'])->withCount('reviews')->latest()->paginate(10);
            return view('admin.products.index', compact('products'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to load products. ' . $e->getMessage()]);
        }
    }

    public function create()
    {
        return view('admin.products.create', [
            'categories' => Category::all(),
            'subcategories' => Subcategory::all(),
            'brands' => Brand::where('status', true)->get(),
            'units' => Unit::where('status', true)->get(),
            'colors' => Color::where('status', true)->get(), // Generic colors
            'tags' => Tag::all(),
            'metals' => Metal::where('status', true)->get(),
            'metalColors' => MetalColor::where('status', true)->get(),
            'shapes' => Shape::where('status', true)->get(),
            'diamondQualities' => DiamondQuality::where('status', true)->get(),
            'sizes' => Size::orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:products,slug',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:10240', // 10MB
            'video_url' => 'nullable|url',
            'brand_id' => 'nullable|exists:brands,id',
            'unit_id' => 'nullable|exists:units,id',
            'color_id' => 'nullable|exists:colors,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $data = $request->except(['tags', 'images', 'variants', 'image', 'remove_images']);

            // Booleans
            $data['is_featured'] = $request->boolean('is_featured');
            $data['is_new'] = $request->boolean('is_new');
            $data['is_bestseller'] = $request->boolean('is_bestseller');
            $data['is_ready_to_stock'] = $request->boolean('is_ready_to_stock');

            // Slug
            if (empty($data['slug'])) {
                $data['slug'] = Str::slug($data['name']);
            }
            // Ensure unique slug
            $slug = $data['slug'];
            $count = 1;
            while (Product::where('slug', $slug)->exists()) {
                $slug = $data['slug'] . '-' . $count++;
            }
            $data['slug'] = $slug;

            // SKU
            if (empty($data['sku'])) {
                $data['sku'] = 'SKU-' . strtoupper(Str::random(8));
            }
            // Ensure unique SKU
            while (Product::where('sku', $data['sku'])->exists()) {
                $data['sku'] = 'SKU-' . strtoupper(Str::random(8));
            }


            // Create Product
            $product = Product::create($data);

            // Tags
            if ($request->filled('tags')) {
                $product->tags()->sync($request->tags);
            }

            // Initialize ImageKit
            $imageKit = new \ImageKit\ImageKit(
                env('IMAGEKIT_PUBLIC_KEY', 'public_S27pY9bOfwZ6hIzvL7PeLV31E/g='),
                env('IMAGEKIT_PRIVATE_KEY', 'private_WoGKR8PLIbT9fTWa+mk1Bt/dpkk='),
                env('IMAGEKIT_URL_ENDPOINT', 'https://ik.imagekit.io/qfu5tz9sf')
            );

            // Main Image
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $upload = $imageKit->uploadFile([
                    'file' => fopen($file->getRealPath(), 'r'),
                    'fileName' => $file->getClientOriginalName(),
                    'folder' => 'main'
                ]);
                if (empty($upload->error) && !empty($upload->result)) {
                    $data['image'] = $upload->result->url;
                } else {
                    $errorMsg = is_string($upload->error) ? $upload->error : (isset($upload->error->message) ? $upload->error->message : 'Unknown error');
                    throw new \Exception('Main Image Upload Failed: ' . $errorMsg);
                }
            }
            // Gallery Images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $upload = $imageKit->uploadFile([
                        'file' => fopen($file->getRealPath(), 'r'),
                        'fileName' => $file->getClientOriginalName(),
                        'folder' => 'gallery'
                    ]);
                    if (empty($upload->error) && !empty($upload->result)) {
                        ProductImage::create([
                            'product_id' => $product->id,
                            'image_path' => $upload->result->url,
                        ]);
                    } else {
                        $errorMsg = is_string($upload->error) ? $upload->error : (isset($upload->error->message) ? $upload->error->message : 'Unknown error');
                        throw new \Exception('Gallery Image Upload Failed: ' . $errorMsg);
                    }
                }
            }

            // Variants (Combinations)
            if ($request->filled('variants')) {
                $processedVariants = [];
                foreach ($request->variants as $variant) {
                    $signature = ($variant['size'] ?? '') . '-' . ($variant['color'] ?? '') . '-' . ($variant['material_purity'] ?? '') . '-' . ($variant['diamond_quality'] ?? '') . '-' . ($variant['shape'] ?? '');

                    if (!empty($variant['price']) && !in_array($signature, $processedVariants)) {
                        $processedVariants[] = $signature;
                        ProductVariant::create([
                            'product_id' => $product->id,
                            'size' => $variant['size'] ?? null,
                            'color' => $variant['color'] ?? null,
                            'material_purity' => $variant['material_purity'] ?? null,
                            'diamond_quality' => $variant['diamond_quality'] ?? null,
                            'shape' => $variant['shape'] ?? null,
                            'stock_quantity' => $variant['stock'] ?? 0,
                            'sku' => $product->sku . '-' . Str::slug($signature),
                            'price' => $variant['price'],
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Failed to create product: ' . $e->getMessage()]);
        }
    }

    public function edit(Product $product)
    {
        $product->load(['tags', 'images', 'variants']);

        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::all(),
            'subcategories' => Subcategory::all(),
            'brands' => Brand::where('status', true)->get(),
            'units' => Unit::where('status', true)->get(),
            'colors' => Color::where('status', true)->get(), // Generic colors
            'tags' => Tag::all(),
            'metals' => Metal::where('status', true)->get(),
            'metalColors' => MetalColor::where('status', true)->get(),
            'shapes' => Shape::where('status', true)->get(),
            'diamondQualities' => DiamondQuality::where('status', true)->get(),
            'sizes' => Size::orderBy('sort_order')->get(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:products,slug,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:10240',
            'video_url' => 'nullable|url',
        ]);

        try {
            \Illuminate\Support\Facades\DB::beginTransaction();

            $data = $request->except(['tags', 'images', 'variants', 'image', 'remove_images']);

            // Booleans
            $data['is_featured'] = $request->boolean('is_featured');
            $data['is_new'] = $request->boolean('is_new');
            $data['is_bestseller'] = $request->boolean('is_bestseller');
            $data['is_ready_to_stock'] = $request->boolean('is_ready_to_stock');

            // Slug
            if (empty($data['slug'])) {
                $data['slug'] = Str::slug($data['name']);
            }
            if ($data['slug'] !== $product->slug) {
                $slug = $data['slug'];
                $count = 1;
                while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                    $slug = $data['slug'] . '-' . $count++;
                }
                $data['slug'] = $slug;
            }

            // SKU Generation if missing
            if (empty($product->sku) && empty($data['sku'])) {
                $data['sku'] = 'SKU-' . strtoupper(Str::random(8));
                while (Product::where('sku', $data['sku'])->where('id', '!=', $product->id)->exists()) {
                    $data['sku'] = 'SKU-' . strtoupper(Str::random(8));
                }
            }

            // Initialize ImageKit
            $imageKit = new \ImageKit\ImageKit(
                env('IMAGEKIT_PUBLIC_KEY', 'public_S27pY9bOfwZ6hIzvL7PeLV31E/g='),
                env('IMAGEKIT_PRIVATE_KEY', 'private_WoGKR8PLIbT9fTWa+mk1Bt/dpkk='),
                env('IMAGEKIT_URL_ENDPOINT', 'https://ik.imagekit.io/qfu5tz9sf')
            );

            // Main Image
            if ($request->hasFile('image')) {
                if ($product->image && !filter_var($product->image, FILTER_VALIDATE_URL) && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }
                $file = $request->file('image');
                $upload = $imageKit->uploadFile([
                    'file' => fopen($file->getRealPath(), 'r'),
                    'fileName' => $file->getClientOriginalName(),
                    'folder' => 'main'
                ]);
                if (empty($upload->error) && !empty($upload->result)) {
                    $data['image'] = $upload->result->url;
                } else {
                    $errorMsg = is_string($upload->error) ? $upload->error : (isset($upload->error->message) ? $upload->error->message : 'Unknown error');
                    throw new \Exception('Main Image Upload Failed: ' . $errorMsg);
                }
            }

            $product->update($data);

            // Tags
            if ($request->filled('tags')) {
                $product->tags()->sync($request->tags);
            } else {
                $product->tags()->detach();
            }

            // Gallery Images Add
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $upload = $imageKit->uploadFile([
                        'file' => fopen($file->getRealPath(), 'r'),
                        'fileName' => $file->getClientOriginalName(),
                        'folder' => 'gallery'
                    ]);
                    if (empty($upload->error) && !empty($upload->result)) {
                        ProductImage::create([
                            'product_id' => $product->id,
                            'image_path' => $upload->result->url,
                        ]);
                    } else {
                        $errorMsg = is_string($upload->error) ? $upload->error : (isset($upload->error->message) ? $upload->error->message : 'Unknown error');
                        throw new \Exception('Gallery Image Upload Failed: ' . $errorMsg);
                    }
                }
            }

            // Gallery Images Remove
            if ($request->filled('remove_images')) {
                $idsToRemove = $request->input('remove_images');
                $images = ProductImage::whereIn('id', $idsToRemove)->where('product_id', $product->id)->get();
                foreach ($images as $img) {
                    if (!filter_var($img->image_path, FILTER_VALIDATE_URL) && Storage::disk('public')->exists($img->image_path)) {
                        Storage::disk('public')->delete($img->image_path);
                    }
                    $img->delete();
                }
            }

            // Variants Sync
            ProductVariant::where('product_id', $product->id)->delete();
            if ($request->filled('variants')) {
                $processedVariants = [];
                foreach ($request->variants as $variant) {
                    $signature = ($variant['size'] ?? '') . '-' . ($variant['color'] ?? '') . '-' . ($variant['material_purity'] ?? '') . '-' . ($variant['diamond_quality'] ?? '') . '-' . ($variant['shape'] ?? '');

                    if (!empty($variant['price']) && !in_array($signature, $processedVariants)) {
                        $processedVariants[] = $signature;
                        ProductVariant::create([
                            'product_id' => $product->id,
                            'size' => $variant['size'] ?? null,
                            'color' => $variant['color'] ?? null,
                            'material_purity' => $variant['material_purity'] ?? null,
                            'diamond_quality' => $variant['diamond_quality'] ?? null,
                            'shape' => $variant['shape'] ?? null,
                            'stock_quantity' => $variant['stock'] ?? 0,
                            'sku' => $product->sku . '-' . Str::slug($signature),
                            'price' => $variant['price'],
                        ]);
                    }
                }
            }

            \Illuminate\Support\Facades\DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Failed to update product: ' . $e->getMessage()]);
        }
    }

    public function destroy(Product $product)
    {
        try {
            if ($product->image && !filter_var($product->image, FILTER_VALIDATE_URL) && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $product->delete();

            return redirect()->route('admin.products.index')
                ->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete product. ' . $e->getMessage()]);
        }
    }
}
