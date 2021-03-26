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
use App\Http\Controllers\CouponController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Checkout\CheckoutController;
use App\Http\Controllers\Checkout\StripeCheckoutController;
use App\Http\Controllers\Checkout\PayPalCheckoutController;
use App\Http\Controllers\ContactController;

Route::middleware('auth')->group(function() {
    Route::get('/account', [AccountController::class, 'index'])->name('account');

    Route::resource('categories', CategoryController::class)->except('show');

    Route::resource('products', ProductController::class)->except('show');
    Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
    Route::get('/products/{product}/delete-image', [ProductController::class, 'deleteImage'])
        ->name('products.delete-image');

    Route::resource('profile', UserProfileController::class)->only('index', 'edit', 'update');
    Route::patch('/profile/{user}/update-password', [UserProfileController::class, 'updatePassword'])
        ->name('profile.update-password');

    Route::resource('user-orders', UserOrderController::class)->only('index', 'show');

    Route::get('/orders/search', [OrderController::class, 'search'])->name('orders.search');
    Route::resource('orders', OrderController::class)->only('index', 'show', 'edit', 'update');

    Route::resource('coupons', CouponController::class)->except('show');

    Route::middleware('buyer')->group(function() {
        Route::resource('address', UserAddressController::class)->only('index', 'edit', 'update');
        Route::resource('wish-list', WishListController::class)->only('index', 'store', 'destroy');

        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

        Route::post('/checkout/purchase/stripe', [StripeCheckoutController::class, 'purchase'])->name('stripe.purchase');

        Route::post('/checkout/purchase/paypal', [PayPalCheckoutController::class, 'purchase'])->name('paypal.purchase');
        Route::get('/checkout/paypal/success/{order}', [PayPalCheckoutController::class, 'purchaseSuccess'])->name('paypal.success');
    });

});

Route::middleware('admin')->group(function() {
    Route::resource('roles', RoleController::class)->except('show');
    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
    Route::resource('users', UserController::class)->only('index', 'edit', 'update', 'destroy');

});

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'showContactForm'])->name('contact.form');
Route::post('/contact/send-mail', [ContactController::class, 'sendEmail'])->name('contact.send-email');
Route::resource('cart', CartController::class)->only('index', 'destroy');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

