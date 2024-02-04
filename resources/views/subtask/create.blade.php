@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center">Create Sub Task</h1>
        <h3 class="card-header d-flex justify-content-between">
            {{$task->title}}
            <div class="badge bg-info text-dark">
                {{$task?->status->label}}
            </div>
        </h3>
        <form method="post" action="{{route('subtask.store')}}">
            @csrf
            <input value="{{$task->id}}" type="hidden" name="parent_id" />
            <input value="{{$task->status->id}}" type="hidden" name="status_id" />
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="description" rows="5"></textarea>
            </div>
            <div class="d-flex gap-3 align-items-center">
                <a href="{{route('home')}}">
                    <button type="button" class="btn btn-danger">Cancel</button>
                </a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
