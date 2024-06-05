<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::post('register', [RegisterController::class, 'index'])->name('register');
Route::post('login', [LoginController::class, 'index'])->name('login');

Route::get('/', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Welcome to Wellfish API'
    ]);
});
