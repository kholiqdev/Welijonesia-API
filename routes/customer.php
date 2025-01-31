<?php

use App\Http\Controllers\Customer\AddressController;
use App\Http\Controllers\Customer\Auth\ChangePasswordController;
use App\Http\Controllers\Customer\Auth\ForgotPasswordController;
use App\Http\Controllers\Customer\Auth\LoginController;
use App\Http\Controllers\Customer\Auth\RegisterController;
use App\Http\Controllers\Customer\Auth\ResendController;
use App\Http\Controllers\Customer\Auth\ResetPassword;
use App\Http\Controllers\Customer\Auth\VerificationController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CityController;
use App\Http\Controllers\Customer\DistrictController;
use App\Http\Controllers\Customer\FavoritContoller;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\PaymentMethodController;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\ProvinceController;
use App\Http\Controllers\Customer\ReviewController;
use App\Http\Controllers\Customer\SellerController;
use App\Http\Controllers\Customer\UserController;
use App\Http\Controllers\Customer\VillageController;
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
Route::get('review', [ReviewController::class, 'index'])->name('customer.get-review');
Route::get('product', ProductController::class)->name('customer.get-produk');
Route::get('payment-method', PaymentMethodController::class)->name('customer.payment-method');
Route::get('province', ProvinceController::class)->name('customer.get-province');
Route::get('city', CityController::class)->name('customer.get-city');
Route::get('district', DistrictController::class)->name('customer.get-district');
Route::get('village', VillageController::class)->name('customer.get-village');

Route::middleware(['auth.api', 'role:customer'])->group(function () {
    Route::post('verification', VerificationController::class)->name('customer.verification');
    Route::post('resend', ResendController::class)->name('customer.resend-verification');
    Route::post('favorit', [FavoritContoller::class, 'storeOrUpdate'])->name('customer.store-update-favorit');
    Route::post('cart', [CartController::class, 'storeOrUpdate'])->name('customer.store-update-cart');
    Route::delete('cart', [CartController::class, 'destroy'])->name('customer.destroy-cart');
    Route::get('cart', [CartController::class, 'index'])->name('customer.get-cart');
    Route::get('address', [AddressController::class, 'index'])->name('customer.get-address');
    Route::post('address', [AddressController::class, 'store'])->name('customer.store-address');
    Route::delete('address', [AddressController::class, 'destroy'])->name('customer.delete-address');
    Route::post('order', [OrderController::class, 'store'])->name('customer.store-order');
    Route::get('order', [OrderController::class, 'index'])->name('customer.get-order');
    Route::post('order/cancel', [OrderController::class, 'cancel'])->name('customer.cancel-order');
    Route::get('user', [UserController::class, 'index'])->name('customer.get-user');
    Route::put('user', [UserController::class, 'update'])->name('customer.update-user');
    Route::post('change-password', ChangePasswordController::class)->name('customer.change-password');
});
