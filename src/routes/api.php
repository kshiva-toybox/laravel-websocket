<?php

use App\Http\Controllers\StreamController;
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

Route::prefix('/streams')->group(function () {
    Route::get('', [StreamController::class, 'index']);
    Route::get('/{stream}', [StreamController::class, 'show']);
    Route::get('/{stream}/comments', [StreamController::class, 'comments']);
    Route::post('/{stream}/comments', [StreamController::class, 'postComment']);
    Route::post('/{stream}/like', [StreamController::class, 'like']);
});
