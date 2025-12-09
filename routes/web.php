<?php

use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::prefix('{client:slug}')->group(function (): void {
    Route::middleware('guest')->group(function (): void {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('client.login');
        Route::post('/login', [AuthController::class, 'login'])->name('client.login.post');
    });

    Route::middleware('auth')->group(function (): void {
        Route::post('/logout', [AuthController::class, 'logout'])->name('client.logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('client.dashboard');
    });
});
