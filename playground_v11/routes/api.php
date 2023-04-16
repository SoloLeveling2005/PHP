<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::controller(\App\Http\Controllers\Api\ApiIdentification::class)->prefix('auth')->group(function () {
    Route::post('signup', 'signup')->name('signup');
    Route::post('signin', 'signin')->name('signin');
    Route::post('signout', 'signout')->middleware('auth:sanctum')->name('signout');
});

Route::middleware('auth:sanctum')->prefix('games')->controller(\App\Http\Controllers\Api\ApiController::class)->group(function () {
    Route::post('/{slug}/upload', 'version_upload')->name('version_upload');
    Route::match(['get', 'post'], '/{slug}/scores', 'scores')->name('scores');
    Route::get('/{slug}/{version}', 'version_file')->name('version_file');


    Route::match(['get','post'], '/', 'games')->name('games');
    Route::match(['get','put', 'delete'], '/{slug}', 'game')->name('game');

});

Route::get('users/{username}',[\App\Http\Controllers\Api\ApiController::class, 'users'])->middleware('auth:sanctum')->name('users');
