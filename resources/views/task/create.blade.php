@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center">Create task</h1>
        <form method="post" action="{{route('task.store')}}">
            @csrf
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
