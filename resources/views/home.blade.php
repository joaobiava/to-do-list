@extends('layouts.base')

@section('title', 'Home')

@section('body')
<!-- Incluindo o CSS do Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <!-- Formulário para adicionar nova tarefa -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Create New Task</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('task_register') }}" method="post">
                        @csrf

                        <!-- Campo Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>

                        <!-- Campo Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" required>
                        </div>

                        <!-- Campo Category -->
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" class="form-control" name="category" required>
                        </div>

                        <!-- Botão Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de Tarefas -->
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            @if ($tasks->isEmpty())
                <div class="alert alert-info text-center">
                    No tasks found
                </div>
            @else
                <ul class="list-group">
                    @foreach ($tasks as $task)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $task->title }}</strong> - {{ $task->description }}
                                <br>
                                <em>Category: {{ $task->category }}</em>
                            </div>
                            <div>
                                <!-- Botão Editar -->
                                <form action="{{ route('tasks.edit', $task->id) }}" method="GET" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-secondary">Edit</button>
                                </form>

                                <!-- Botão Deletar -->
                                <form action="{{ route('delete_task', $task->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>

<!-- Incluindo o JS do Bootstrap (opcional, apenas se necessário para componentes interativos) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
