<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Task;

class TaskController extends Controller
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
    public function create()
    {
        return view('task.create' , ['statuses' => Status::all()]);
    }

    public function search()
    {
        $data = request()->post();
        $foundTasks = Task::where('title', 'like', "%{$data['title']}%")
            ->where('status_id', 'like', "%{$data['status_id']}")
            ->get();
        return view('task.search', ['tasks' => $foundTasks]);
    }

    public function view(Task $task)
    {
        return view('task.view' , ['task' => $task, 'statuses' => Status::all()]);
    }

    public function edit(Task $task)
    {
        return view('task.edit' , compact('task'));
    }

    public function update(Task $task)
    {
        $data = request()->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status_id' => 'string',
        ]);



        $subtasks = Task::getSubtasksById($task->id);
        $task->update($data);

        if($subtasks->count() > 0) {
            foreach($subtasks as $subTask) {
                $subTask->update(['status_id' => $task['status_id']]);
            }
        }



        return redirect()->route('home');
    }

    public function delete(Task $task)
    {
        $subtasks = Task::getSubtasksById($task->id);
        if($subtasks->count() > 0) {
            foreach($subtasks as $subTask) {
                $subTask->delete();
            }
        }
        $task->delete();
        return redirect()->route('home');
    }

    public function store(Task $task)
    {
        $data = request()->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $newStatusId = Status::where(['code' => 'new'])->first()->id;

        Task::create([
            ...$data,
            'status_id' => $newStatusId
        ]);

        return redirect()->route('home');
    }
}
