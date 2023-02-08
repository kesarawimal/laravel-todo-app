<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'home'], function () {
    Route::get('/', [App\Http\Controllers\TaskController::class, 'index'])->name('home');
    Route::post('/add', [App\Http\Controllers\TaskController::class, 'create']);

    Route::get('/add', [App\Http\Controllers\TaskController::class, 'index'])->name('add');

    Route::get('/delete/{id}', [App\Http\Controllers\TaskController::class, 'delete']);
    Route::post('/status/{id}', [App\Http\Controllers\TaskController::class, 'status']);

    Route::get('/edit/{id}', [App\Http\Controllers\TaskController::class, 'edit'])->name('edit');
    Route::post('/edit/{id}', [App\Http\Controllers\TaskController::class, 'update'])->name('edit');
});

