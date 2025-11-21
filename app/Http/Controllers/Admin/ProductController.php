<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

   public function create()
{
    $categories = Category::all();
    return view('admin.products.create', compact('categories'));
}


    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
           'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'image'       => 'nullable|image|max:2048'
        ]);

        $imagePath = null;

        // Upload Image
        if ($request->hasFile('image')) {
            $imagePath = $request->image->store('products', 'public');
        }

       Product::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $imagePath,
        ]);
                        

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }


    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'image'       => 'nullable|image|max:2048'
        ]);

        $imagePath = $product->image;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image && file_exists(public_path('storage/' . $product->image))) {
                unlink(public_path('storage/' . $product->image));
            }

            $imagePath = $request->image->store('products', 'public');
        }

        $product->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $imagePath,
        ]);

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
