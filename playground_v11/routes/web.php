<?php

use Illuminate\Support\Facades\Route;

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

Route::controller(\App\Http\Controllers\Admin\AdminIdentification::class)->group(function () {
    Route::match(['get', 'post'], 'login', 'login')->name('login');
    Route::post('logout', function () {
        \Illuminate\Support\Facades\Auth::logout();
        return redirect(\route('login'));
    })->name('logout');
});
Route::controller(\App\Http\Controllers\Admin\AdminController::class)->middleware(\App\Http\Middleware\Admin\AdminCheck::class)->group(function () {
    Route::get('admin', 'admin')->name('admin');
    Route::get('users', 'users')->name('users');
    Route::get('games', 'games')->name('games');

    Route::get('game/{slug}', 'game')->name('game');


    Route::post('user_ban', 'user_ban')->name('user_ban');
    Route::post('user_unban', 'user_unban')->name('user_unban');


    Route::post('drop_version_score', 'drop_version_score')->name('drop_version_score');
    Route::post('drop_all_user_score', 'drop_all_user_score')->name('drop_all_user_score');
    Route::post('drop_score', 'drop_score')->name('drop_score');

    Route::post('game_delete', 'game_delete')->name('game_delete');
    Route::post('game_refresh', 'game_refresh')->name('game_refresh');
});


Route::get('user/{username}', [\App\Http\Controllers\Admin\AdminController::class,'user'])->name('user');
