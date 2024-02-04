@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Search</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Type</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr class="{{$task['parent_id'] ? 'table-primary' : ''}}">
                    <th scope="row">{{$task->id}}</th>
                    <th scope="row">{{$task->id}}</th>
                    <td>{{$task->title}}</td>
                    <td>{{$task['parent_id'] ? 'Sub Task' : 'Full Task'}}</td>
                    <td>{{$task->status->label}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{route('home')}}" class="btn btn-primary">Go to dashboard</a>
    </div>
@endsection
