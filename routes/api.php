<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\UserInfoApiController;
use App\Http\Controllers\Api\BalanceApiController;
use App\Http\Controllers\Api\LeaderboardApiController;
use App\Http\Controllers\StockController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('api')->group(function () {
    // Without API Key
});
Route::middleware('irapikey')->group(function () {
    // Internal Read
});
Route::middleware('iwapikey')->group(function () {
    // Internal Write
    Route::post('/user/create', [UserApiController::class, 'store']);
    Route::post('/user/balance/update', [BalanceApiController::class, 'updateBalance']);
});
Route::middleware('irwapikey')->group(function () {
    // Internal Read & Write
    Route::post('/stock/update', [StockController::class, 'updateStockPrices']);
});
Route::middleware('erapikey')->group(function () {
    // External Read
    Route::get('/user/count/total', [UserInfoApiController::class, 'getTotalUserCount']);
    Route::get('/user/count/admin', [UserInfoApiController::class, 'getAdminUserCount']);
    Route::get('/coins/get', [UserInfoApiController::class, 'checkBalance']);
    Route::get('/leaderboard', [LeaderboardApiController::class, 'getLeaderboard']);
    Route::get('/stock/get', [StockController::class, 'getStockPrices']);

});
Route::middleware('ewapikey')->group(function () {
    // External Write
    
});
Route::middleware('erwapikey')->group(function () {
    // External Read & Write
    
});