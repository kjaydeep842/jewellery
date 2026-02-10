<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReturnExchange;

class ReturnExchangeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $returns = ReturnExchange::latest()->get();
            return view('admin.returns.index', compact('returns'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to load policies. ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.returns.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'boolean',
        ]);

        try {
            ReturnExchange::create([
                'title' => $request->title,
                'content' => $request->content,
                'status' => $request->has('status'),
            ]);

            return redirect()->route('admin.returns.index')->with('success', 'Return & Exchange policy created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create policy. ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $return = ReturnExchange::findOrFail($id);
            return view('admin.returns.edit', compact('return'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to load policy. ' . $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'boolean',
        ]);

        try {
            $return = ReturnExchange::findOrFail($id);
            $return->update([
                'title' => $request->title,
                'content' => $request->content,
                'status' => $request->has('status'),
            ]);

            return redirect()->route('admin.returns.index')->with('success', 'Return & Exchange policy updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update policy. ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $return = ReturnExchange::findOrFail($id);
            $return->delete();

            return redirect()->route('admin.returns.index')->with('success', 'Return & Exchange policy deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete policy. ' . $e->getMessage()]);
        }
    }

    /**
     * Toggle the status of the specified resource.
     */
    public function toggleStatus($id)
    {
        try {
            $return = ReturnExchange::findOrFail($id);
            $return->status = !$return->status;
            $return->save();

            return response()->json(['success' => true, 'status' => $return->status, 'message' => 'Status updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update status'], 500);
        }
    }
}
