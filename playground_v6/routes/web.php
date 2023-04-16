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

Route::middleware(\App\Http\Middleware\Admin\AdminAuth::class)->controller(\App\Http\Controllers\Admin\AdminPanel::class)->group(function () {
    Route::get('admin', 'admins')->name('admins');
    Route::get('users', 'users')->name('users');
    Route::get('games', 'games')->name('games');

    Route::get('game/{slug}', 'game')->name('game');


    Route::post('user_ban', 'user_ban')->name('user_ban');
    Route::post('user_unban', 'user_unban')->name('user_unban');

    Route::post('game_delete', 'game_delete')->name('game_delete');
    Route::post('game_refresh', 'game_refresh')->name('game_refresh');


    Route::post('drop_user_score', 'drop_user_score')->name('drop_user_score');
    Route::post('drop_all_user_scores', 'drop_all_user_scores')->name('drop_all_user_scores');
    Route::post('drop_game_version_scores', 'drop_game_version_scores')->name('drop_game_version_scores');




    Route::post('logout', function () {
        \Illuminate\Support\Facades\Auth::logout();
        return redirect(route('login'));
    })->name('logout');
});
Route::get('user/{username}', [\App\Http\Controllers\Admin\AdminPanel::class,'user'])->name('user');
Route::get('/admin/login', [\App\Http\Controllers\Admin\AdminIdentification::class, 'login'])->name('login');
Route::post('/admin/login', [\App\Http\Controllers\Admin\AdminIdentification::class, 'login'])->name('login');
