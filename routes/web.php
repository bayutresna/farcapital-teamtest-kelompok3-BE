<?php

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

Route::get('/admin/list', [AdminController::class, 'index']);
Route::get('/admin/{id}/show', [AdminController::class, 'show']);
Route::post('/admin/store', [AdminController::class, 'store']);
Route::post('/admin/{id}/update', [AdminController::class, 'update']);
Route::post('/admin/{id}/delete', [AdminController::class, 'destroy']);

Route::get('/aspirasi/list', [AspirasiController::class, 'index']);
Route::get('/aspirasi/{id}/show', [AspirasiController::class, 'show']);
Route::post('/aspirasi/store', [AspirasiController::class, 'store']);
Route::post('/aspirasi/{id}/update', [AspirasiController::class, 'update']);
Route::post('/aspirasi/{id}/delete', [AspirasiController::class, 'destroy']);
