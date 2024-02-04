<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Task;

class HomeController extends Controller
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
    public function index()
    {
        $statuses = Status::all();
        $modifiedStatuses = $statuses->map(function ($status) {
            $modifiedTasks =  $status->tasks->map(function ($task) {
                $task->subTasks = Task::getSubtasksById($task->id);
                return $task;
            });
            $status['tasks'] = $modifiedTasks;
            return $status;
        });
        return view('home', ['statuses' => $modifiedStatuses]);
    }
}
