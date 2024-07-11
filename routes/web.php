<?php

use App\Http\Controllers\PortofolioController;
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

Route::get('/', [PortofolioController::class, 'welcome']);

Route::get('/login', fn() => view('login'));

Route::get('/home', fn() => view('auth.home'));

Route::controller(PortofolioController::class)->group(function() {
    Route::get('/portofolio', 'index')->name('auth.portofolio');
    Route::post('/portofolio/store', 'store')->name('auth.portofolio');
    Route::post('/portofolio/update/{portofolios}', 'update')->name('auth.portofolio');
    Route::get('/portofolio/destroy/{portofolios}', 'destroy')->name('auth.portofolio');
});