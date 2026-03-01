<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = \App\Models\Menu::latest()->get();
        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.menus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'food_type' => 'required|string|in:veg,non-veg,egg,vegan',
            'image' => 'nullable|image|max:2048', 
            // 'is_available' validation removed because 'on' is not a boolean
        ]);
        
        // Handle checkbox for is_available as boolean
        $validated['is_available'] = $request->has('is_available');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('menus', 'public');
            $validated['image'] = $path;
        }

        \App\Models\Menu::create($validated);

        return redirect()->route('admin.menus.index')->with('success', 'Menu item created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $menu = \App\Models\Menu::findOrFail($id);
        return view('admin.menus.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'food_type' => 'required|string|in:veg,non-veg,egg,vegan',
            'image' => 'nullable|image|max:2048',
            // 'is_available' validation removed
        ]);

        $validated['is_available'] = $request->has('is_available');

        $menu = \App\Models\Menu::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete old image if exists and not a URL
            if ($menu->image && !str_starts_with($menu->image, 'http')) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($menu->image);
            }
            
            $path = $request->file('image')->store('menus', 'public');
            $validated['image'] = $path;
        }

        $menu->update($validated);

        return redirect()->route('admin.menus.index')->with('success', 'Menu item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $menu = \App\Models\Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu item deleted successfully.');
    }
}
