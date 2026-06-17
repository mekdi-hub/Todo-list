<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Task;
class Taskcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       $tasks= $request->user()->tasks()->get();
       return $tasks;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     $validated= $request->validate([
        'category_id'=>'nullable|exists:categories,id',
       'title'=>'required|string',
        'description'=>'nullable|string',
        'status'=>'required|string',
        'due_date'=>'required|date',
        'due_time'=>'nullable|string',
        'priority'=>'required|string',
        
        ]);
        $task=$request->user()->tasks()->create($validated);
        return response ()->json([

            'message'=>'task created successfully',
            'task'=>$task
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,string $id)
    {
       $task=$request->user()->tasks()->findorfail($id);

       return $task;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task=$request->user()->tasks()->findorfail($id);

        $validated=$request->validate([

           'title' => 'required|string',
            'description' => 'nullable|string',
            'priority' => 'required|string',
            'status' => 'required|string',
            'due_date' => 'nullable|date',
            'due_time' => 'nullable',

        ]);
       $task->update($validated);
        return response()->json([

            'message'=>'task updated successfully',
            'task'=>$task
        ]);

      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        $task=$request->user()->tasks()->findorfail($id);
        $task->delete();

        return response()->json([

            'message'=>'task deleted successfully'
        ]);
    }
}
