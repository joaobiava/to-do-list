<?php

use App\http\Controllers\SignInController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/signin', function () {
    return view('signin');
})->name('login');
Route::post('/signin', [SignInController::class, 'signin'])->name('login');

Route::get('/signup', function (){
    return view('signup');
})->name('signup');
Route::post('/signup', [SignUpController::class, 'signup'])->name('signup');

Route::get('/tasks/get', [TaskController::class, 'getAlltasksByUserId']);

Route::get('/home', function(){
    return view('home');
})->name('home')->middleware('auth');
Route::post('/home', [TaskController::class, 'store'])->middleware('auth')->name('task_register');
