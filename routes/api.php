<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

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

Route::get('/test', [IndexController::class, 'test']);

Route::group(['prefix' => 'v1'], function () {

    Route::group(['prefix' => 'characters'], function () {
        Route::get('/', [CharacterController::class, 'index']);
        Route::get('/{id}', [CharacterController::class, 'show'])->where(['id' => '[0-9]+']);
        Route::post('/', [CharacterController::class, 'store']);
        Route::put('/{id}', [CharacterController::class, 'update'])->where(['id' => '[0-9]+']);
        Route::delete('/{id}', [CharacterController::class, 'destroy'])->where(['id' => '[0-9]+']);
    });

});

