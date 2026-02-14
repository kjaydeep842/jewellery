<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LegalPage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LegalPageController extends Controller
{
    public function index()
    {
        $legalPages = LegalPage::latest()->get();
        return view('admin.legal_pages.index', compact('legalPages'));
    }

    public function create()
    {
        return view('admin.legal_pages.create');
    }

    public function store(Request $request)
    {
        $request->merge(['status' => $request->has('status')]);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'type' => 'required|in:terms,privacy',
            'status' => 'boolean',
        ]);

        try {
            $data = $request->all();
            $data['slug'] = Str::slug($request->title);

            // Ensure unique slug
            $original_slug = $data['slug'];
            $count = 1;
            while (LegalPage::where('slug', $data['slug'])->exists()) {
                $data['slug'] = $original_slug . '-' . $count++;
            }

            LegalPage::create($data);

            return redirect()->route('admin.legal-pages.index')
                ->with('success', 'Legal page created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create legal page. ' . $e->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $legalPage = LegalPage::findOrFail($id);
        return view('admin.legal_pages.edit', compact('legalPage'));
    }

    public function update(Request $request, $id)
    {
        $legalPage = LegalPage::findOrFail($id);

        $request->merge(['status' => $request->has('status')]);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'type' => 'required|in:terms,privacy',
            'status' => 'boolean',
        ]);

        try {
            $data = $request->all();

            if ($legalPage->title !== $request->title) {
                $data['slug'] = Str::slug($request->title);
                $original_slug = $data['slug'];
                $count = 1;
                while (LegalPage::where('slug', $data['slug'])->where('id', '!=', $id)->exists()) {
                    $data['slug'] = $original_slug . '-' . $count++;
                }
            }

            $legalPage->update($data);

            return redirect()->route('admin.legal-pages.index')
                ->with('success', 'Legal page updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update legal page. ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $legalPage = LegalPage::findOrFail($id);
            $legalPage->delete();
            return response()->json(['success' => true, 'message' => 'Legal page deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete legal page.'], 500);
        }
    }

    public function toggleStatus($id)
    {
        try {
            $legalPage = LegalPage::findOrFail($id);
            $legalPage->status = !$legalPage->status;
            $legalPage->save();

            return response()->json([
                'success' => true,
                'status' => $legalPage->status,
                'message' => 'Status updated successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Update failed.'], 500);
        }
    }
}
