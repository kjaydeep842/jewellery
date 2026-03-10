<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::latest()->paginate(10);
            return view('admin.categories.index', compact('categories'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to load categories. ' . $e->getMessage()]);
        }
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status'      => 'required|in:active,inactive',
        ]);

        try {
            $data = [
                'name'        => $request->name,
                'slug'        => Str::slug($request->name),
                'description' => $request->description,
                'status'      => $request->status,
            ];

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('categories', 'public');
            }

            Category::create($data);

            return redirect()->route('admin.categories.index')
                ->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create category. ' . $e->getMessage()])->withInput();
        }
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status'      => 'required|in:active,inactive',
        ]);

        try {
            $data = [
                'name'        => $request->name,
                'slug'        => Str::slug($request->name),
                'description' => $request->description,
                'status'      => $request->status,
            ];

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('categories', 'public');
            }

            $category->update($data);

            return redirect()->route('admin.categories.index')
                ->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update category. ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();

            return redirect()->route('admin.categories.index')
                ->with('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete category. ' . $e->getMessage()]);
        }
    }
    public function toggleStatus(Category $category)
    {
        try {
            $category->status = $category->status === 'active' ? 'inactive' : 'active';
            $category->save();

            return response()->json(['success' => true, 'status' => $category->status]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
