<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\AdminPanel;
use \App\Http\Controllers\Admin\AdminLogin;
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



Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');
    Route::post('/login', [AdminLogin::class, 'login'])->name('login_POST');
});

Route::controller(AdminPanel::class)->group(function () {
      Route::get('/admin', 'index')->name('admin');


      // todo
      Route::get('user/{username}', function ($username) {
        return $username;
      })->name('user');

    Route::get('game/{slug}', function ($slug) {
        return $slug;
    })->name('game');
});
