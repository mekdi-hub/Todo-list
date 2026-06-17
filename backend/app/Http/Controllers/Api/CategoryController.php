<?php

namespace App\Http\Controllers\Api;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       $categories= $request
       ->user()
       ->categories()
       ->get();
       return $categories;
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'name'=>'required|string|max:255',
            'description'=>'nullable|string',
            'image'=>'nullable|string',

        ]);
        $categories=$request->user()->categories()->create($validated);
        return response()->json([
            'message'=>'Category created successfully',
            'category'=>$categories
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,string $id)
    {
        $categories=$request->user()->categories()->findorfail($id);

       return $categories;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categories=$request->user()->categories()->findorfail($id);

        $validated=$request->validate([

           
            'description' => 'nullable|string',
            'name' => 'required|string',
            'image' => 'nullable|string',
           

        ]);
       $categories->update($validated);
        return response()->json([

            'message'=>'Category updated successfully',
            'category'=>$categories
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories=$request->user()->categories()->findorfail($id);
        $categories->delete();

        return response()->json([

            'message'=>'category deleted successfully'
        ]);
    }
}
