<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SubcategoryController extends Controller
{
    public function index()
    {
        try {
            $subcategories = Subcategory::with('category')->paginate(15);
            return view('admin.subcategories.index', compact('subcategories'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to load subcategories. ' . $e->getMessage()]);
        }
    }

    public function create()
    {
        return view('admin.subcategories.create', [
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        try {
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
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create subcategory. ' . $e->getMessage()])->withInput();
        }
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
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        try {
            $data = [
                'category_id' => $request->category_id,
                'name'        => $request->name,
                'slug'        => Str::slug($request->name),
            ];

            if ($request->hasFile('image')) {
                if ($subcategory->image && Storage::disk('public')->exists($subcategory->image)) {
                    Storage::disk('public')->delete($subcategory->image);
                }
                $data['image'] = $request->file('image')->store('subcategories', 'public');
            }

            $subcategory->update($data);

            return redirect()->route('admin.subcategories.index')
                ->with('success', 'Subcategory updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update subcategory. ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Subcategory $subcategory)
    {
        try {
            $subcategory->delete();

            return redirect()->route('admin.subcategories.index')
                ->with('success', 'Subcategory deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete subcategory. ' . $e->getMessage()]);
        }
    }

    //  AJAX method used by your JS
    public function byCategory(Category $category)
    {
        try {
            return response()->json(
                $category->subcategories()->select('id', 'name')->get()
            );
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to load subcategories'], 500);
        }
    }
}
