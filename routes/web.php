<?php

use App\Http\Controllers\Admin\DashboardContoller;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Teacher\DashboardContoller as TeacherDashboardContoller;
use App\Http\Controllers\Teacher\SeedController;
use App\Http\Controllers\VikorController;
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


Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::controller(DashboardContoller::class)->group(function () {
        Route::get('dashboard', 'index')->name('dashboard-admin');
    });

    Route::controller(GuruController::class)->group(function () {
        Route::get('/guru/index', 'index')->name('guru-index');
        Route::get('/guru/create', 'create')->name('guru-create');
        Route::post('/guru/store', 'store')->name('guru-store');
    });

    Route::controller(KelasController::class)->group(function () {
        Route::get('/kelas/index', 'index')->name('kelas-index');
        Route::get('/kelas/show/{id}', 'show')->name('kelas-show');
        Route::get('/kelas/create', 'create')->name('kelas-create');
        Route::post('/kelas/store', 'store')->name('kelas-store');
        Route::get('/kelas/edit/{id}', 'edit')->name('kelas-edit');
        Route::put('/kelas/update/{id}', 'update')->name('kelas-update');

    });

    Route::controller(SiswaController::class)->group(function () {
        Route::get('/siswa/index', 'index')->name('siswa-index');
        Route::get('/siswa/create', 'create')->name('siswa-create');
        Route::post('/siswa/store', 'store')->name('siswa-store');
        Route::get('/siswa/edit/{id}', 'edit')->name('siswa-edit');
    });

    Route::controller(VikorController::class)->group(function() {
        Route::post('/calculate-ranking','calculateRanking')->name('calculate-ranking');
        Route::get('/export-ranking-page','exportRanking')->name('export-ranking');
        Route::get('/ranking-result/{tahun_ajar_id}','showRanking')->name('ranking-result');
    });
});

Route::prefix('teacher')->middleware(['auth'])->group(function () {
    Route::controller(TeacherDashboardContoller::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard-guru');
        Route::get('/students/list', 'studentShow')->name('students-list');
    });

    Route::controller(SeedController::class)->group(function(){
        Route::get('/seed/index', 'index')->name('seed-index');
        Route::get('/seed/create', 'create')->name('seed-create');
        Route::post('/seed/store', 'store')->name('seed-store');
    });
});
