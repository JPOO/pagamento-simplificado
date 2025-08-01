<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    AuthController,
    DashboardController,
    TransferController
};
use App\Http\Middleware\CheckUserRole;

Route::get(
    '/',
    [UserController::class, 'create']
);

Route::post(
    '/new-user',
    [UserController::class, 'store']
)->name('add-user');

Route::get(
    '/login',
    [AuthController::class, 'index']
)->name('login');

Route::post(
    '/login',
    [AuthController::class, 'login']
)->name('auth');

Route::get(
    '/logout',
    [AuthController::class, 'logout']
)->name('logout');

Route::middleware(['auth'])->group(function() {
    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');

    Route::middleware([CheckUserRole::class])->group(function() {
        Route::get(
            '/new-transfer',
            [TransferController::class, 'create']
        )->name('new-transfer');

        Route::post(
            '/new-transfer',
            [TransferController::class, 'store']
        )->name('add-transfer');
    });
});
