<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavigationMenu;
use Illuminate\Http\Request;

class NavigationMenuController extends Controller
{
    public function index()
    {
        try {
            $menus = NavigationMenu::orderBy('order')->paginate(10);
            return view('admin.navigation_menus.index', compact('menus'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to load navigation menus. ' . $e->getMessage()]);
        }
    }

    public function create()
    {
        return view('admin.navigation_menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'route_name' => 'nullable|string|max:255',
            'url'        => 'nullable|string|max:255',
            'status'     => 'required|in:active,inactive',
            'order'      => 'required|integer',
        ]);

        try {
            NavigationMenu::create($request->all());

            return redirect()->route('admin.navigation_menus.index')
                ->with('success', 'Navigation menu created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create navigation menu. ' . $e->getMessage()])->withInput();
        }
    }

    public function edit(NavigationMenu $navigation_menu)
    {
        return view('admin.navigation_menus.edit', compact('navigation_menu'));
    }

    public function update(Request $request, NavigationMenu $navigation_menu)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'route_name' => 'nullable|string|max:255',
            'url'        => 'nullable|string|max:255',
            'status'     => 'required|in:active,inactive',
            'order'      => 'required|integer',
        ]);

        try {
            $navigation_menu->update($request->all());

            return redirect()->route('admin.navigation_menus.index')
                ->with('success', 'Navigation menu updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update navigation menu. ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(NavigationMenu $navigation_menu)
    {
        try {
            $navigation_menu->delete();

            return redirect()->route('admin.navigation_menus.index')
                ->with('success', 'Navigation menu deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete navigation menu. ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(NavigationMenu $navigation_menu)
    {
        try {
            $navigation_menu->status = $navigation_menu->status === 'active' ? 'inactive' : 'active';
            $navigation_menu->save();

            return response()->json(['success' => true, 'status' => $navigation_menu->status]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
