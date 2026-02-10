<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $features = Feature::latest()->get();
            return view('admin.features.index', compact('features'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to load features. ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.features.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Convert checkbox "on" to boolean true
        if ($request->status === 'on') {
            $request->merge(['status' => 1]);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:5120',
            'status' => 'nullable|boolean',
        ]);

        try {
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->boolean('status') ? 1 : 0
            ];

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('features', 'public');
            }

            Feature::create($data);

            return redirect()->route('admin.features.index')
                ->with('success', 'Feature created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create feature. ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feature $feature)
    {
        return view('admin.features.edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feature $feature)
    {
        // Convert checkbox "on" to boolean true
        if ($request->status === 'on') {
            $request->merge(['status' => 1]);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:5120',
            'status' => 'nullable|boolean',
        ]);

        try {
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->boolean('status') ? 1 : 0
            ];

            if ($request->hasFile('image')) {
                // Delete old image
                if ($feature->image && Storage::disk('public')->exists($feature->image)) {
                    Storage::disk('public')->delete($feature->image);
                }
                $data['image'] = $request->file('image')->store('features', 'public');
            }

            $feature->update($data);

            return redirect()->route('admin.features.index')
                ->with('success', 'Feature updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update feature. ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $feature)
    {
        try {
            if ($feature->image) {
                Storage::disk('public')->delete($feature->image);
            }

            $feature->delete();

            return redirect()->route('admin.features.index')
                ->with('success', 'Feature deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete feature. ' . $e->getMessage()]);
        }
    }

    /**
     * Toggle the status of the resource.
     */
    public function toggleStatus(Feature $feature)
    {
        try {
            $feature->status = !$feature->status;
            $feature->save();

            return response()->json([
                'status' => $feature->status,
                'message' => 'Status updated successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update status'], 500);
        }
    }
}
