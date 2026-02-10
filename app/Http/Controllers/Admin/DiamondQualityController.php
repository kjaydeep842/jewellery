<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DiamondQuality;

class DiamondQualityController extends Controller
{
    public function index()
    {
        $diamond_qualities = DiamondQuality::orderBy('sort_order')->latest()->get();
        return view('admin.diamond_qualities.index', compact('diamond_qualities'));
    }

    public function create()
    {
        return view('admin.diamond_qualities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        DiamondQuality::create($request->all());

        return redirect()->route('admin.diamond_qualities.index')
            ->with('success', 'Diamond Quality created successfully.');
    }

    public function edit(DiamondQuality $diamond_quality)
    {
        return view('admin.diamond_qualities.edit', compact('diamond_quality'));
    }

    public function update(Request $request, DiamondQuality $diamond_quality)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $diamond_quality->update($request->all());

        return redirect()->route('admin.diamond_qualities.index')
            ->with('success', 'Diamond Quality updated successfully.');
    }

    public function destroy(DiamondQuality $diamond_quality)
    {
        $diamond_quality->delete();

        return redirect()->route('admin.diamond_qualities.index')
            ->with('success', 'Diamond Quality deleted successfully.');
    }

    public function toggleStatus(DiamondQuality $diamond_quality)
    {
        $diamond_quality->status = !$diamond_quality->status;
        $diamond_quality->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }
}
