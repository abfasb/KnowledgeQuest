<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AdminController;

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


Route::get('/admin/classes', [AdminController::class, 'getClasses']);
Route::post('/admin/classes', [AdminController::class, 'createClass']);
Route::put('/admin/classes/{id}', [AdminController::class, 'updateClass']);
Route::delete('/admin/classes/{id}', [AdminController::class, 'deleteClass']);
    
    // Class Students
Route::get('/admin/classes/{classId}/students', [AdminController::class, 'getClassStudents']);
Route::post('/admin/classes/{classId}/students/{studentId}', [AdminController::class, 'updateStudentStatus']);
    
    // Quiz Management
Route::get('/admin/quizzes', [AdminController::class, 'getQuizzes']);
Route::get('/admin/classes/{classId}/quizzes', [AdminController::class, 'getQuizzes']);
Route::post('/admin/quizzes', [AdminController::class, 'createQuiz']);
Route::put('/admin/quizzes/{id}', [AdminController::class, 'updateQuiz']);
Route::delete('/admin/quizzes/{id}', [AdminController::class, 'deleteQuiz']);
Route::post('/admin/quizzes/{id}/publish', [AdminController::class, 'publishQuiz']);
Route::post('/admin/quizzes/{id}/unpublish', [AdminController::class, 'unpublishQuiz']);
    
    // Quiz Questions
Route::get('/admin/quizzes/{quizId}/questions', [AdminController::class, 'getQuestions']);
Route::post('/admin/questions', [AdminController::class, 'createQuestion']);
Route::put('/admin/questions/{id}', [AdminController::class, 'updateQuestion']);
Route::delete('/admin/questions/{id}', [AdminController::class, 'deleteQuestion']);
Route::post('/admin/questions/reorder', [AdminController::class, 'updateQuestionOrder']);
    
    // Quiz Attempts & Results
Route::get('/admin/quizzes/{quizId}/attempts', [AdminController::class, 'getQuizAttempts']);
Route::get('/admin/attempts/{attemptId}', [AdminController::class, 'getQuizAttemptDetails']);
Route::put('/admin/answers/{answerId}', [AdminController::class, 'updateAttemptAnswer']);
    
    // Student Quizzes (Taking quizzes from admin panel)
Route::get('/admin/student/quizzes', [AdminController::class, 'getStudentQuizzes']);
Route::post('/admin/student/quizzes/{quizId}/start', [AdminController::class, 'startQuizAttempt']);
Route::post('/admin/attempts/{attemptId}/answers', [AdminController::class, 'submitQuizAnswer']);
Route::post('/admin/attempts/{attemptId}/complete', [AdminController::class, 'completeQuizAttempt']);
Route::get('/admin/student/attempts', [AdminController::class, 'getStudentAttempts']);
Route::get('/admin/student/attempts/{attemptId}', [AdminController::class, 'getStudentAttemptDetails']);
    
    // Analytics
Route::get('/admin/analytics', [AdminController::class, 'getAnalytics']);