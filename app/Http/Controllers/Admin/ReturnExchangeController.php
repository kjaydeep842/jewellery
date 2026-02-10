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
        $returns = ReturnExchange::latest()->get();
        return view('admin.returns.index', compact('returns'));
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

        ReturnExchange::create([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->has('status'),
        ]);

        return redirect()->route('admin.returns.index')->with('success', 'Return & Exchange policy created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $return = ReturnExchange::findOrFail($id);
        return view('admin.returns.edit', compact('return'));
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

        $return = ReturnExchange::findOrFail($id);
        $return->update([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->has('status'),
        ]);

        return redirect()->route('admin.returns.index')->with('success', 'Return & Exchange policy updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $return = ReturnExchange::findOrFail($id);
        $return->delete();

        return redirect()->route('admin.returns.index')->with('success', 'Return & Exchange policy deleted successfully.');
    }

    /**
     * Toggle the status of the specified resource.
     */
    public function toggleStatus($id)
    {
        $return = ReturnExchange::findOrFail($id);
        $return->status = !$return->status;
        $return->save();

        return response()->json(['success' => true, 'status' => $return->status, 'message' => 'Status updated successfully.']);
    }
}
