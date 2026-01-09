<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login');


Route::get('/register', [UserController::class, 'viewRegister'])->name('register');
Route::post('/register',  [UserController::class, 'register'])->name('register');


Route::get('/student', [DashboardController::class, 'student'])->name('student.dashboard');
Route::get('/admin', [DashboardController::class, 'admin'])->name('admin.dashboard');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');