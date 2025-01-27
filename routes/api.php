<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\RegisterController;

Route::group(['middleware' => 'guest:api'], function () {
    // Register
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('/verify-email', [RegisterController::class, 'VerifyEmail']);
    Route::post('/resend-otp', [RegisterController::class, 'ResendOtp']);

    // Login
    Route::post('login', [LoginController::class, 'login']);
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/refresh-token', [LoginController::class, 'refreshToken']);
    Route::post('/logout', [LogoutController::class, 'logout']);
});


// Protected Routes

Route::group(['middleware' => ['auth:api', 'role:admin']], function () {
    // Admin routes
});

Route::group(['middleware' => ['auth:api', 'role:vendor']], function () {
    // Vendor routes
});

Route::group(['middleware' => ['auth:api', 'role:customer']], function () {
    // Customer routes
});