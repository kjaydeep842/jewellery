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
    $categories    = Category::all();
    $tags          = Tag::all();
    $subcategories = Subcategory::all(); 

    return view('admin.products.create', compact('categories', 'tags', 'subcategories'));
}


  public function store(Request $request)
{
    $request->validate([
        'name'           => 'required|string|max:255',
        'category_id'    => 'required|exists:categories,id',
        'subcategory_id' => 'nullable|exists:subcategories,id',
        'description'    => 'nullable|string',
        'price'          => 'required|numeric|min:0',
        'image'          => 'nullable|image|max:2048',
        'tags'           => 'array',
        'tags.*'         => 'exists:tags,id',
        'images.*'       => 'image|max:4096',
    ]);

    $data = $request->only([
        'name','category_id','subcategory_id','description','price'
    ]);
    $data['slug'] = Str::slug($request->name);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('products', 'public');
    }

    $product = Product::create($data);

    // sync tags
    if ($request->filled('tags')) {
        $product->tags()->sync($request->tags);
    }

    // multiple images
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $file) {
            $path = $file->store('products/gallery', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
            ]);
        }
    }

    return redirect()->route('admin.products.index')
        ->with('success', 'Product created.');
}

 public function edit(Product $product)
{
    $categories = Category::all();
    $tags       = Tag::all();

    // Load subcategories for the current category
    $subcategories = Subcategory::where('category_id', $product->category_id)->get();

    // Load relations (tags, images if you use them in view)
    $product->load('tags', 'images');

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
        'name'           => 'required|string|max:255',
        'category_id'    => 'required|exists:categories,id',
        'subcategory_id' => 'nullable|exists:subcategories,id',
        'description'    => 'nullable|string',
        'price'          => 'required|numeric|min:0',
        'image'          => 'nullable|image|max:2048',
        'tags'           => 'array',
        'tags.*'         => 'exists:tags,id',
        'images.*'       => 'image|max:4096',
    ]);

    $data = $request->only([
        'name','category_id','subcategory_id','description','price'
    ]);
    $data['slug'] = Str::slug($request->name);

    // Main image
    if ($request->hasFile('image')) {
        // Delete old image
        if ($product->image && file_exists(public_path('storage/' . $product->image))) {
            unlink(public_path('storage/' . $product->image));
        }
        $data['image'] = $request->file('image')->store('products', 'public');
    } else {
        $data['image'] = $product->image; // keep existing image
    }

    // Update product
    $product->update($data);

    // Sync tags
    if ($request->filled('tags')) {
        $product->tags()->sync($request->tags);
    } else {
        $product->tags()->sync([]); // remove all tags if none selected
    }

    // Multiple images
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $file) {
            $path = $file->store('products/gallery', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
            ]);
        }
    }

    return redirect()->route('admin.products.index')
                     ->with('success', 'Product updated successfully.');
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
