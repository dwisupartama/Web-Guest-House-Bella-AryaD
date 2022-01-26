<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeLandingController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\AdminController;

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

// Auth Route
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//User Route
Route::get('/', [HomeLandingController::class, 'homePage'])->name('landing.home');
Route::get('/booking', [HomeLandingController::class, 'bookingPage'])->name('landing.booking');
Route::get('/content', [HomeLandingController::class, 'contentPage'])->name('landing.content');
Route::get('/contactus', [HomeLandingController::class, 'contactusPage'])->name('landing.contactus');

//Admin Route
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
], function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [LoginController::class, 'loginPage'])->name('login');
        Route::post('login', [LoginController::class, 'loginProses'])->name('proses');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboardPage'])->name('dashboard');
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');

        Route::resource('data-admin', AdminController::class);
    });
});
