<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();


        $tasks = $user->tasks();


        return response()->json([

            'total_tasks' => $tasks->count(),

            'completed_tasks' =>
                $user->tasks()
                ->where('status','Completed')
                ->count(),


            'pending_tasks' =>
                $user->tasks()
                ->where('status','Pending')
                ->count(),


            'high_priority_tasks' =>
                $user->tasks()
                ->where('priority','High')
                ->count(),


            'total_categories' =>
                $user->categories()
                ->count(),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
