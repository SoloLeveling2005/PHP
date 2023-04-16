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
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::controller(ApiIdentification::class)->prefix('auth')->group(function () {
//    todo POST requests (change later)
    Route::post('signup', 'signup')->name('signup');
    Route::post('signin', 'signin')->name('login');
    Route::middleware('auth:sanctum')->post('signout', 'signout')->name('signout');
});


//Route::middleware('auth:sanctum')->controller(ApiController::class)->prefix('games')->group(function () {
Route::middleware('auth:sanctum')->controller(ApiController::class)->prefix('games')->group(function () {
    // Route::get('/', 'gamesGet')->name('gamesGet');
    // Route::post('/', 'gamesPost')->name('gamesPost');

    Route::post('/', 'games')->name('games');

    // Route::get('/{slug}', 'gameGet')->name('gameGet');
    // Route::put('/{slug}', 'gamePut')->name('gamePut');
    // Route::delete('/{slug}', 'gameDelete')->name('gameDelete');

    Route::match(['get', 'put', 'delete'], '/{slug}', 'game')->name('game');

    // Route::get('/{slug}/scores', 'gameScoreGet')->name('gameScoreGet');
    // Route::post('/{slug}/scores', 'gameScorePost')->name('gameScorePost');

    Route::match(['get', 'post'], '/{slug}/scores', 'gameScore')->name('gameScore');

    Route::post('/{slug}/upload', 'upload_v')->name('upload_v');

    
});
Route::controller(ApiController::class)->prefix('games')->group(function () {
    Route::get( '/', 'games')->name('games');

    Route::get( '/{slug}', 'game')->name('game');

    Route::get( '/{slug}/scores', 'gameScore')->name('gameScore');

    Route::get('/{slug}/{version}', 'game_v')->name('game_v')->where('version', '(.*)');
    
});


Route::middleware('auth:sanctum')->controller(ApiController::class)->prefix('users')->group(function () {
    Route::get('/{username}', 'user')->name('user');
});


// Route::fallback(function () {
//    return response([
//        "status"=> "not-found",
//         "message"=> "Not found"
//    ], 404);
// });
