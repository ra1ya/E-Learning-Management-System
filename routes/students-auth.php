<?php

use App\Http\Controllers\Students\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Students\Auth\RegisteredUserController;
use App\Http\Controllers\Students\CoursesController;
use App\Http\Controllers\Students\ProfileController;
use App\Http\Controllers\Students\ResultController;
use App\Http\Controllers\Students\StudentAnswerController;
use App\Http\Controllers\Students\TestanswerController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:students')->prefix('students')->name('students.')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:students')->prefix('students')->name('students.')->group(function () {
    Route::get('dashboard', function () {
        return view('students.dashboard');
    })->name('dashboard');

    Route::resource('studentanswer', StudentAnswerController::class)->only(['index', 'create', 'store', 'show']);
    Route::get('studentanswer/result', [StudentAnswerController::class, 'result'])->name('studentanswer.result');

    Route::resource('testanswer', TestanswerController::class)->only(['index', 'create', 'store', 'show']);
    Route::get('testanswer/result', [TestanswerController::class, 'result'])->name('testanswer.result');

    Route::resource('courses', CoursesController::class)->only(['index', 'show']);
    Route::resource('results', ResultController::class)->only(['index']);

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
