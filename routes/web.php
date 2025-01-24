<?php

use App\Http\Controllers\Admin\DashboardContoller;
use App\Http\Controllers\Teacher\DashboardContoller as TeacherDashboardContoller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function() {
    Route::controller(DashboardContoller::class)->group(function(){
        Route::get('dashboard', 'index');
    });
});

Route::prefix('teacher')->middleware(['auth'])->group(function() {
    Route::controller(TeacherDashboardContoller::class)->group(function(){
        Route::get('dashboard', 'index');
    });
});






