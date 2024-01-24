<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StadiumController;
use App\Http\Controllers\Admin\ReserveController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\RuleController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['login_auth']], function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/booking/{id}', [BookingController::class,'index'])->name('booking');
    Route::get('/booking', [BookingController::class,  'indexAll'])->name('bookingAll');
    Route::post('/addbooking', [BookingController::class, 'addBooking'])->name('addBooking');
    Route::get('/editbooking', [BookingController::class, 'editBooking'])->name('editBooking');
    Route::post('/updatebooking/{id}', [BookingController::class, 'updateBooking'])->name('updateBooking');
    Route::post('/deletebooking/{id}', [BookingController::class, 'deleteBooking'])->name('deleteBooking');

    Route::get('/stadium/{id}', [StadiumController::class, 'getStadium'])->name('getStadium');

    Route::group(['middleware' => ['admin_auth']], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/stadium', [StadiumController::class, 'index'])->name('stadium');
        Route::post('/addstadium', [StadiumController::class, 'addStadium'])->name('addStadium');
        Route::get('/editstadium', [StadiumController::class, 'editStadium'])->name('editStadium');
        Route::post('/updatestadium/{id}', [StadiumController::class, 'updateStadium'])->name('updateStadium');
        Route::post('/deletestadium/{id}', [StadiumController::class, 'deleteStadium'])->name('deleteStadium');

        Route::get('/reserve', [ReserveController::class, 'index'])->name('reserve');
        Route::post('/addreserve', [ReserveController::class, 'addReserve'])->name('addReserve');
        Route::get('/editreserve', [ReserveController::class, 'editReserve'])->name('editReserve');
        Route::post('/deletereserve/{id}', [ReserveController::class, 'deleteReserve'])->name('deleteReserve');
        Route::post('/updatereserve/{id}', [ReserveController::class, 'updateReserve'])->name('updateReserve');


        Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
        Route::post('/addpayment', [PaymentController::class, 'addPayment'])->name('addPayment');
        Route::get('/editpayment', [PaymentController::class, 'editPayment'])->name('editPayment');
        Route::post('/deletepayment', [PaymentController::class, 'deletePayment'])->name('deletePayment');

        Route::get('/rule', [RuleController::class, 'index'])->name('rule');
        Route::post('/addrule', [RuleController::class, 'addRule'])->name('addRule');
        Route::post('/updaterule', [RuleController::class, 'updateRule'])->name('updateRule');


    });
});
