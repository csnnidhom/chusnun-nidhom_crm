<?php

use App\Http\Controllers\ApprovalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\ProductController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/proses-login', [AuthController::class, 'login'])->name('proses_login');

Route::middleware('auth')->group(function(){
    Route::resource('dashboard', DashboardController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('products', ProductController::class);
    Route::get('/deals/export', [DealController::class, 'export'])->name('deals.export');
    Route::resource('deals', DealController::class);
    Route::resource('approvals', ApprovalController::class);


});
