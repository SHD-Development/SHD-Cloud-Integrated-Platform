<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\RewardsController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/dashboard/stock', [StockController::class, 'stock'])
    ->name('stockdash');
    Route::get('/dashboard/redeem', function () {
        return view('code');
    })->name('redeemdash');
    Route::get('/panel', function () {
        return view('panel.index');
    })->name('panelindex');
});
Route::get('/admin', function () {
    return view('admin.gate');
})->middleware(['auth', 'can:access adminui'])->name('admin');
Route::get('/admin/index', function () {
    return view('admin.index');
})->middleware(['auth', 'can:access adminui index']);
Route::get('/admin/user', function () {
    return view('admin.user'); 
})->middleware(['auth', 'can:access adminui user']);

Route::prefix('admin')->group(function () {
    Route::get('user/create', [UserController::class, 'create'])->name('admin.create-user');
    Route::post('user/store', [UserController::class, 'store'])->name('admin.user.store');
})->middleware(['auth', 'can:access adminui user']);
Route::prefix('admin')->group(function () {
    Route::get('code/create', [CodeController::class, 'create'])->name('admin.create-code');
    Route::post('code/store', [CodeController::class, 'store'])->name('admin.code.store');
})->middleware(['auth', 'can:access adminui code']);
Route::post('/code/redeem', [CodeController::class, 'redeemCode'])->name('redeem-code');
Route::middleware('auth')->group(function () {
    Route::get('/dashboard/daily-reward', [RewardsController::class, 'getDailyReward'])->name('daily-reward');
    Route::post('/dashboard/claim-daily-reward', [RewardsController::class, 'claimDailyReward'])->name('claim-daily-reward');
});
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::post('/shop/buy/{product}', [ShopController::class, 'buyProduct'])->name('shop.buy');
Route::get('/shop/product/proceed/ipctosrm', [ProductController::class, 'proceedSRM'])->name('shop.proceed.srm');

// Discord登入
Route::get('link/discord', [SocialController::class, 'redirectToProvider']);
Route::get('link/discord/callback', [SocialController::class, 'handleProviderCallback']);
Route::get('link/account', [SocialController::class, 'profileLink'])->name('link_account');

