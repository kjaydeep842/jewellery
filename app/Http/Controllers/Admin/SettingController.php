<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = GeneralSetting::first() ?? new GeneralSetting();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'primary_color' => 'required|string',
            'secondary_color' => 'required|string',
            'header_color' => 'nullable|string',
            'font_family' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $settings = GeneralSetting::first();
        if (!$settings) {
            $settings = new GeneralSetting();
        }

        $data = $request->only(['site_name', 'primary_color', 'secondary_color', 'header_color', 'font_family']);

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($settings->logo_path) {
                Storage::disk('public')->delete($settings->logo_path);
            }
            $path = $request->file('logo')->store('logos', 'public');
            $data['logo_path'] = $path;
        }

        $settings->fill($data)->save();

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
