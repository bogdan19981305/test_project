@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Dashboard</h1>
            <a href="{{route('task.create')}}">
                <button class="btn btn-primary">Create</button>
            </a>
        </div>
        <form method="post" action="{{route('task.search')}}" class="row g-3 mt-5 justify-content-end border p-4 mb-3">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Task Title</label>
                <input name="title" type="text" class="form-control" id="title" placeholder="title">
            </div>
            <div>
                <label for="status_id" class="form-label">Status</label>
                <select name="status_id" id="status_id" class="form-select">
                    @foreach($statuses as $status)
                        <option
                            value="{{$status->id}}"
                        >
                            {{$status->label}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary mb-3">Search</button>
            </div>

        </form>
        <div class="row gx-5">
            @foreach($statuses as $status)
                <div class="d-flex col border text-center p-2 align-items-center flex-column">
                    <h3>{{$status->label}}</h3>
                    @foreach($status->tasks as $task)
                        @if(!isset($task['parent_id']))
                            <div class="card w-100 bg-body-secondary mb-3">
                                <div class="card-body">
                                    <a href="{{route('task.view', $task->id)}}">
                                        <h5 class="card-title">{{$task->title}}</h5>
                                    </a>
                                    <p class="card-text">{{$task->description}}</p>
                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="{{route('task.edit',$task->id)}}">
                                            <button class="btn btn-warning">edit</button>
                                        </a>
                                        <form method="post" action="{{route('task.delete', $task->id)}}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">delete</button>
                                        </form>
                                        <a href="{{route('subtask.create', $task->id)}}">
                                            <button class="btn btn-secondary">create sub task</button>
                                        </a>
                                    </div>
                                    <p class="card-text text-sm-end mt-2">Created at:{{$task['created_at']}}</p>
                                </div>
                            </div>
                        @foreach($task->subTasks as $subTask)
                                <div class="card w-100 bg-body-tertiary mb-0">
                                    <div class="card-body">
                                        <h5>SubTask</h5>
                                        <a href="{{route('task.view', $subTask->id)}}">
                                            <h5 class="card-title">{{$subTask->title}}</h5>
                                        </a>
                                        <p class="card-text">{{$subTask->description}}</p>
                                        <div class="d-flex gap-2 justify-content-end">
                                            <a href="{{route('task.edit',$subTask->id)}}">
                                                <button class="btn btn-warning">edit</button>
                                            </a>
                                            <form method="post" action="{{route('task.delete', $subTask->id)}}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">delete</button>
                                            </form>
                                        </div>
                                        <p class="card-text text-sm-end mt-2">Created at:{{$subTask['created_at']}}</p>
                                    </div>
                                </div>
                        @endforeach
                        @endif
                    @endforeach
                </div>
            @endforeach

        </div>
    </div>
@endsection
