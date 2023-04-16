<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\Admin\AdminAuth;
use \App\Http\Controllers\Admin\AdminPanel;
use \App\Http\Controllers\Admin\AdminLogin;
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
Route::prefix('XX-module-a')->group(function () {
    Route::middleware(AdminAuth::class)->group(function () {
        Route::get('admin', [AdminPanel::class,'index'])->name('index');

        Route::post('user_ban', [AdminPanel::class,'user_ban'])->name('user_ban');
        Route::post('user_unban', [AdminPanel::class,'user_unban'])->name('user_unban');

        Route::get('logout', function () {
            Auth::guard('admin')->logout();
            return redirect()->route('GetLogin');
        })->name('logout');

        Route::post('reset_all_user_score', [AdminPanel::class, 'reset_all_user_score'])->name('reset_all_user_score');
        Route::post('reset_all_game_score', [AdminPanel::class, 'reset_all_game_score'])->name('reset_all_game_score');
        Route::post('reset_user_score', [AdminPanel::class, 'reset_user_score'])->name('reset_user_score');

        Route::post('game_delete', [AdminPanel::class, 'game_delete'])->name('game_delete');
        Route::post('game_recovery', [AdminPanel::class, 'game_recovery'])->name('game_recovery');
        Route::post('game_filter', [AdminPanel::class, 'game_filter'])->name('game_filter');

    });
    Route::get('game/{slug}', [AdminPanel::class,'game'])->name('game');
    Route::get('user/{username}', [AdminPanel::class,'user'])->name('user');

    Route::post('login', [AdminLogin::class,'login'])->name('PostLogin');
    Route::get('login', function () {
        return view('login');
    })->name('GetLogin');

});

