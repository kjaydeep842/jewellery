<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Exception;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $units = Unit::latest()->paginate(10);
            return view('admin.units.index', compact('units'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load units: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('admin.units.create');
        } catch (Exception $e) {
            return redirect()->route('admin.units.index')->with('error', 'Failed to load create form: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:units',
                'code' => 'nullable|string|max:50',
                'status' => 'boolean',
            ]);

            $data = $request->only(['name', 'code']);
            $data['status'] = $request->boolean('status', true);

            Unit::create($data);

            return redirect()->route('admin.units.index')->with('success', 'Unit created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to create unit: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        try {
            return view('admin.units.edit', compact('unit'));
        } catch (Exception $e) {
            return redirect()->route('admin.units.index')->with('error', 'Failed to load edit form: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:units,name,' . $unit->id,
                'code' => 'nullable|string|max:50',
                'status' => 'boolean',
            ]);

            $data = $request->only(['name', 'code']);
            $data['status'] = $request->has('status');

            $unit->update($data);

            return redirect()->route('admin.units.index')->with('success', 'Unit updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to update unit: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        try {
            $unit->delete();
            return redirect()->route('admin.units.index')->with('success', 'Unit deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete unit: ' . $e->getMessage());
        }
    }

    /**
     * Toggle the status of the specified resource.
     */
    public function toggleStatus(Unit $unit)
    {
        try {
            $unit->status = !$unit->status;
            $unit->save();

            return back()->with('success', 'Unit status updated successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to update unit status: ' . $e->getMessage());
        }
    }
}
