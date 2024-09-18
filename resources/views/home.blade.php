@extends('layouts.base')

@section('title', 'Home')

@section('body')
<link rel="stylesheet" type="text/css" href="css/home.css" media="screen" />
    <form action="{{ route('task_register') }}" method="post">
        @csrf
        <label for="name">Title</label>
        <input type="text" name="title" required>

        <label for="description">Description</label>
        <input type="text" name="description" required>

        <label for="category">Category</label>
        <input type="text" name="category" required>

        <button type="submit">Submit</button>
    </form>
    
    @if ($tasks->isEmpty())
        <p>No tasks found</p>
    @else
        <ul>
            @foreach ($tasks as $task)
                <li>
                    <strong>{{ $task->title }}</strong> - {{ $task->description }}
                    <br>
                    <em>Category: {{ $task->category }}</em>
                    <br>
                    <form action="{{ route('delete_task', $task->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">DELETE</button>
                    </form>
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <button>Edit</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
