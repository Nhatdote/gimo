<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return 12345;
});

Route::get('/users', [Controller::class, 'users'])->name('users');
Route::get('/departments', [Controller::class, 'departments'])->name('departments');
Route::get('/export', [Controller::class, 'export'])->name('export');
