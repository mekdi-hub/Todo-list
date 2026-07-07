<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();


        $tasks = $user->tasks();

        $tasksByCategory = DB::table('categories')
            ->leftJoin('tasks', 'categories.id', '=', 'tasks.category_id')
            ->where('categories.user_id', auth()->id())
            ->select(
                'categories.name as category',
                DB::raw('count(tasks.id) as total')
            )
            ->groupBy('categories.id', 'categories.name')
            ->get();


        return response()->json([

            'total_tasks' => $tasks->count(),

            'completed_tasks' =>
            $user->tasks()
                ->where('status', 'Completed')
                ->count(),


            'pending_tasks' =>
            $user->tasks()
                ->where('status', 'Pending')
                ->count(),


            'high_priority_tasks' =>
            $user->tasks()
                ->where('priority', 'High')
                ->count(),


            'total_categories' =>
            $user->categories()
                ->count(),

            'today_tasks' => $request->user()
                ->tasks()
                ->whereDate('due_date', today())
                ->with('category')
                ->get(),

            'tasks_by_category' => $tasksByCategory

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

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
