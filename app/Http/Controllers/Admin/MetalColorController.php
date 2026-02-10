<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MetalColor;

class MetalColorController extends Controller
{
    public function index()
    {
        $metal_colors = MetalColor::orderBy('sort_order')->latest()->get();
        return view('admin.metal_colors.index', compact('metal_colors'));
    }

    public function create()
    {
        return view('admin.metal_colors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'color_code' => 'required|string|max:255',
            'status' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        MetalColor::create($request->all());

        return redirect()->route('admin.metal_colors.index')
            ->with('success', 'Metal Color created successfully.');
    }

    public function edit(MetalColor $metal_color)
    {
        return view('admin.metal_colors.edit', compact('metal_color'));
    }

    public function update(Request $request, MetalColor $metal_color)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'color_code' => 'required|string|max:255',
            'status' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $metal_color->update($request->all());

        return redirect()->route('admin.metal_colors.index')
            ->with('success', 'Metal Color updated successfully.');
    }

    public function destroy(MetalColor $metal_color)
    {
        $metal_color->delete();

        return redirect()->route('admin.metal_colors.index')
            ->with('success', 'Metal Color deleted successfully.');
    }

    public function toggleStatus(MetalColor $metal_color)
    {
        $metal_color->status = !$metal_color->status;
        $metal_color->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }
}
