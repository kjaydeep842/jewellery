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
        $banners = Banner::latest()->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        // Normalize "on" to 1
        if ($request->status === 'on') {
            $request->merge(['status' => 1]);
        }

        $request->validate([
            'title'  => 'required|string',
            'desc'   => 'nullable|string',
            'image'  => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'status' => 'nullable|boolean', // accepts 0,1,true,false
        ]);

        $data = $request->only(['title', 'desc']);

        // Always convert checkbox to boolean 1/0
        $data['status'] = $request->boolean('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        Banner::create($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner created successfully.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        // Normalize "on" to 1
        if ($request->status === 'on') {
            $request->merge(['status' => 1]);
        }

        $request->validate([
            'title'  => 'required|string',
            'desc'   => 'nullable|string',
            'image'  => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'status' => 'nullable|boolean',
        ]);

        $data = $request->only(['title', 'desc']);

        // Convert checkbox
        $data['status'] = $request->boolean('status') ? 1 : 0;

        if ($request->hasFile('image')) {

            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }

            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        $banner->update($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully.');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->image) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully.');
    }

    public function toggleStatus(Banner $banner)
    {
        $banner->status = !$banner->status;
        $banner->save();

        return response()->json([
            'status' => $banner->status
        ]);
    }
}
