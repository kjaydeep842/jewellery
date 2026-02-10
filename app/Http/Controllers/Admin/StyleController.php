<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Style;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StyleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $styles = Style::latest()->get();
            return view('admin.styles.index', compact('styles'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to load styles. ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.styles.create');
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
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'status' => 'nullable|boolean',
        ]);

        try {
            $data = [
                'status' => $request->boolean('status') ? 1 : 0
            ];

            if ($request->hasFile('image')) {
                // Save to 'styles' directory in storage/app/public/styles
                $data['image'] = $request->file('image')->store('styles', 'public');
            }

            Style::create($data);

            return redirect()->route('admin.styles.index')
                ->with('success', 'Style created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create style. ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Style $style)
    {
        return view('admin.styles.edit', compact('style'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Style $style)
    {
        // Convert checkbox "on" to boolean true
        if ($request->status === 'on') {
            $request->merge(['status' => 1]);
        }

        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'status' => 'nullable|boolean',
        ]);

        try {
            $data = [
                'status' => $request->boolean('status') ? 1 : 0
            ];

            if ($request->hasFile('image')) {
                // Delete old image
                if ($style->image && Storage::disk('public')->exists($style->image)) {
                    Storage::disk('public')->delete($style->image);
                }
                $data['image'] = $request->file('image')->store('styles', 'public');
            }

            $style->update($data);

            return redirect()->route('admin.styles.index')
                ->with('success', 'Style updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update style. ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Style $style)
    {
        try {
            if ($style->image) {
                Storage::disk('public')->delete($style->image);
            }

            $style->delete();

            return redirect()->route('admin.styles.index')
                ->with('success', 'Style deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete style. ' . $e->getMessage()]);
        }
    }

    /**
     * Toggle the status of the resource.
     */
    public function toggleStatus(Style $style)
    {
        try {
            $style->status = !$style->status;
            $style->save();

            return response()->json([
                'status' => $style->status,
                'message' => 'Status updated successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update status'], 500);
        }
    }
}
