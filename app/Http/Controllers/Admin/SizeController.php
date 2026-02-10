<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::orderBy('sort_order')->latest()->get();
        return view('admin.sizes.index', compact('sizes'));
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

        Size::create($request->all());

        return redirect()->route('admin.sizes.index')
            ->with('success', 'Size created successfully.');
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

        $size->update($request->all());

        return redirect()->route('admin.sizes.index')
            ->with('success', 'Size updated successfully.');
    }

    public function destroy(Size $size)
    {
        $size->delete();

        return redirect()->route('admin.sizes.index')
            ->with('success', 'Size deleted successfully.');
    }

    public function toggleStatus(Size $size)
    {
        $size->status = !$size->status;
        $size->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }
}
