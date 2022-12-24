<?php

use App\Http\Controllers\AspirasiController;
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

Route::get('/admin/list', [UserController::class, 'index']);
Route::get('/admin/{id}/show', [UserController::class, 'show']);
Route::post('/admin/store', [UserController::class, 'store']);
Route::post('/admin/{id}/update', [UserController::class, 'update']);
Route::post('/admin/{id}/delete', [UserController::class, 'destroy']);

Route::get('/aspirasi/list', [AspirasiController::class, 'index']);
Route::get('/aspirasi/{id}/show', [AspirasiController::class, 'show']);
Route::post('/aspirasi/store', [AspirasiController::class, 'store']);
Route::post('/aspirasi/{id}/update', [AspirasiController::class, 'update']);
Route::post('/aspirasi/{id}/delete', [AspirasiController::class, 'destroy']);
