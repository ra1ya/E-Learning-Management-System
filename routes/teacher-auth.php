<?php

use App\Http\Controllers\Teacher\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Teacher\CoursesController;
use App\Http\Controllers\Teacher\HomeworkController;
use App\Http\Controllers\Teacher\ProfileController;
use App\Http\Controllers\Teacher\QuestionController;
use App\Http\Controllers\Teacher\ResultController;
use App\Http\Controllers\Teacher\StudentAnswerController;
use App\Http\Controllers\Teacher\StudentsController;
use App\Http\Controllers\Teacher\TestanswerController;
use App\Http\Controllers\Teacher\TestController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:teacher')->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:teacher')->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('dashboard', function () {
        return view('teacher.dashboard');
    })->name('dashboard');

    Route::resource('course', CoursesController::class);
    Route::resource('student', StudentsController::class)->only(['index', 'show']);
    Route::resource('homework', HomeworkController::class);
    Route::resource('question', QuestionController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
    Route::resource('studentanswer', StudentAnswerController::class)->only(['index', 'show']);
    Route::resource('test', TestController::class);
    Route::resource('testanswer', TestanswerController::class)->only(['index', 'show']);
    Route::resource('results', ResultController::class);

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
