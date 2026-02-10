<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Metal;

class MetalController extends Controller
{
    public function index()
    {
        $metals = Metal::orderBy('sort_order')->latest()->get();
        return view('admin.metals.index', compact('metals'));
    }

    public function create()
    {
        return view('admin.metals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        Metal::create($request->all());

        return redirect()->route('admin.metals.index')
            ->with('success', 'Metal created successfully.');
    }

    public function edit(Metal $metal)
    {
        return view('admin.metals.edit', compact('metal'));
    }

    public function update(Request $request, Metal $metal)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $metal->update($request->all());

        return redirect()->route('admin.metals.index')
            ->with('success', 'Metal updated successfully.');
    }

    public function destroy(Metal $metal)
    {
        $metal->delete();

        return redirect()->route('admin.metals.index')
            ->with('success', 'Metal deleted successfully.');
    }

    public function toggleStatus(Metal $metal)
    {
        $metal->status = !$metal->status;
        $metal->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }
}
