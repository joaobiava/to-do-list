<?php

use App\http\Controllers\SignInController;
use App\Http\Controllers\SignUpController;
use Illuminate\Support\Facades\Route;

Route::get('/signin', function () {
    return view('signin');
})->name('signin');
Route::post('/signin', [SignInController::class, 'signin'])->name('signin');

Route::get('/signup', function (){
    return view('signup');
})->name('signup');
Route::post('/signup', [SignUpController::class, 'signup'])->name('signup');

Route::get('/home', function(){
    return view('home');
})->name('home');
Route::post('/home', [TaskController::class, 'store']);
