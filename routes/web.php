<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Account\UserAddressController;
use App\Http\Controllers\Account\UserOrderController;
use App\Http\Controllers\Account\UserProfileController;
use App\Http\Controllers\Account\WishListController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function() {
    Route::get('/account', [AccountController::class, 'index'])->name('account');

    Route::resource('categories', CategoryController::class)->except('show');

    Route::resource('products', ProductController::class)->except('show');
    Route::get('/products/{product}/delete-image', [ProductController::class, 'deleteImage'])
        ->name('products.delete-image');

    Route::resource('profile', UserProfileController::class)->only('index', 'edit', 'update');
    Route::patch('/profile/{user}/update-password', [UserProfileController::class, 'updatePassword'])
        ->name('profile.update-password');

    Route::resource('user-orders', UserOrderController::class)->only('index', 'show');
    Route::resource('orders', OrderController::class)->only('index', 'show', 'edit', 'update');
    Route::resource('coupons', CouponController::class)->except('show');


    Route::middleware('buyer')->group(function() {
        Route::resource('address', UserAddressController::class)->only('index', 'edit', 'update');
        Route::resource('wish-list', WishListController::class)->only('index', 'store', 'destroy');

        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/checkout/purchase', [CheckoutController::class, 'purchase'])->name('checkout.purchase');
    });

});

Route::middleware('admin')->group(function() {
    Route::resource('roles', RoleController::class)->except('show');
    Route::resource('users', UserController::class)->only('index', 'edit', 'update', 'destroy');

});

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('cart', CartController::class)->only('index', 'destroy');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');


