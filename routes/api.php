<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

    Route::resource('/posts', \App\Http\Controllers\Api\PostController::class); // tambahkan ini
});
