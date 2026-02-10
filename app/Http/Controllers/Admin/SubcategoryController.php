<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with('category')->paginate(15);
        return view('admin.subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = [
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('subcategories', 'public');
        }

        Subcategory::create($data);

        return redirect()->route('admin.subcategories.index')
            ->with('success', 'Subcategory created successfully.');
    }

    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all();
        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = [
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('subcategories', 'public');
        }

        $subcategory->update($data);

        return redirect()->route('admin.subcategories.index')
            ->with('success', 'Subcategory updated successfully.');
    }

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();

        return redirect()->route('admin.subcategories.index')
            ->with('success', 'Subcategory deleted successfully.');
    }

    //  AJAX method used by your JS
    public function byCategory(Category $category)
    {
        return response()->json(
            $category->subcategories()->select('id', 'name')->get()
        );
    }
}
