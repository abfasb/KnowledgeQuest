<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login');


Route::get('/register', [UserController::class, 'viewRegister'])->name('register');
Route::post('/register',  [UserController::class, 'register'])->name('register');
