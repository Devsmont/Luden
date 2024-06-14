<?php

use App\Http\Controllers\V1\UserController;
use App\Http\Controllers\V1\CharacterController;
use App\Http\Controllers\V1\RpgSystemController;
use \App\Http\Controllers\V1\SkillController;
use App\Http\Controllers\V1\RpgController;
use App\Http\Controllers\V1\RpgPlayerController;
use App\Http\Controllers\V1\RpgSessionController;
use \App\Http\Controllers\V1\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function() {
    Route::post('login', [AuthController::class,'login']);
    Route::post('register', [AuthController::class,'register']);
    Route::get('/validate-token', [AuthController::class, 'validateToken']);

    Route::middleware('auth:sanctum')->group(function (){
        Route::post('logout',[AuthController::class,'logout']);
        Route::get('me',[AuthController::class,'me']);
        Route::apiResource('users',UserController::class);
        Route::apiResource('characters',CharacterController::class);
        Route::apiResource('rpgSystems',RpgSystemController::class);
        Route::apiResource('skills',SkillController::class);
        Route::apiResource('rpgs',RpgController::class);
        Route::apiResource('players',RpgPlayerController::class);
        Route::apiResource('sessions', RpgSessionController::class);

    });

});

