<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->group( function () {
    Route::get('task/todo', [\App\Http\Controllers\API\TaskController::class, 'todo']);
    Route::get('task/done', [\App\Http\Controllers\API\TaskController::class, 'done']);

    Route::post('task', [\App\Http\Controllers\API\TaskController::class, 'create']);
    Route::put('task/{id}', [\App\Http\Controllers\API\TaskController::class, 'update']);
    Route::delete('task/{id}', [\App\Http\Controllers\API\TaskController::class, 'delete']);
});
