<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = \App\Models\Faq::latest()->paginate(10);
        return view('admin.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer'   => 'required|string',
            'status'   => 'nullable|boolean',
        ]);

        \App\Models\Faq::create([
            'question' => $request->question,
            'answer'   => $request->answer,
            'status'   => $request->has('status'),
        ]);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $faq = \App\Models\Faq::findOrFail($id);
        return view('admin.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $faq = \App\Models\Faq::findOrFail($id);

        $request->validate([
            'question' => 'required|string|max:255',
            'answer'   => 'required|string',
            'status'   => 'nullable|boolean',
        ]);

        $faq->update([
            'question' => $request->question,
            'answer'   => $request->answer,
            'status'   => $request->has('status'),
        ]);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $faq = \App\Models\Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $faq = \App\Models\Faq::findOrFail($id);
        $faq->status = !$faq->status;
        $faq->save();

        return response()->json(['success' => true]);
    }
}
