<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\BatchesController;
use App\Http\Controllers\Admin\CoursesController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\PaymentsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\StudentsController;
use App\Http\Controllers\Admin\TeachersController;
use App\Http\Controllers\studentanswerController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

  
});

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
   
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['verified'])->name('dashboard');
Route::resource('student', StudentsController::class);
Route::resource('teacher', TeachersController::class);
Route::resource('course', CoursesController::class);
Route::resource('batches',BatchesController::class);
Route::resource('enrollment',EnrollmentController::class);
Route::resource('payments',PaymentsController::class);

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

