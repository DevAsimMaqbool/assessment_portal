<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SurveyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/exampless', [RoleController::class, 'example']);
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('complaints', ComplaintController::class);
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy']);
    Route::middleware(['role:admin'])->group(function () {
        Route::apiResource('/users', AdminUserController::class);
        Route::apiResource('/survey', SurveyController::class);
    });
});
