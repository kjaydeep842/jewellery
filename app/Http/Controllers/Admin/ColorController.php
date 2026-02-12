<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Exception;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $colors = Color::latest()->paginate(10);
            return view('admin.colors.index', compact('colors'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load colors: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('admin.colors.create');
        } catch (Exception $e) {
            return redirect()->route('admin.colors.index')->with('error', 'Failed to load create form: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:colors',
                'code' => 'nullable|string|max:50',
                'status' => 'boolean',
            ]);

            $data = $request->only(['name', 'code']);
            $data['status'] = $request->boolean('status', true);

            Color::create($data);

            return redirect()->route('admin.colors.index')->with('success', 'Color created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to create color: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Color $color)
    {
        try {
            return view('admin.colors.edit', compact('color'));
        } catch (Exception $e) {
            return redirect()->route('admin.colors.index')->with('error', 'Failed to load edit form: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Color $color)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:colors,name,' . $color->id,
                'code' => 'nullable|string|max:50',
                'status' => 'boolean',
            ]);

            $data = $request->only(['name', 'code']);
            $data['status'] = $request->has('status');

            $color->update($data);

            return redirect()->route('admin.colors.index')->with('success', 'Color updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to update color: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color)
    {
        try {
            $color->delete();
            return redirect()->route('admin.colors.index')->with('success', 'Color deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete color: ' . $e->getMessage());
        }
    }

    /**
     * Toggle the status of the specified resource.
     */
    public function toggleStatus(Color $color)
    {
        try {
            $color->status = !$color->status;
            $color->save();

            return back()->with('success', 'Color status updated successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to update color status: ' . $e->getMessage());
        }
    }
}
