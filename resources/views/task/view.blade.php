@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <h5 class="card-header d-flex justify-content-between">
                {{$task->title}}
                <div class="badge bg-info text-dark">
                    {{$task?->status->label}}
                </div>
            </h5>
            <div class="card-body">
                <p class="card-text">{{$task->description}}</p>
                <div class="d-flex gap-3 justify-content-end">
                    <a href="{{route('home')}}" class="btn btn-primary">Go to dashboard</a>
                    @if(!isset($task['parent_id']))
                        <a href="{{route('subtask.create', $task->id)}}">
                            <button class="btn btn-secondary">create sub task</button>
                        </a>
                    @endif
                    <a href="{{route('task.edit',$task->id)}}">
                        <button class="btn btn-warning">edit</button>
                    </a>
                    <form method="post" action="{{route('task.delete', $task->id)}}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">delete</button>
                    </form>
                </div>
            </div>
        </div>
        @if(!isset($task['parent_id']))
            <form method="post" action="{{route('task.update', $task->id)}}" class="row g-3 mt-5 justify-content-end">
                @csrf
                @method('patch')
                <input value="{{$task->title}}" type="hidden" name="title" />
                <input value="{{$task->description}}" type="hidden" name="description" />
                <div class="col-auto">
                    <label for="status_id" class="visually-hidden">Status</label>
                    <select name="status_id" id="status_id" class="form-select">
                        @foreach($statuses as $status)
                            <option
                                {{$status->code === $task->status->code ? 'disabled' : ''}}
                                value="{{$status->id}}"
                            >
                                {{$status->label}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Change Status</button>
                </div>
            </form>
        @endif
    </div>
@endsection
