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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(\App\Http\Controllers\Api\ApiIdentification::class)->prefix('auth')->group(function () {
    Route::post('signup', 'signup')->name('signup');
    Route::post('signin', 'signin')->name('signin');
    Route::post('signout', 'signout')->middleware('auth:sanctum')->name('signout');
});


Route::controller(\App\Http\Controllers\Api\ApiController::class)->middleware('auth:sanctum')->prefix('games')->group(function () {
    Route::match(['POST', 'GET'], '/', 'games')->name('games');
    Route::match(['GET', 'PUT', 'DELETE'], '/{slug}', 'game')->name('game');
    Route::match(['POST', 'GET'], 'scores/{slug}', 'scores')->name('scores');
    Route::match(['POST'], '/{slug}/upload', 'upload')->name('upload');
    Route::match(['GET'], '/{slug}/{version}', 'game_file')->name('game_file');
});

Route::get('/users/username', [\App\Http\Controllers\Api\ApiController::class,''])->middleware('auth:sanctum')->name('');


Route::fallback(function () {
    return response([
        "status"=> "not-found",
        "message"=> "Not found"
    ]);
});
