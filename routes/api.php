<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/users',[UserController::class, 'register']);
Route::post('/users/login',[UserController::class, 'login']);
Route::prefix('/users')->middleware('auth:sanctum')->group(function(){
    Route::get('/current',[UserController::class, 'current']);
    Route::patch('/current/{id}',[UserController::class, 'update']);
    Route::delete('/logout',[UserController::class, 'logout']);
});