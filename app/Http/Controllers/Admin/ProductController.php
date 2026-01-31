<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Subcategory;
use App\Models\ProductImage;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('tags')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $subcategories = Subcategory::all();

        return view('admin.products.create', compact('categories', 'tags', 'subcategories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'images.*' => 'image|max:4096',
            'making_charges' => 'nullable|numeric|min:0',
            'tax_rate' => 'nullable|numeric|min:0',
            'metal_type' => 'nullable|string',
            'metal_purity' => 'nullable|string',
            'gender' => 'nullable|string',
            'occasion' => 'nullable|string',
            'variants' => 'nullable|array',
            'stones' => 'nullable|array',
        ]);

        try {
            \Illuminate\Support\Facades\DB::beginTransaction();

            $data = $request->only([
                'name',
                'category_id',
                'subcategory_id',
                'description',
                'price',
                'making_charges',
                'tax_rate',
                'metal_type',
                'metal_purity',
                'gender',
                'occasion'
            ]);
            $data['slug'] = Str::slug($request->name);
            // Fallback if slug exists logic can be added here

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('products', 'public');
            }

            $product = Product::create($data);

            if ($request->filled('tags')) {
                $product->tags()->sync($request->tags);
            }

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $path = $file->store('products/gallery', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $path,
                    ]);
                }
            }

            if ($request->filled('variants')) {
                foreach ($request->variants as $variant) {
                    if (!empty($variant['sku'])) {
                        $product->variants()->create($variant);
                    }
                }
            }

            if ($request->filled('stones')) {
                foreach ($request->stones as $stone) {
                    $product->stones()->create($stone);
                }
            }

            \Illuminate\Support\Facades\DB::commit();

            return redirect()->route('admin.products.index')
                ->with('success', 'Product created successfully.');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Error creating product: ' . $e->getMessage());
        }
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $tags = Tag::all();

        // Load subcategories for the current category
        $subcategories = Subcategory::all(); // Load ALL for JS filtering, or fetch specific? 
        // Better: Load all subcategories so JS can filter cleanly on Edit too without AJAX call

        $product->load('tags', 'images', 'variants', 'stones');

        return view('admin.products.edit', compact(
            'product',
            'categories',
            'subcategories',
            'tags'
        ));
    }


    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'images.*' => 'image|max:4096',
            'making_charges' => 'nullable|numeric|min:0',
            'tax_rate' => 'nullable|numeric|min:0',
            'metal_type' => 'nullable|string',
            'variants' => 'nullable|array',
            'stones' => 'nullable|array',
        ]);

        try {
            \Illuminate\Support\Facades\DB::beginTransaction();

            $data = $request->only([
                'name',
                'category_id',
                'subcategory_id',
                'description',
                'price',
                'making_charges',
                'tax_rate',
                'metal_type',
                'metal_purity',
                'gender',
                'occasion'
            ]);
            $data['slug'] = Str::slug($request->name);

            if ($request->hasFile('image')) {
                if ($product->image && file_exists(public_path('storage/' . $product->image))) {
                    unlink(public_path('storage/' . $product->image));
                }
                $data['image'] = $request->file('image')->store('products', 'public');
            } else {
                $data['image'] = $product->image;
            }

            $product->update($data);

            if ($request->filled('tags')) {
                $product->tags()->sync($request->tags);
            } else {
                $product->tags()->sync([]);
            }

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $path = $file->store('products/gallery', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $path,
                    ]);
                }
            }

            // Sync Variants: Delete All -> Recreate (Simple, clean)
            $product->variants()->delete();
            if ($request->filled('variants')) {
                foreach ($request->variants as $variant) {
                    if (!empty($variant['sku'])) {
                        $product->variants()->create($variant);
                    }
                }
            }

            // Sync Stones
            $product->stones()->delete();
            if ($request->filled('stones')) {
                foreach ($request->stones as $stone) {
                    $product->stones()->create($stone);
                }
            }

            \Illuminate\Support\Facades\DB::commit();

            return redirect()->route('admin.products.index')
                ->with('success', 'Product updated successfully.');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Error updating product: ' . $e->getMessage());
        }
    }



    public function destroy(Product $product)
    {
        if ($product->image && file_exists(public_path('storage/' . $product->image))) {
            unlink(public_path('storage/' . $product->image));
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
