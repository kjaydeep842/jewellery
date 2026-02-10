<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MetalColor;

class MetalColorController extends Controller
{
    public function index()
    {
        try {
            $metal_colors = MetalColor::orderBy('sort_order')->latest()->get();
            return view('admin.metal_colors.index', compact('metal_colors'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to load metal colors. ' . $e->getMessage()]);
        }
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

        try {
            MetalColor::create($request->all());

            return redirect()->route('admin.metal_colors.index')
                ->with('success', 'Metal Color created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create metal color. ' . $e->getMessage()])->withInput();
        }
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

        try {
            $metal_color->update($request->all());

            return redirect()->route('admin.metal_colors.index')
                ->with('success', 'Metal Color updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update metal color. ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(MetalColor $metal_color)
    {
        try {
            $metal_color->delete();

            return redirect()->route('admin.metal_colors.index')
                ->with('success', 'Metal Color deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete metal color. ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(MetalColor $metal_color)
    {
        try {
            $metal_color->status = !$metal_color->status;
            $metal_color->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update status'], 500);
        }
    }
}
