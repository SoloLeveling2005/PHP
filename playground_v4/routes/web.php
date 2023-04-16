<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\AdminAuth as MiddlewareAdminAuth;
use \App\Http\Middleware\Admin\AdminAuth;
use \App\Http\Controllers\Admin\AdminPanel;
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


Route::controller(AdminPanel::class)->group(function () {
    Route::get('admin', 'admins')->name('admins');
    Route::get('users', 'users')->name('users');
    Route::get('user/{username}', 'user')->name('user');
    Route::get('games', 'games')->name('games');
    Route::get('game/{slug}', 'game')->name('game');
});

Route::match(['get', 'post'], '/auth', [AdminAuth::class, 'auth'])->name('auth');
