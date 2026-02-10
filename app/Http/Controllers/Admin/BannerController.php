<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        try {
            $banners = Banner::latest()->get();
            return view('admin.banners.index', compact('banners'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to load banners. ' . $e->getMessage()]);
        }
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {

        try {
            // Normalize checkbox values before validation
            if ($request->status === 'on') {
                $request->merge(['status' => 1]);
            }
            if ($request->is_product_banner === 'on') {
                $request->merge(['is_product_banner' => 1]);
            }

            // Check if request is empty but content-length is not (Implies post_max_size exceeded)
            if (empty($request->all()) && empty($request->files->all()) && $request->header('Content-Length') > 0) {
                return back()->withErrors(['error' => 'The uploaded file exceeds the server maximum limit.'])->withInput();
            }

            // Check for file upload errors (e.g. exceeding php.ini limits)
            if ($request->hasFile('image') && !$request->file('image')->isValid()) {
                return back()->withErrors(['image' => 'The uploaded file exceeds the server limit or is corrupted.'])->withInput();
            }

            $request->validate([
                'title' => 'required|string',
                'desc' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
                'status' => 'nullable|boolean',
                'type' => 'required|in:top,middle',
                'is_product_banner' => 'nullable|boolean'
            ], [
                'image.image' => 'The file must be an image.',
                'image.mimes' => 'The image must be a file of type: jpg, jpeg, png, webp.',
                'image.max' => 'The image size must not exceed 5MB.',
            ]);


            $data = $request->only(['title', 'desc', 'type']);

            // Explicitly cast to boolean integer (0 or 1)
            $data['status'] = $request->boolean('status') ? 1 : 0;
            $data['is_product_banner'] = $request->boolean('is_product_banner') ? 1 : 0;

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('banners', 'public');
            }

            Banner::create($data);

            return redirect()->route('admin.banners.index')->with('success', 'Banner created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create banner. ' . $e->getMessage()])->withInput();
        }
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        // Normalize checkbox values before validation
        if ($request->status === 'on') {
            $request->merge(['status' => 1]);
        }
        if ($request->is_product_banner === 'on') {
            $request->merge(['is_product_banner' => 1]);
        }

        $request->validate([
            'title' => 'required|string',
            'desc' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'status' => 'nullable|boolean',
            'type' => 'required|in:top,middle',
            'is_product_banner' => 'nullable|boolean'
        ]);

        try {
            $data = $request->only(['title', 'desc', 'type']);

            // Explicitly cast to boolean integer (0 or 1)
            $data['status'] = $request->boolean('status') ? 1 : 0;
            $data['is_product_banner'] = $request->boolean('is_product_banner') ? 1 : 0;

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                    Storage::disk('public')->delete($banner->image);
                }

                $data['image'] = $request->file('image')->store('banners', 'public');
            }

            $banner->update($data);

            return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update banner. ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Banner $banner)
    {
        try {
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }

            $banner->delete();

            return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete banner. ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Banner $banner)
    {
        try {
            $banner->status = !$banner->status;
            $banner->save();

            return response()->json([
                'status' => $banner->status,
                'message' => 'Status updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update status'], 500);
        }
    }
}
