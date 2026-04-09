<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\PostController;


// Route::middleware('api')->group(function () {
//     Route::get('/ping', function () {
//         return response()->json([
//             'message' => 'API OK'
//         ]);
//     });
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);    
Route::get('/saving-plans', [AuthController::class, 'savingPlans']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::get('/me/dashboard', [DashboardController::class, 'show']);
    Route::get('/me/profile', [ProfileController::class, 'show']);
    Route::post('/me/profile', [ProfileController::class, 'update']);

    Route::resource('/posts', \App\Http\Controllers\Api\PostController::class); // tambahkan ini
});
