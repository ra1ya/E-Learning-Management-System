<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\BatchesController;
use App\Http\Controllers\Admin\CoursesController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\PaymentsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Admin\StudentsController;
use App\Http\Controllers\Admin\TeachersController;
use App\Http\Controllers\Admin\ReportController;

use App\Http\Controllers\Students\StudentAnswerController;
use App\Http\Controllers\Students\TestanswerController;
use App\Http\Controllers\Teacher\HomeworkController;
use App\Http\Controllers\Teacher\ResultController;

use App\Http\Controllers\Teacher\StudentAnswerController as TeacherStudentAnswerController;

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/report/report1/{pid}', [ReportController::class, 'report1']);
Route::get('/layout', function () {
    return view('layout');
});


Route::middleware('auth:students')->group(function () {
    Route::get('students/studentanswer/result', [StudentAnswerController::class, 'result'])
        ->name('students.studentanswer.result');

        Route::get('students/testanswer/result', [TestanswerController::class, 'result'])
        ->name('students.testanswer.result');
});


Route::get('teacher/homework/{homeworkId}/result', [HomeworkController::class, 'result'])->name('teacher.homework.result');


Route::middleware('auth:teacher')->group(function () {

Route::post('/teacher/results/calculate', [ResultController::class, 'calculate'])->name('teacher.results.calculate');

});

require __DIR__.'/auth.php';
require __DIR__.'/admin-auth.php';
require __DIR__.'/teacher-auth.php';
require __DIR__.'/students-auth.php';

  












//php artisan config:clear
//php artisan route:clear
//php artisan view:clear
//أعد تشغيل التطبيق.
