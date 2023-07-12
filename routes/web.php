<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MonitoringController;
use Illuminate\Contracts\Queue\Monitor;
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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register-proses', [LoginController::class, 'register_proses'])->name('register-proses');

Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function () {

    Route::Group(['middleware' => ['CheckAdmin']], function () {
        Route::get('/create', [HomeController::class, 'create'])->name('user.create');
        Route::post('/store', [HomeController::class, 'store'])->name('user.store');
        Route::get('/edit/{id}', [HomeController::class, 'edit'])->name('user.edit');
        Route::put('/update/{id}', [HomeController::class, 'update'])->name('user.update');
        Route::delete('/delete/{id}', [HomeController::class, 'delete'])->name('user.delete');

        Route::get('/create_monitoring', [MonitoringController::class, 'create'])->name('monitoring.create');
        Route::post('/store_monitoring', [MonitoringController::class, 'store'])->name('monitoring.store');
        Route::get('/edit_monitoring/{id}', [MonitoringController::class, 'edit'])->name('monitoring.edit');
        Route::put('/update_monitoring/{id}', [MonitoringController::class, 'update'])->name('monitoring.update');
        Route::delete('/delete_monitoring/{id}', [MonitoringController::class, 'destroy'])->name('monitoring.delete');
    });

    Route::get('/tesPing', [MonitoringController::class, 'tesPingAjax']);
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/user', [HomeController::class, 'index'])->name('index');
    Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring');


});
