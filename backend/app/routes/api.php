<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppUserController;
use App\Http\Controllers\TripRequestController;
use App\Http\Controllers\AppNotificationController;
use App\Http\Controllers\AuthController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::get('/test', function (Request $request) {
//   $user = \App\Models\AppUser::where('email', 'main@grr.la')->first();
//   return compact(['user']);
// });

Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('auth/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware(['auth:sanctum']);

Route::group(['middleware' => 'auth:sanctum'], function () {
  Route::apiResources([
    'app_user' => AppUserController::class,
    'trip_request' => TripRequestController::class,
    'app_notification' => AppNotificationController::class,
  ]);
});
