<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;

class SizeController extends Controller
{
    public function index()
    {
        try {
            $sizes = Size::orderBy('sort_order')->latest()->get();
            return view('admin.sizes.index', compact('sizes'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to load sizes. ' . $e->getMessage()]);
        }
    }

    public function create()
    {
        return view('admin.sizes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|string|max:255',
            'status' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        try {
            Size::create($request->all());

            return redirect()->route('admin.sizes.index')
                ->with('success', 'Size created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create size. ' . $e->getMessage()])->withInput();
        }
    }

    public function edit(Size $size)
    {
        return view('admin.sizes.edit', compact('size'));
    }

    public function update(Request $request, Size $size)
    {
        $request->validate([
            'number' => 'required|string|max:255',
            'status' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        try {
            $size->update($request->all());

            return redirect()->route('admin.sizes.index')
                ->with('success', 'Size updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update size. ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Size $size)
    {
        try {
            $size->delete();

            return redirect()->route('admin.sizes.index')
                ->with('success', 'Size deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete size. ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Size $size)
    {
        try {
            $size->status = !$size->status;
            $size->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update status'], 500);
        }
    }
}
