<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\AuthController;

Route::prefix('v1')
    ->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware(['auth:sanctum'])->group(function (){
        Route::get('/me', [AuthController::class, 'me']);
    });
    Route::middleware(['auth:sanctum','role:Admin|User'])->group(function () {
            Route::get('/users',[\App\Http\Controllers\V1\UserController::class,'index']);
            Route::get('/users/{id}',[\App\Http\Controllers\V1\UserController::class,'show']);
    });
    Route::middleware(['auth:sanctum','role:Admin'])->group(function () {
            Route::delete('/users/{id}',[\App\Http\Controllers\V1\UserController::class,'destroy']);
            Route::post('/users',[\App\Http\Controllers\V1\UserController::class,'store']);
            Route::put('/users/{id}',[\App\Http\Controllers\V1\UserController::class,'update']);
    });
});