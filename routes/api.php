<?php

use App\Http\Controllers\api\booksController;
use App\Http\Controllers\api\usersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::get('buku',[booksController::class, 'index']);
// Route::get('buku/{id}',[booksController::class, 'show']);
// Route::post('buku',[booksController::class, 'store']);
// Route::put('buku/{id}',[booksController::class, 'update']);
// Route::delete('buku/{id}',[booksController::class, 'destroy']);
Route::apiResource('buku', booksController::class);
Route::apiResource('user', usersController::class);