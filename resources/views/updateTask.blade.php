@extends('layout')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card-header bg-primary text-white text-center">
                    <h4>Update Task</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('tasks.update',$task->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            {{-- <label for="User_id">User_id</label> --}}
                            <input type="int" class="form-control" id="title" placeholder="Enter task title" name="user_id" aria-describedby="titleHelp" value="{{$task->user_id}}" hidden>
                        </div>
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            @error('title')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                            <input type="text" class="form-control" id="title" placeholder="Enter task title" name="title" aria-describedby="titleHelp" value="{{$task->title}}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            @error('description')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                            <input type="text" class="form-control" id="description" placeholder="Enter task description" name="description" aria-label="Description"value="{{$task->description}}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="due_date">Due Date</label>
                            @error('due_date')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                            <input type="date" class="form-control" id="due_date" name="due_date" value="{{$task->due_date}}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" id="status"value="{{$task->status}}">
                                <option value="pending">Pending</option>
                                {{-- <option value="in_progress">In Progress</option> --}}
                                <option value="completed">Completed</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Update Task</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
