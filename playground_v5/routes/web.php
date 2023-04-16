<?php

use Illuminate\Support\Facades\Route;
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


Route::middleware(App\Http\Middleware\Admin\AdminAuth::class)->controller(AdminPanel::class)->group(function () {
    Route::get('admin', 'admins')->name('admins');
    Route::get('users', 'users')->name('users');
    Route::get('games', 'games')->name('games');

    Route::get('game/{slug}', 'game')->name('game');

//    score actions
    Route::post('delete_one_score/{score_id}','delete_one_score')->name('delete_one_score');
    Route::post('delete_all_user_score/{user_id}/{game_version_id}','delete_all_user_score')->name('delete_all_user_score');
    Route::post('delete_all_game_version_score/{game_version_id}','delete_all_game_version_score')->name('delete_all_game_version_score');

//    user actions
    Route::post('user_ban/{user_id}','user_ban')->name('user_ban');
    Route::post('user_unban/{user_id}','user_unban')->name('user_unban');

//    game actions
    Route::post('game_delete/{game_id}','game_delete')->name('game_delete');
    Route::post('game_refresh/{game_id}','game_refresh')->name('game_refresh');


});
Route::get('user/{username}', [AdminPanel::class,'user'])->name('user');

Route::match(['get', 'post'], '/auth', [\App\Http\Controllers\Admin\AdminAuthorization::class, 'auth'])->name('auth');
Route::post('logout', [\App\Http\Controllers\Admin\AdminAuthorization::class, 'logout'])->name('logout');
