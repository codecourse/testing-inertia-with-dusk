<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskDestroyRequest;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        return inertia()->render('Tasks/Index', [
            'tasks' => $request->user()->tasks
        ]);
    }

    public function create()
    {
        return inertia()->render('Tasks/Create', [
            'status' => session('status')
        ]);
    }

    public function store(TaskStoreRequest $request)
    {
        $request->user()->tasks()->create($request->validated());

        return back()->with('status', 'Task created');
        //return redirect()->route('tasks.index');
    }

    public function destroy(TaskDestroyRequest $request, Task $task)
    {
        $task->delete();

        return back();
    }

    public function update(TaskUpdateRequest $request, Task $task)
    {
        $data = $request->validate([
            'title' => ['required', 'max:255']
        ]);

        $task->update($data);

        return back();
    }
}
