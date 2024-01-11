<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;

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

Route::get('/login', [AuthController::class, 'getLogin'])->name('getLogin');
Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
Route::get('/register', [AuthController::class, 'getRegister'])->name('getRegister');
Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['login_auth']], function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::group(['middleware' => ['admin_auth']], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });
});
