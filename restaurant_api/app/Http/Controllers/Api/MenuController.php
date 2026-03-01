<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::all()->map(function ($menu) {
            if ($menu->image && !str_starts_with($menu->image, 'http')) {
                $menu->image = asset('menuimage/' . $menu->image);
            }
            return $menu;
        });
        
        return response()->json([
            'status' => true,
            'data' => $menus
        ]);
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
            'food_type' => 'required|string|max:255', // veg, non-veg, etc
            'image' => 'nullable|string', // URL or path
            'is_available' => 'boolean',
        ]);

        $menu = Menu::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Menu item created successfully',
            'data' => $menu
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return response()->json([
                'status' => false,
                'message' => 'Menu item not found'
            ], 404);
        }

        if ($menu->image && !str_starts_with($menu->image, 'http')) {
            $menu->image = asset('storage/' . $menu->image);
        }

        return response()->json([
            'status' => true,
            'data' => $menu
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return response()->json([
                'status' => false,
                'message' => 'Menu item not found'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'category' => 'sometimes|required|string|max:255',
            'food_type' => 'sometimes|required|string|max:255',
            'image' => 'nullable|string',
            'is_available' => 'boolean',
        ]);

        $menu->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Menu item updated successfully',
            'data' => $menu
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return response()->json([
                'status' => false,
                'message' => 'Menu item not found'
            ], 404);
        }

        $menu->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Menu item deleted successfully'
        ]);
    }
}
