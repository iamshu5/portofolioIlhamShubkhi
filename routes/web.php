<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthLoginController;
use App\Http\Controllers\PortofolioController;

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

Route::get('/', [PortofolioController::class, 'welcome']);

Route::get('/Auth/Login', [AuthLoginController::class, 'checkLogin'])->name('login');
Route::get('/auth/logout', [AuthLoginController::class, 'usrLogout']);
Route::post('/Auth/Login', [AuthLoginController::class, 'process']);

Route::middleware('auth')->group(function() {
    Route::get('/home', [HomeController::class, 'index'])->name('auth.home');

    Route::controller(PortofolioController::class)->group(function() {
        Route::get('/portofolio', 'index')->name('auth.portofolio');
        Route::post('/portofolio/store', 'store')->name('auth.portofolio');
        Route::post('/portofolio/update/{portofolios}', 'update')->name('auth.portofolio');
        Route::get('/portofolio/destroy/{portofolios}', 'destroy')->name('auth.portofolio');
    });

    
});

Route::controller(UserController::class)->group(function() {
    Route::get('/user', 'index')->name('auth.user');
    Route::post('/user/store', 'store')->name('auth.user');
    Route::post('/user/update/{users}', 'update')->name('auth.user');
    Route::get('/user/destroy/{users}', 'destroy')->name('auth.user');
});