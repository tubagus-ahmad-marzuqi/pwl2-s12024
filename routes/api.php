<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;


// Route::post('token', [UserController::class, 'set_token']);

// Route::post('login', [UserController::class, 'login'])->name('login');

// Route::middleware('auth:sanctum')->group(function () {
//     // Route::get('users', [UserController::class, 'index']);
// //     Route::post('users', [UserController::class, 'store']);
// //     Route::put('users/{id}', [UserController::class, 'update']);
// //     Route::delete('users/{id}', [UserController::class, 'destroy']);
//         Route::apiResource('users', UserController::class);
// });
Route::prefix('products')->group(function () {
    Route::get('/lihat', [ProductController::class, 'lihat']);
    Route::get('/lihat_id/{id}', [ProductController::class, 'lihat_by_id']);
});

Route::prefix('users')->group(function () {
    Route::get('/lihat', [UserController::class, 'lihat']);
});

Route::apiResource('users', UserController::class);

Route::get('test', function () {
    return response()->json(['message' => 'API is working!']);
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     Log::debug('Authenticated User:', ['user' => $request->user()]);
//     return $request->user();
// });


