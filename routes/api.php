<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\ProductApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

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

Route::middleware('auth:sanctum')->group(function (){
    Route::middleware('can:isAdmin')->group(function () {
        Route::get('/category', [CategoryApiController::class, 'index']);
        Route::get('/category/{id}', [CategoryApiController::class, 'show']);
        Route::post('/category', [CategoryApiController::class, 'store']);
        Route::put('/category/{id}', [CategoryApiController::class, 'update']);
        Route::delete('/category/{id}', [CategoryApiController::class, 'destroy']);
    });

    Route::apiResource('product', ProductApiController::class);
    Route::post('/logout', [AuthApiController::class, 'logout'])->middleware('auth:sanctum');
});


Route::post('/login', [AuthApiController::class, 'login']);
