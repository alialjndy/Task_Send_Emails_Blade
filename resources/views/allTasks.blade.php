@extends('layout')
@section('content')
    <div>
        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif
    </div>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif
    <div class="d-flex justify-content-center align-items-center vh-20">
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create</a><br><br><br><br>
    </div>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Due Date</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allTasks as $task)
                <tr>
                    <th scope="row">{{ $task->id }}</th>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->due_date }}</td>
                    <td>{{ $task->status }}</td>
                    <td>

                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Update</a>

                        <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info">Show</a>

                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
