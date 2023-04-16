<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\AdminController;
use \App\Http\Middleware\Admin\AdminAuth;
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


Route::middleware(AdminAuth::class)->controller(AdminController::class)->group(function () {
    Route::get('/admin', 'admin')->name('admin');

    Route::get('/users', 'users')->name('users');
    Route::get('/user/{username}', 'user')->name('user');

    Route::get('/games', 'games')->name('games');
    Route::get('/game/{slug}', 'game')->name('game');
});
Route::match(['get', 'post'], '/admin/auth', [\App\Http\Controllers\Admin\AdminAuth::class, 'auth'])->name('auth');
