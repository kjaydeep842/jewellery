<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Metal;

class MetalController extends Controller
{
    public function index()
    {
        try {
            $metals = Metal::orderBy('sort_order')->latest()->get();
            return view('admin.metals.index', compact('metals'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to load metals. ' . $e->getMessage()]);
        }
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

        try {
            Metal::create($request->all());

            return redirect()->route('admin.metals.index')
                ->with('success', 'Metal created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create metal. ' . $e->getMessage()])->withInput();
        }
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

        try {
            $metal->update($request->all());

            return redirect()->route('admin.metals.index')
                ->with('success', 'Metal updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update metal. ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Metal $metal)
    {
        try {
            $metal->delete();

            return redirect()->route('admin.metals.index')
                ->with('success', 'Metal deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete metal. ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Metal $metal)
    {
        try {
            $metal->status = !$metal->status;
            $metal->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update status'], 500);
        }
    }
}
