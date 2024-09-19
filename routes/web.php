<?php

use App\Http\Controllers\SignInController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Rota para login
Route::get('/signin', function () {
    return view('signin');
})->name('login');
Route::post('/signin', [SignInController::class, 'signin'])->name('login');

// Rota para cadastro
Route::get('/signup', function () {
    return view('signup');
})->name('signup');
Route::post('/signup', [SignUpController::class, 'signup'])->name('signup');

// Rota para obter todas as tarefas por usuário autenticado
Route::get('/tasks/get', [TaskController::class, 'getAllTasksByUserId'])->middleware('auth');

// Rota para exibir a página home e listar as tarefas do usuário
Route::get('/home', [TaskController::class, 'index'])->name('home')->middleware('auth');

// Rota para cadastrar uma nova tarefa
Route::post('/home', [TaskController::class, 'store'])->middleware('auth')->name('task_register');

// Rota para deletar uma tarefa pelo ID
Route::delete('/tasks/{id}', [TaskController::class, 'deleteTask'])->middleware('auth')->name('delete_task');

// Rota para listar todas as tarefas de um usuário
Route::get('/tasks', [TaskController::class, 'getAllTasksByUser'])->middleware('auth');

Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit')->middleware('auth');

Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update')->middleware('auth');
