@extends('layout')
@section('content')
    <div>
        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif
    </div>
    <h1>Task Info</h1>
    <div>
        Task Title is : <strong>{{$task->title}}</strong><br>
        with Description <strong>{{$task->description}}</strong><br>
        and due_date for this task is <strong>{{$task->due_date}}</strong> <br>
        and status of task is <strong>{{$task->status}}</strong>

    </div>
@endsection
