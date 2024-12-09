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
}