<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    return $request->user();
});

Route::post('/booking/newClient', [BookingController::class, 'newClient'])->name('booking.newClient');
Route::post('/booking/rooms', [BookingController::class, 'getRooms'])->name('booking.rooms');
Route::post('/checkDate', [BookingController::class, 'checkDate'])->name('booking.checkDate');
Route::post('/booking/new', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/calendar', [BookingController::class, 'getCalendar'])->name('booking.calendar');
Route::put('/booking/update/{id}', [BookingController::class, 'update'])->name('booking.update');