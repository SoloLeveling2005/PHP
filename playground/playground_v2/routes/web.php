<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\Admin\AdminAuth;
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

    /**
     * auth user
     */
    Route::middleware(AdminAuth::class)->group(function () {

    });


    Route::get('login', [AdminController::class, 'login_get'])->name('login_get');
    Route::post('login', [AdminController::class, 'login_post'])->name('login_post');
});
