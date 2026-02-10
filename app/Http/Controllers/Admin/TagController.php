<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        try {
            $tags = Tag::latest()->paginate(10);
            return view('admin.tags.index', compact('tags'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to load tags. ' . $e->getMessage()]);
        }
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        $request->merge(['status' => $request->has('status') ? 'active' : 'inactive']);

        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
            'status' => 'required|in:active,inactive'
        ]);

        try {
            Tag::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'status' => $request->status
            ]);

            return redirect()->route('admin.tags.index')
                ->with('success', 'Tag created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create tag. ' . $e->getMessage()])->withInput();
        }
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $request->merge(['status' => $request->has('status') ? 'active' : 'inactive']);

        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id,
            'status' => 'required|in:active,inactive'
        ]);

        try {
            $tag->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'status' => $request->status
            ]);

            return redirect()->route('admin.tags.index')
                ->with('success', 'Tag updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update tag. ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Tag $tag)
    {
        try {
            $tag->delete();

            return redirect()->route('admin.tags.index')
                ->with('success', 'Tag deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete tag. ' . $e->getMessage()]);
        }
    }
}
