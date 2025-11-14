<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\AuthController;

Route::prefix('v1')
    ->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware(['auth:sanctum'])->group(function (){
        Route::get('/me', [AuthController::class, 'me']);
    });
    
    Route::middleware(['auth:sanctum','role:Administrador|Eventos'])->group(function () {
        Route::delete('/users',[\App\Http\Controllers\V1\UserController::class,'index']);
        });
    });