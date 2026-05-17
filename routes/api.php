<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\WasteScanController;
use App\Http\Controllers\Api\PickupController;
use App\Http\Controllers\Api\WasteBankController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ApiKeyController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:api'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
    
    // Profile
    Route::post('profile/update', [AuthController::class, 'updateProfile']);
    
    // API Keys
    Route::post('generate-key', [ApiKeyController::class, 'generate']);

    // Waste Scans
    Route::get('scans', [WasteScanController::class, 'index']);
    Route::post('scans', [WasteScanController::class, 'store']);
    Route::get('scans/{id}', [WasteScanController::class, 'show']);
    Route::post('classify', [WasteScanController::class, 'classify']);

    // Pickups
    Route::get('pickups', [PickupController::class, 'index']);
    Route::post('pickups', [PickupController::class, 'store']);
    Route::put('pickups/{id}', [PickupController::class, 'update']);

    // Dashboard Analytics
    Route::get('dashboard/statistics', [DashboardController::class, 'index']);
});

// Waste Banks
Route::get('waste-banks', [WasteBankController::class, 'index']);

// Articles
Route::get('articles', [ArticleController::class, 'index']);
Route::middleware(['auth:api'])->group(function () {
    Route::post('articles', [ArticleController::class, 'store']);
    Route::put('articles/{id}', [ArticleController::class, 'update']);
    Route::delete('articles/{id}', [ArticleController::class, 'destroy']);
});
