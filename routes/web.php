<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

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
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/users', [UsersController::class, 'index'])->name('users.index');
Route::get('/create', [UsersController::class, 'create'])->name('users.create');
Route::post('/create', [UsersController::class, 'store'])->name('users.store');
Route::get('/{user}/show', [UsersController::class, 'show'])->name('users.show');
Route::get('/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
Route::patch('/{user}/update', [UsersController::class, 'update'])->name('users.update');
Route::delete('/{user}/delete', [UsersController::class, 'destroy'])->name('users.destroy');
});