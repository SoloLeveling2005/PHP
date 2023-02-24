<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\adminAuth;

Route::prefix('admin')->middleware(['auth','authAdminPanel'])->group(function () {
    Route::get('/', function () {
        return "/";
    });

//    Route::get('/user/profile', function () {
//        return "/user/profile";
//    });
});


Route::prefix('auth')->group(function () {
    Route::get('/', function () {
        return view('identification');
    })->name('login');

//    Route::get('/user/profile', function () {
//        return "/user/profile";
//    });

    Route::post('/auth', [adminAuth::class, 'login']);
});
