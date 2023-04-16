<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\ApiIdentification;
use \App\Http\Controllers\Api\ApiController;
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
//
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('/auth')->controller(ApiIdentification::class)->group(function () {
    Route::post('/signup', 'signup')->name('signup');
    Route::post('/signin', 'signin')->name('signin');
    Route::post('/signout', 'signout')->middleware('auth:sanctum')->name('signout');
});



Route::prefix('games')->middleware('auth:sanctum')->controller(ApiController::class)->group(function () {
    Route::match(['get', 'post'], '/', 'games')->name('games');

    Route::match(['get','post'], '{slug}/scores', 'scores')->name('scores');

    Route::post('/{slug}/upload', 'upload_v')->name('upload_v');

    Route::get('/{slug}/{version}', 'get_file')->name('get_file');

    Route::match(['get', 'put', 'delete'], '/{slug}/', 'game')->name('game');
});
Route::get('users/{username}', [ApiController::class, 'users'])->middleware('auth:sanctum')->name('users');
