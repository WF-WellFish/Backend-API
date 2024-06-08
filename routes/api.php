<?php

use App\Http\Controllers\Api\ChangePasswordController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::put('profile/{user}', 'update')->name('profile.update');
    });

    Route::get('logout', [LogoutController::class, 'index'])->name('logout');
    Route::post('change-password', [ChangePasswordController::class, 'index'])->name('change-password');
});

// TODO : bikin user yang sudah login tidak bisa access register dan login
Route::post('login', [LoginController::class, 'index'])->name('login');
Route::post('register', [RegisterController::class, 'index'])->name('register');

Route::get('/', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Welcome to Wellfish API'
    ]);
});
