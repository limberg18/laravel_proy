<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1/auth')->group(function () {
    Route::post('login', [AuthController::class, "funcLogin"]);
    Route::post('register', [AuthController::class, "funcRegister"]);
    Route::get('listar',[AuthController::class,"funcListar"]);

    Route::middleware('auth:sanctum')->group(function () {

    Route::get('profile', [AuthController::class, "funcProfile"]);
    Route::post('logout', [AuthController::class, "funcLogout"]);
    });
});
