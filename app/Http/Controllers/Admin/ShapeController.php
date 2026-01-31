<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shape;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShapeController extends Controller
{
    public function index()
    {
        $shapes = Shape::latest()->get();
        return view('admin.shapes.index', compact('shapes'));
    }

    public function create()
    {
        return view('admin.shapes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'status' => 'nullable|boolean',
        ]);

        $data = $request->only(['name']);
        $data['status'] = $request->boolean('status');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('shapes', 'public');
        }

        Shape::create($data);

        return redirect()->route('admin.shapes.index')->with('success', 'Shape created successfully.');
    }

    public function edit(Shape $shape)
    {
        return view('admin.shapes.edit', compact('shape'));
    }

    public function update(Request $request, Shape $shape)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'status' => 'nullable|boolean',
        ]);

        $data = $request->only(['name']);
        $data['status'] = $request->boolean('status');

        if ($request->hasFile('image')) {
            if ($shape->image) {
                Storage::disk('public')->delete($shape->image);
            }
            $data['image'] = $request->file('image')->store('shapes', 'public');
        }

        $shape->update($data);

        return redirect()->route('admin.shapes.index')->with('success', 'Shape updated successfully.');
    }

    public function destroy(Shape $shape)
    {
        if ($shape->image) {
            Storage::disk('public')->delete($shape->image);
        }
        $shape->delete();

        return redirect()->route('admin.shapes.index')->with('success', 'Shape deleted successfully.');
    }
}
