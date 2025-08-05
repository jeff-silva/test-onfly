<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AppUserController;
use App\Http\Controllers\TripRequestController;
use App\Http\Controllers\AppNotificationController;
use App\Http\Controllers\AuthController;

Route::get('app/load', [AppController::class, 'load'])->name('app.load');
Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');

Route::group(['middleware' => 'auth:sanctum'], function () {
  Route::apiResources([
    'app_user' => AppUserController::class,
    'trip_request' => TripRequestController::class,
    'app_notification' => AppNotificationController::class,
  ]);

  Route::post('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
  Route::post('trip_request/{id}/approve', [TripRequestController::class, 'approve'])->name('trip_request.approve');
  Route::post('trip_request/{id}/deny', [TripRequestController::class, 'deny'])->name('trip_request.deny');
});
