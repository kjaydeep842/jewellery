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
            \Illuminate\Support\Facades\DB::beginTransaction();

            $data = $request->except(['tags', 'images', 'variants', 'image', 'remove_images']);

            // Booleans
            $data['is_featured'] = $request->boolean('is_featured');
            $data['is_new'] = $request->boolean('is_new');
            $data['is_bestseller'] = $request->boolean('is_bestseller');

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

            // Main Image
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('products', 'public');
            }

            // Create Product
            $product = Product::create($data);

            // Tags
            if ($request->filled('tags')) {
                $product->tags()->sync($request->tags);
            }

            // Gallery Images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $path = $file->store('products/gallery', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $path,
                    ]);
                }
            }

            // Variants (Sizes)
            if ($request->filled('variants')) {
                foreach ($request->variants as $variant) {
                    if (!empty($variant['size'])) {
                        ProductVariant::create([
                            'product_id' => $product->id,
                            'size' => $variant['size'],
                            'stock_quantity' => $variant['stock'] ?? 0,
                            'sku' => $product->sku . '-' . Str::slug($variant['size']),
                            'price' => $product->price,
                        ]);
                    }
                }
            }

            \Illuminate\Support\Facades\DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
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

            // Main Image
            if ($request->hasFile('image')) {
                if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }
                $data['image'] = $request->file('image')->store('products', 'public');
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
                    $path = $file->store('products/gallery', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $path,
                    ]);
                }
            }

            // Gallery Images Remove
            if ($request->filled('remove_images')) {
                $idsToRemove = $request->input('remove_images');
                $images = ProductImage::whereIn('id', $idsToRemove)->where('product_id', $product->id)->get();
                foreach ($images as $img) {
                    if (Storage::disk('public')->exists($img->image_path)) {
                        Storage::disk('public')->delete($img->image_path);
                    }
                    $img->delete();
                }
            }

            // Variants Sync
            ProductVariant::where('product_id', $product->id)->delete();
            if ($request->filled('variants')) {
                foreach ($request->variants as $variant) {
                    if (!empty($variant['size'])) {
                        ProductVariant::create([
                            'product_id' => $product->id,
                            'size' => $variant['size'],
                            'stock_quantity' => $variant['stock'] ?? 0,
                            'sku' => $product->sku . '-' . Str::slug($variant['size']),
                            'price' => $product->price,
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
            if ($product->image && Storage::disk('public')->exists($product->image)) {
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
