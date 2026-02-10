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
        try {
            $faqs = \App\Models\Faq::latest()->paginate(10);
            return view('admin.faqs.index', compact('faqs'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to load FAQs. ' . $e->getMessage()]);
        }
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

        try {
            \App\Models\Faq::create([
                'question' => $request->question,
                'answer'   => $request->answer,
                'status'   => $request->has('status'),
            ]);

            return redirect()->route('admin.faqs.index')
                ->with('success', 'FAQ created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create FAQ. ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $faq = \App\Models\Faq::findOrFail($id);
            return view('admin.faqs.edit', compact('faq'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to load FAQ. ' . $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer'   => 'required|string',
            'status'   => 'nullable|boolean',
        ]);

        try {
            $faq = \App\Models\Faq::findOrFail($id);

            $faq->update([
                'question' => $request->question,
                'answer'   => $request->answer,
                'status'   => $request->has('status'),
            ]);

            return redirect()->route('admin.faqs.index')
                ->with('success', 'FAQ updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update FAQ. ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $faq = \App\Models\Faq::findOrFail($id);
            $faq->delete();

            return redirect()->route('admin.faqs.index')
                ->with('success', 'FAQ deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete FAQ. ' . $e->getMessage()]);
        }
    }

    public function toggleStatus($id)
    {
        try {
            $faq = \App\Models\Faq::findOrFail($id);
            $faq->status = !$faq->status;
            $faq->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update status'], 500);
        }
    }
}
