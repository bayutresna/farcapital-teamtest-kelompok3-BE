<?php

use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user/list', [UserController::class, 'index']);
Route::get('/user/{id}/show', [UserController::class, 'show']);
Route::post('/user/store', [UserController::class, 'store']);
Route::post('/user/{id}/update', [UserController::class, 'update']);
Route::post('/user/{id}/delete', [UserController::class, 'destroy']);

Route::get('/aspirasi/list', [AspirasiController::class, 'index']);
Route::get('/aspirasi/{id}/show', [AspirasiController::class, 'show']);
Route::post('/aspirasi/store', [AspirasiController::class, 'store']);
Route::post('/aspirasi/{id}/update', [AspirasiController::class, 'update']);
Route::post('/aspirasi/{id}/delete', [AspirasiController::class, 'destroy']);
