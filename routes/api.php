<?php

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

Route::namespace('Todo')
    ->middleware(['api', 'auth:api'])
    ->prefix('todos')
    ->group(function () {
        Route::get('/', [\App\Http\Controllers\TodoController::class, 'index']);
        Route::get('/{todoId}', [\App\Http\Controllers\TodoController::class, 'show']);
        Route::post('/', [\App\Http\Controllers\TodoController::class, 'store']);
        Route::put('/{todoId}', [\App\Http\Controllers\TodoController::class, 'update']);
        Route::delete('/{todoId}', [\App\Http\Controllers\TodoController::class, 'destroy']);

        Route::post('/{todoId}/item', 'Item\CreateOrUpdateItem');
        Route::put('/{todoId}/item/{itemId}', 'Item\CreateOrUpdateItem');
        Route::delete('/{todoId}/item/{itemId}', [\App\Http\Controllers\TodoItemController::class, 'delete']);
    });

Route::namespace('Auth')
    ->middleware([])
    ->prefix('auth')
    ->group(function () {
        Route::post('login', 'Login');
    });

Route::namespace('Auth')
    ->middleware(['api', 'auth:api'])
    ->prefix('auth')
    ->group(function () {
        Route::post('refresh', [\App\Http\Controllers\AuthController::class, 'refresh']);
        Route::get('me', [\App\Http\Controllers\AuthController::class, 'me']);
        Route::get('token', [\App\Http\Controllers\AuthController::class, 'token']);
    });
