<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Task;
use Illuminate\Http\Request;

class SubTaskController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Task $task)
    {
        return view('subtask.create' , ['task' => $task]);
    }

    public function view(Task $task)
    {
        return view('task.view' , ['task' => $task, 'statuses' => Status::all()]);
    }

    public function edit(Task $task)
    {
        return view('task.edit' , compact('task'));
    }

    public function store(Task $task)
    {
        $data = request()->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'parent_id' => 'string',
            'status_id' => 'string',
        ]);

        Task::create($data);

        return redirect()->route('home');
    }
}
