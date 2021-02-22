<?php

use App\Http\Controllers\RefreshController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth.api'])->group(function () {
    Route::post('refresh', RefreshController::class)->name('auth.refresh');
});
