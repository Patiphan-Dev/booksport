<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StadiumController;
use App\Http\Controllers\Admin\ReserveController;

use App\Http\Controllers\Users\HomeController;
use App\Http\Controllers\Users\BookingController;


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

Route::get('/navbar', [HomeController::class, 'index'])->name('navbar');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/stadium/{id}', [StadiumController::class, 'getStadium'])->name('getStadium');

Route::group(['middleware' => ['login_auth']], function () { // ล็อคอินถึงจะเข้าได้

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/booking/{id}', [BookingController::class,'index'])->name('booking');
    Route::get('/booking', [BookingController::class,  'indexAll'])->name('bookingAll');
    Route::post('/addbooking', [BookingController::class, 'addBooking'])->name('addBooking');
    Route::get('/editbooking', [BookingController::class, 'editBooking'])->name('editBooking');
    Route::post('/updatebooking/{id}', [BookingController::class, 'updateBooking'])->name('updateBooking');
    Route::post('/deletebooking/{id}', [BookingController::class, 'deleteBooking'])->name('deleteBooking');

    Route::group(['middleware' => ['admin_auth']], function () { // สถานะ 9 หรือแอดมินถึงจะเข้าได้

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/stadium', [StadiumController::class, 'index'])->name('stadium');
        Route::post('/addstadium', [StadiumController::class, 'addStadium'])->name('addStadium');
        Route::get('/editstadium', [StadiumController::class, 'editStadium'])->name('editStadium');
        Route::post('/updatestadium/{id}', [StadiumController::class, 'updateStadium'])->name('updateStadium');
        Route::post('/deletestadium/{id}', [StadiumController::class, 'deleteStadium'])->name('deleteStadium');

        Route::get('/reserve', [ReserveController::class, 'index'])->name('reserve');
        Route::post('/addreserve', [ReserveController::class, 'addReserve'])->name('addReserve');
        Route::get('/editreserve', [ReserveController::class, 'editReserve'])->name('editReserve');
        Route::post('/updatereserve/{id}', [ReserveController::class, 'updateReserve'])->name('updateReserve');
        Route::post('/deletereserve/{id}', [ReserveController::class, 'deleteReserve'])->name('deleteReserve');

        Route::get('/user', [UserController::class, 'index'])->name('user');
        Route::post('/adduser', [UserController::class, 'addUser'])->name('addUser');
        Route::get('/edituser', [UserController::class, 'editUser'])->name('editUser');
        Route::post('/updateuser/{id}', [UserController::class, 'updateUser'])->name('updateUser');
        Route::post('/deleteuser/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');
    });
});
