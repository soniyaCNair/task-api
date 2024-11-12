<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
     public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->validated());
        return response()->json($task, 201);
    }
     public function index(Request $request)
    {
        $tasks = Task::paginate(10);
        return response()->json($tasks);
    }
     public function update($id)
    {
        $task = Task::findOrFail($id);
        $task->is_completed = true;
        $task->save();

        return response()->json($task);
    }

    // Delete a task
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }
}
