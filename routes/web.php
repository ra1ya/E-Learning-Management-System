<?php

use App\Http\Controllers\Admin\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/report/report1/{pid}', [ReportController::class, 'report1'])
        ->whereNumber('pid')
        ->name('admin.report.payment');
});

require __DIR__.'/admin-auth.php';
require __DIR__.'/teacher-auth.php';
require __DIR__.'/students-auth.php';
