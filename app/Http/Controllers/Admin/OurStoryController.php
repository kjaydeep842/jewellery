<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OurStoryController extends Controller
{
    public function index()
    {
        try {
            $stories = \App\Models\OurStory::latest()->get();
            return view('admin.our_stories.index', compact('stories'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to load stories. ' . $e->getMessage()]);
        }
    }

    public function create()
    {
        return view('admin.our_stories.create');
    }

    public function store(Request $request)
    {
        $request->merge(['status' => $request->has('status')]);

        $request->validate([
            'type' => 'required|in:content,feature',
            'title' => 'nullable|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'status' => 'boolean'
        ]);

        try {
            $data = $request->except('image');

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('our_stories', 'public');
            }

            \App\Models\OurStory::create($data);

            return redirect()->route('admin.our_stories.index')
                ->with('success', 'Story content added successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to add story content. ' . $e->getMessage()])->withInput();
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(\App\Models\OurStory $our_story)
    {
        return view('admin.our_stories.edit', compact('our_story'));
    }

    public function update(Request $request, \App\Models\OurStory $our_story)
    {
        $request->merge(['status' => $request->has('status')]);

        $request->validate([
            'type' => 'required|in:content,feature',
            'title' => 'nullable|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'status' => 'boolean'
        ]);

        try {
            $data = $request->except('image');

            if ($request->hasFile('image')) {
                if ($our_story->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($our_story->image)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($our_story->image);
                }
                $data['image'] = $request->file('image')->store('our_stories', 'public');
            }

            $our_story->update($data);

            return redirect()->route('admin.our_stories.index')
                ->with('success', 'Story content updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update story content. ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(\App\Models\OurStory $our_story)
    {
        try {
            if ($our_story->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($our_story->image);
            }
            $our_story->delete();

            return redirect()->route('admin.our_stories.index')
                ->with('success', 'Story content deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete story content. ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(\App\Models\OurStory $our_story)
    {
        try {
            $our_story->status = !$our_story->status;
            $our_story->save();

            return response()->json(['message' => 'Status updated successfully', 'status' => $our_story->status]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update status'], 500);
        }
    }
}
