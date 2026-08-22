<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\View\Components\AdminAppLayout;
use App\View\Components\StudentsAppLayout;
use Illuminate\Support\Facades\Blade;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Blade::component('admin-app-layout', AdminAppLayout::class);
        Blade::component('students-app-layout', StudentsAppLayout::class);
    }
}
