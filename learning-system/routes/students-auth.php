<?php

use App\Http\Controllers\Students\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Students\Auth\RegisteredUserController;
use App\Http\Controllers\Students\CoursesController;
use App\Http\Controllers\Students\ProfileController;
use App\Http\Controllers\Students\ResultController;
use App\Http\Controllers\Students\StudentAnswerController;
use App\Http\Controllers\Students\TestanswerController;
use App\Models\Testanswer;
use Illuminate\Support\Facades\Route;
Route::middleware('guest:students')->prefix('students')->name('students.')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:students')->prefix('students')->name('students.')->group(function () {
    Route::get('dashboard', function () {
        return view('students.dashboard');
    })->middleware(['verified'])->name('dashboard');

    Route::resource('studentanswer', StudentAnswerController::class);
    Route::resource('testanswer', TestanswerController::class);
   // Route::post('studentanswer', [StudentAnswerController::class, 'store'])->name('students.studentanswer.store');
   Route::resource('courses', CoursesController::class);
    // تم تعديل المسار هنا
   // Route::get('studentanswer/result', [StudentAnswerController::class, 'result'])->name('studentanswer.result');
   Route::resource('results',ResultController::class);
  // Route::get('studentanswer', [StudentAnswerController::class, 'result']);
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});




