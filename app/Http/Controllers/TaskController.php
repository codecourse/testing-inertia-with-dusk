<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
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
}
