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

Route::match(['get', 'post'], 'admin/login', [\App\Http\Controllers\Admin\AdminIdentification::class,'login'])->name('login');

Route::post('admin/logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return \Illuminate\Support\Facades\Redirect::route('login');
})->name('logout');


Route::controller(\App\Http\Controllers\Admin\AdminController::class)->middleware(\App\Http\Middleware\Admin\AdminAuth::class)->group(function () {
    Route::get('admin', 'admin')->name('admin');
    Route::get('users', 'users')->name('users');
    Route::get('games', 'games')->name('games');

    Route::get('game/{slug}', 'game')->name('game');

    Route::post('user_ban', 'user_ban')->name('user_ban');
    Route::post('user_unban', 'user_unban')->name('user_unban');

    Route::post('game_delete', 'game_delete')->name('game_delete');
    Route::post('game_refresh', 'game_refresh')->name('game_refresh');


    Route::post('drop_all_game_score', 'drop_all_game_score')->name('drop_all_game_score');
    Route::post('drop_user_version_score', 'drop_user_version_score')->name('drop_user_version_score');
    Route::post('drop_one_user_score', 'drop_one_user_score')->name('drop_one_user_score');



});
Route::get('user/{username}', [\App\Http\Controllers\Admin\AdminController::class,'user'])->name('user');
