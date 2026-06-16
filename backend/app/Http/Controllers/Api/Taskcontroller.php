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
    public function index()
    {
       $tasks=Task::all();
       return $tasks;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $task= Task::Create([
       'title'=>$request->title,
        'description'=>$request->description,
        'status'=>$request->status,
        'due_date'=>$request->due_date,
        'due_time'=>$request->due_time,
        'priority'=>$request->priority,
        ]);
        return response ()->json([

            'message'=>'task created successfully',
           
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $task=Task::findorfail($id);

       return $task;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task=Task::findorfail($id);
        $task->update([

         'title'=>$request->title,
        'description'=>$request->description,
        'status'=>$request->status,
        'due_date'=>$request->due_date,
        'due_time'=>$request->due_time,
        'priority'=>$request->priority,

        ]);
       
        return response()->json([

            'message'=>'task updated successfully',
            'task'=>$task
        ]);

      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task=Task::findorfail($id);
        $task->delete();

        return response()->json([

            'message'=>'task deleted successfully'
        ]);
    }
}
