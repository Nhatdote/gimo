<?php

namespace App\Providers;

use App\Models\Department;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $departments = Department::all();
        $departments = Department::parse($departments);

        View::share('departments', $departments);
    }
}
