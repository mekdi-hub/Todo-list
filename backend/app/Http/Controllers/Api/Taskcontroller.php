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
       $query= $request->user()->tasks()->with('category');

       if ($request->has('search'))
    {
        $query->where(
            'title',
            'like',
            '%' . $request->input('search') . '%'
        );
    }
       if ($request->has('status'))
        {
           $query->where('status',$request->input('status'));
        }
      
       if($request ->has('priority'))
        {
         $query->where('priority',$request->input('priority'));
        
        }

      
if ($request->has('sort')) {

    if ($request->sort == 'latest') {

        $query->orderBy('created_at','desc');

    }

    if ($request->sort == 'oldest') {

        $query->orderBy('created_at','asc');

    }

    if ($request->sort == 'priority') {

  $query->orderByRaw("
                    CASE
                    WHEN priority='High' THEN 1
                    WHEN priority='Medium' THEN 2
                    WHEN priority='Low' THEN 3
                    END
                ");
    }
}
        $tasks= $query->paginate(10);
         return TaskResource::collection($tasks);
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
           'task'=>new TaskResource($task)
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
       return new TaskResource($task);

      
    }
  public function complete(Request $request, string $id)
{
    $task = $request->user()
                    ->tasks()
                    ->findOrFail($id);


    $task->update([
        'status'=>'Completed'
    ]);


    return response()->json([

        'message'=>'Task completed successfully',
        'task'=>new TaskResource($task)

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
