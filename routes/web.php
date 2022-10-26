<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CategoriesController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::middleware(['auth'])->group(function() {
// Dashboard
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Users
Route::get('/users', [UsersController::class, 'index'])->name('users.index');
Route::post('/users/create', [UsersController::class, 'store'])->name('users.store');
Route::patch('/users/{id}/update', [UsersController::class, 'update'])->name('users.update');
Route::delete('/users/{id}/delete', [UsersController::class, 'destroy'])->name('users.destroy');

// Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::patch('/profile/{id}/update', [ProfileController::class, 'update'])->name('profile.update');
Route::patch('/profile/{id}/password', [ProfileController::class, 'password'])->name('profile.password');

// Categoiries
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [CategoriesController::class, 'show'])->name('categories.show');
Route::post('/categories/create', [CategoriesController::class, 'store'])->name('categories.store');
Route::patch('/categories/{id}/update', [CategoriesController::class, 'update'])->name('categories.update');
Route::delete('/categories/{id}/delete', [CategoriesController::class, 'destroy'])->name('categories.destroy');

//Rooms
Route::post('/room/create', [RoomController::class, 'store'])->name('room.store');
Route::patch('/room/{id}/update', [RoomController::class, 'update'])->name('room.update');
Route::delete('/room/{id}/delete', [RoomController::class, 'destroy'])->name('room.destroy');
});