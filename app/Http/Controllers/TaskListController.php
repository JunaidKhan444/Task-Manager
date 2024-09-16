<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskListResource;
use App\Models\TaskList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->success([
            'task_list' => TaskListResource::collection(TaskList::where('user_id', Auth::id())),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string']
        ]);

        $taskList = new TaskList();
        $taskList->user_id = Auth::id();
        $taskList->title = $request->title;
        $taskList->save();

        return $this->success([
            'task_list' => new TaskListResource($taskList),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskList $taskList)
    {
        return $this->success([
            'task_list' => new TaskListResource($taskList),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskList $taskList)
    {
        $request->validate([
            'title' => ['string', 'required']
        ]);

        $taskList->title = $request->title;
        $taskList->save();

        return $this->success([
            'task_list' => new TaskListResource($taskList),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskList $taskList)
    {
        $taskList->delete();

        return $this->success();
    }
}
