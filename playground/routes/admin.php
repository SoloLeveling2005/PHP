<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth','authAdminPanel'])->group(function () {
    Route::get('/', function () {
        return "/";
    });

    Route::get('/user/profile', function () {
        return "/user/profile";
    });
});


Route::prefix('auth')->group(function () {
    Route::get('/', function () {
        return "/auth";
    })->name('login');

    Route::get('/user/profile', function () {
        return "/user/profile";
    });
});
