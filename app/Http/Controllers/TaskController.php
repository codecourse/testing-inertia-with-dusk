<?php

namespace App\Http\Controllers;

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
        return inertia()->render('Tasks/Create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'max:255']
        ]);

        $request->user()->tasks()->create($data);

        return redirect()->route('tasks.index');
    }
}
