<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\DashboardController;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('visitors', VisitorController::class);
    Route::post('visitors/{id}/checkout', [VisitorController::class, 'checkout']);
    Route::apiResource('check_ins', CheckInController::class);

    // Add a route for the dashboard
    Route::prefix('dashboard')->group(function () {
        Route::get('visitors', [DashboardController::class, 'getDailyVisitors']);
        Route::post('visitors/search', [DashboardController::class, 'searchVisitors']);
    });
  
});


Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
