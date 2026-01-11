<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuizController;

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
 
Route::get('/quiz-data', [QuizController::class, 'quizzes']);
Route::get('/categories', [QuizController::class, 'categories']);
Route::post('/quiz/submit', [QuizController::class, 'submitQuiz'])->name('quiz.submit');
Route::get('/quiz/history', [QuizController::class, 'getHistory'])->name('quiz.history');
Route::get('/dashboard/stats', [QuizController::class, 'getDashboardStats'])->name('dashboard.stats');
Route::get('/category/stats', [QuizController::class, 'getCategoryStats'])->name('category.stats');