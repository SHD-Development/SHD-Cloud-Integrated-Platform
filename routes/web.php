<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\StockController;

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
