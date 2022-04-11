<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeLandingController;

use App\Http\Controllers\User\ContentController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\DataBookingController;
use App\Http\Controllers\User\DataCartController;
use App\Http\Controllers\User\DataProfileSettingController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProfileSettingController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KamarController;
use App\Http\Controllers\Admin\KontenController;
use App\Http\Controllers\Admin\GambarController;
use App\Http\Controllers\Admin\ReservasiController;

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

Route::get('/booking', [BookingController::class, 'index'])->name('landing.booking');
Route::post('/booking', [BookingController::class, 'indexWithData'])->name('landing.booking.withData');
Route::get('/booking/room/{id}', [BookingController::class, 'detailKamarBooking'])->name('landing.booking.room');

Route::middleware('auth:web')->group(function(){
    Route::post('/user/add-to-cart', [DataCartController::class, 'addToCart'])->name('landing.booking.addToCart');
    Route::get('/user/cart-list', [DataCartController::class, 'cartList'])->name('landing.user.cartList');
    Route::delete('/user/cart-list/{id}', [DataCartController::class, 'cartDelete'])->name('landing.user.cartList.destroy');

    Route::post('/user/process-booking', [DataBookingController::class, 'processBooking'])->name('landing.user.processBooking');
    Route::get('/user/booking-list', [DataBookingController::class, 'bookingList'])->name('landing.user.bookingList');
    Route::get('/user/booking-detail/{id}', [DataBookingController::class, 'bookingDetail'])->name('landing.user.bookingDetail');
    Route::get('/user/booking-cancle/{id}', [DataBookingController::class, 'batalkanBooking'])->name('landing.user.batalkanBooking');

    Route::get('/user/profile-setting', [DataProfileSettingController::class, 'profileSetting'])->name('landing.user.profileSetting');
    Route::post('/user/profile-setting/update', [DataProfileSettingController::class, 'updateProfile'])->name('landing.user.profileSetting.update');
    Route::post('/user/profile-setting/reset', [DataProfileSettingController::class, 'resetPassword'])->name('landing.user.profileSetting.reset');

    Route::get('/get-count-cart/{id}', [HomeLandingController::class, 'jumlahCartUser'])->name('landing.getCountCart');
    Route::get('/get-count-booking/{id}', [HomeLandingController::class, 'jumlahBookingUser'])->name('landing.getCountBooking');
});

Route::get('/content', [ContentController::class, 'index'])->name('landing.content');
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

        Route::get('profile-setting', [ProfileSettingController::class, 'index'])->name('profileSetting');
        Route::post('profile-setting/update', [ProfileSettingController::class, 'update'])->name('profileSetting.update');
        Route::post('profile-setting/reset-password', [ProfileSettingController::class, 'resetPassword'])->name('profileSetting.resetPassword');

        Route::resource('data-admin', AdminController::class);
        Route::resource('data-user', UserController::class);
        Route::resource('data-kamar', KamarController::class);
        Route::resource('data-konten', KontenController::class);
        Route::resource('data-gambar', GambarController::class);

        // Route Reservasi
        Route::get('data-reservasi', [ReservasiController::class, 'index'])->name('data-reservasi.index');
        Route::get('data-reservasi/proses/{id}', [ReservasiController::class, 'proses'])->name('data-reservasi.proses');
        Route::get('data-reservasi/batal/{id}', [ReservasiController::class, 'batal'])->name('data-reservasi.batal');
        Route::get('data-reservasi/telah-dibayarkan/{id}', [ReservasiController::class, 'telahDibayarkan'])->name('data-reservasi.telahDibayarkan');
        Route::get('data-reservasi/batal-pembayaran/{id}', [ReservasiController::class, 'batalPembayaran'])->name('data-reservasi.batalPembayaran');
        Route::get('data-reservasi/checkin-all/{id}', [ReservasiController::class, 'checkInAll'])->name('data-reservasi.checkInAll');
        Route::get('data-reservasi/checkout-all/{id}', [ReservasiController::class, 'checkOutAll'])->name('data-reservasi.checkOutAll');
        Route::get('data-reservasi/checkin-room/{id_reservasi}/{id_kamar}', [ReservasiController::class, 'checkInRoom'])->name('data-reservasi.checkInRoom');
        Route::get('data-reservasi/checkout-room/{id_reservasi}/{id_kamar}', [ReservasiController::class, 'checkOutRoom'])->name('data-reservasi.checkOutRoom');
    });
});
