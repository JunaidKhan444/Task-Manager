<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Http\Resources\TaskListResource;
use App\Http\Resources\TaskResource;
use App\Models\Task;
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
        abort_unless($taskList->user_id === Auth::id(), 403);

        return $this->success([
            'task_list' => new TaskListResource($taskList),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskList $taskList)
    {
        abort_unless($taskList->user_id === Auth::id(), 403);

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
        abort_unless($taskList->user_id === Auth::id(), 403);

        $taskList->delete();

        return $this->success();
    }

    /**
     * Display all tasks of specified taskList.
     */
    public function tasks(TaskList $taskList)
    {
        return $this->success([
            'tasks' => TaskResource::collection($taskList->tasks),
        ]);
    }

    /**
     * Create task with taskList.
     */
    public function addTask(Request $request, TaskList $taskList)
    {
        abort_unless($taskList->user_id === Auth::id(), 403);

        $request->validate([
            'title' => ['required', 'string'],
            'details' => ['nullable', 'string'],
        ]);
        $task = new Task();
        $task->user_id = Auth::id();
        $task->tast_list_id =  $taskList;
        $task->title =  $request->title;
        $task->status = TaskStatus::ToDo->value;
        $task->details =  $request->details;
        $task->save();

        return $this->success([
            'tasks' => new TaskResource($task),
        ]);
    }
}
