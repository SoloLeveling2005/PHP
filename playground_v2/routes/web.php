<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\AdminAuth;
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



Route::controller(AdminController::class)->group(function() {
    Route::get('/admin', 'index')->name('index');
    Route::get('/users', 'users')->name('users');
    Route::get('/games', 'games')->name('games');

    Route::get('/user/{username}', 'user')->name('user');
    Route::get('/game/{slug}', 'game')->name('game');
});

Route::controller(AdminAuth::class)->group(function() {
    Route::get('/admin/auth', 'auth')->name('auth');
    
});