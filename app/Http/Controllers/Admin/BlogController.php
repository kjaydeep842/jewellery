<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $blogs = Blog::latest()->get();
            return view('admin.blogs.index', compact('blogs'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to load blogs. ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge(['status' => $request->has('status')]);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'status' => 'boolean',
            'published_at' => 'nullable|date'
        ]);

        try {
            $data = $request->except('image');
            $data['slug'] = Str::slug($request->title);

            // Ensure unique slug
            $original_slug = $data['slug'];
            $count = 1;
            while (Blog::where('slug', $data['slug'])->exists()) {
                $data['slug'] = $original_slug . '-' . $count++;
            }

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('blogs', 'public');
            }

            if (!$request->published_at) {
                $data['published_at'] = now();
            }

            Blog::create($data);

            return redirect()->route('admin.blogs.index')
                ->with('success', 'Blog created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create blog. ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->merge(['status' => $request->has('status')]);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'status' => 'boolean',
            'published_at' => 'nullable|date'
        ]);

        try {
            $data = $request->except('image');

            if ($blog->title !== $request->title) {
                $data['slug'] = Str::slug($request->title);
                // Ensure unique slug
                $original_slug = $data['slug'];
                $count = 1;
                while (Blog::where('slug', $data['slug'])->where('id', '!=', $blog->id)->exists()) {
                    $data['slug'] = $original_slug . '-' . $count++;
                }
            }

            if ($request->hasFile('image')) {
                if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                    Storage::disk('public')->delete($blog->image);
                }
                $data['image'] = $request->file('image')->store('blogs', 'public');
            }

            $blog->update($data);

            return redirect()->route('admin.blogs.index')
                ->with('success', 'Blog updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update blog. ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        try {
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }
            $blog->delete();

            return redirect()->route('admin.blogs.index')
                ->with('success', 'Blog deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete blog. ' . $e->getMessage()]);
        }
    }

    /**
     * Toggle the status of a blog.
     */
    public function toggleStatus(Blog $blog)
    {
        try {
            $blog->status = !$blog->status;
            $blog->save();

            return response()->json(['message' => 'Status updated successfully', 'status' => $blog->status]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update status'], 500);
        }
    }
}
