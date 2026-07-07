<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = $request
            ->user()
            ->categories()
            ->get();
        return CategoryResource::collection($categories);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {

            $imagePath = $request
                ->file('image')
                ->store('categories', 'public');
        }
        $categories = $request->user()->categories()->create([
            'name' => $validated['name'],

            'description' => $validated['description'] ?? null,

            'image' => $imagePath

        ]);
        return response()->json([
            'message' => 'Category created successfully',
            'category' => new CategoryResource($categories)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $categories = $request->user()->categories()->findorfail($id);

        return new CategoryResource($categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categories = $request->user()->categories()->findorfail($id);

        $validated = $request->validate([


            'description' => 'nullable|string',
            'name' => 'required|string',
            'image' => 'nullable|max:2048',


        ]);
        if ($request->hasfile('image')) {


            $imagePath = $request->file('image')->store('categories', 'public');
            $validated['image'] = $imagePath;
        }

        $categories->update($validated);
        return response()->json([

            'message' => 'Category updated successfully',
            'category' => new CategoryResource($categories)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $categories = $request->user()->categories()->findorfail($id);
        $categories->delete();

        return response()->json([

            'message' => 'category deleted successfully'
        ]);
    }
}
