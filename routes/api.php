<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\IndexController;
use GuzzleHttp\Middleware;
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

Route::group(['prefix' => 'v1',], function () {

    Route::group(['prefix' => 'auth'], function () {
        //done
        Route::post('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
    });

    Route::group(['prefix' => 'users'], function () {
        //done
        Route::get('/myprofile', [AuthController::class, 'get_profile'])->middleware('auth:sanctum');
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    });

    Route::group(['prefix' => 'characters'], function () {
            //done
            Route::get('/', [CharacterController::class, 'index']);
            Route::get('/{id}', [CharacterController::class, 'get'])->where(['id' => '[0-9]+']);
            Route::get('/{id}/episodes', [CharacterController::class, 'getEpisodes'])->where(['id' => '[0-9]+']);
            Route::post('/', [CharacterController::class, 'store']);
            Route::put('/{id}', [CharacterController::class, 'update'])->where(['id' => '[0-9]+']);
            Route::delete('/{id}', [CharacterController::class, 'destroy'])->where(['id' => '[0-9]+']);
            //not done
            Route::post('/{id}/image', [CharacterController::class, 'storeImage'])->where(['id' => '[0-9]+']);
            Route::delete('/{id}/image/{image_id}', [CharacterController::class, 'destroyImage'])->where(['id' => '[0-9]+']);
        });

        Route::group(['prefix' => 'locations'], function () {
            //done
            Route::get('/', [LocationController::class, 'index']);
            Route::get('/{id}', [LocationController::class, 'get'])->where(['id' => '[0-9]+']);
            Route::post('/', [LocationController::class, 'store']);
            Route::put('/{id}', [LocationController::class, 'update'])->where(['id' => '[0-9]+']);
            Route::delete('/{id}', [LocationController::class, 'destroy'])->where(['id' => '[0-9]+']);
            //not done
            Route::post('/{id}/image', [LocationController::class, 'storeImage'])->where(['id' => '[0-9]+']);
            Route::delete('/{id}/image/{image_id}', [LocationController::class, 'destroyImage'])->where(['id' => '[0-9]+']);
        });

        Route::group(['prefix' => 'images'], function () {
            Route::post('/', [ImageController::class, 'store']);
            Route::delete('/{id}', [ImageController::class, 'destroy'])->where(['id' => '[0-9]+']);
        });

        Route::group(['prefix' => 'episodes'], function () {
            //done
            Route::get('/', [EpisodeController::class, 'index']);
            Route::get('/{id}', [EpisodeController::class, 'get'])->where(['id' => '[0-9]+']);
            Route::get('/{id}/characters', [EpisodeController::class, 'getCharacters'])->where(['id' => '[0-9]+']);
            Route::post('/', [EpisodeController::class, 'store']);
            Route::put('/{id}', [EpisodeController::class, 'update'])->where(['id' => '[0-9]+']);
            Route::delete('/{id}', [EpisodeController::class, 'destroy'])->where(['id' => '[0-9]+']);
            //not done
            Route::post('/{id}/image', [LocationController::class, 'storeImage'])->where(['id' => '[0-9]+']);
            Route::delete('/{id}/image/{image_id}', [LocationController::class, 'destroyImage'])->where(['id' => '[0-9]+']);
            Route::post('/{id}/characters', [LocationController::class, 'addCharacter'])->where(['id' => '[0-9]+']);
            Route::delete('/{id}/characters/{character_id}', [LocationController::class, 'deleteCharacter'])->where(['id' => '[0-9]+']);
        });
});

