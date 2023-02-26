<?php

use Illuminate\Support\Facades\Route;

// todo post -> login admin
Route::post('/login', [\App\Http\Controllers\Admin\AdminPanel::class, 'login'])->name('login');
//Route::get('login', [\App\Http\Controllers\Admin\AdminPanel::class, 'login']);

// todo get -> return admin blade
Route::get('/admin', [\App\Http\Controllers\Admin\AdminPanel::class, 'index']);
//Route::post('admin', [\App\Http\Controllers\Admin\AdminPanel::class, 'index']);

