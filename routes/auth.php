<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RefreshController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth.api'])->group(function () {
    Route::post('refresh', RefreshController::class)->name('auth.refresh');
    Route::post('logout', LogoutController::class)->name('auth.logout');
});
