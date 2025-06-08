<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Import controller API yang digunakan
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\UserController;

// Route untuk mengambil data user yang sedang login menggunakan Sanctum
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route API resource untuk entitas Booking
Route::apiResource('booking', BookingController::class);

// Route API resource untuk entitas Schedule
Route::apiResource('schedule', ScheduleController::class);

// Route API resource untuk entitas Service
Route::apiResource('service', ServiceController::class);

// Route API resource untuk entitas User
Route::apiResource('user', UserController::class);
