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

/*
//هاذي المشكلة االلي كاتن في الاستيودنت
//Attempt to read property "name" on null
GET 127.0.0.1:8000

Route::prefix('admin')->group(function () {
    Route::resource('/student', StudentsController::class);
});
*/
// في ملف routes/web.php
/*
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [StudentsController::class, 'index'])->name('student.index');
});
*/
/*
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::resource('/student', StudentsController::class);
});
*/


/*
Route::resource('admin/teacher',TeachersController::class);
Route::prefix('admin')->group(function () {
Route::resource('course',CoursesController::class);
});
*/

//Route::resource('/report/report1/{pid}',[ReportController::class,'report1']);
//
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

//Route::get('/students/studentanswer/result', [\App\Http\Controllers\Students\StudentAnswerController::class, 'result']);
Route::get('teacher/homework/{homeworkId}/result', [HomeworkController::class, 'result'])->name('teacher.homework.result');
//Route::get('/teacher/studentanswer/{id}', [StudentAnswerController::class, 'show'])->name('teacher.studentanswer.show');

//Route::get('teacher/studentanswer/{studentanswer}', [StudentAnswerController::class, 'show']);

Route::middleware('auth:teacher')->group(function () {
  //  Route::get('/teacher/studentanswer/{id}', [StudentAnswerController::class, 'show'])->name('teacher.studentanswer.show');
 // Route::get('/teacher/results', [ResultController::class, 'index'])->name('teacher.results.index');
 // Route::get('/teacher/results', [ResultController::class, 'create'])->name('teacher.results.create');
  
Route::post('/teacher/results/calculate', [ResultController::class, 'calculate'])->name('teacher.results.calculate');

});

require __DIR__.'/auth.php';
require __DIR__.'/admin-auth.php';
require __DIR__.'/teacher-auth.php';
require __DIR__.'/students-auth.php';

  



//الخطوات الصحيحة لتثبيت Laravel Breeze
//تثبيت Laravel Breeze: تأكد أنك قمت بإعداد مشروع Laravel أولاً
//composer require laravel/breeze --dev
//ثانيا تثبيت التكديس المناسب: اختر التكديس الذي تريد تثبيته باستخدام أحد الأوامر التالية:
//php artisan breeze:install blade
//php artisan breeze:install livewire
//php artisan breeze:install livewire-functional
//php artisan breeze:install react
//php artisan breeze:install vue
//php artisan breeze:install api
//npm install
//npm run dev
//Which testing framework do you prefer? [Pest]        
//Pest ............................................ 0  
//PHPUnit...........................................1 










// تثبيت النود خطوات 
//اولا تيست النود من الموقع الرسمي ونسخ المسارات الكاملة
//C:\Program Files\nodejs\               C:\Users\AlShaheen\AppData\Roaming\npm
//تروح powershell وتشغله كمسؤول
//Set-ExecutionPolicy RemoteSigned
//تروح للفجول 
//npm -v
//npm help
//npm install
// npm run build
//npm run dev



//تحميل الكلاس Autoload
//composer dump-autoload


//انشاء الكاش 
//php artisan route:cache

//اذا واجهت مشكلة بسبب الكاش احذفها
//php artisan route:clear
//php artisan config:clear
//php artisan cache:clear
//php artisan view:clear

//اضافة الاعمدة الجديدة
//php artisan make:migration add_columns_to_table_name --table=courses 
//php artisan migrate

//حل مشكلة عدم رفع ملف بي دي اف
//DELETE FROM sessions;
//php artisan cache:clear
//php artisan config:clear
//php artisan route:clear
//php artisan view:clear
//أعد تشغيل التطبيق.
