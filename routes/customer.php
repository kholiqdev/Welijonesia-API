<?php

use App\Http\Controllers\Customer\Auth\ForgotPasswordController;
use App\Http\Controllers\Customer\Auth\LoginController;
use App\Http\Controllers\Customer\Auth\RegisterController;
use App\Http\Controllers\Customer\Auth\ResetPassword;
use App\Http\Controllers\Customer\Auth\VerificationController;
use App\Http\Controllers\Customer\SellerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', RegisterController::class)->name('customer.register');
Route::post('login', LoginController::class)->name('customer.login');
Route::post('forgot-password', ForgotPasswordController::class)->name('customer.forgot-password');
Route::post('reset-password', ResetPassword::class)->name('customer.reset-password');
Route::get('seller', [SellerController::class, 'index'])->name('customer.get-seller');

Route::middleware(['auth.api', 'role:customer'])->group(function () {
    Route::post('verification', VerificationController::class)->name('customer.verification');
});
