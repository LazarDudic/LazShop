<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Account\UserAddressController;
use App\Http\Controllers\Account\UserProfileController;
use App\Http\Controllers\Auth\Role\RoleController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('cart', CartController::class);
Auth::routes();

Route::get('categories/{category}', [CategoryController::class, 'show'])
    ->name('categories.show');

Route::get('products/{product}', [ProductController::class, 'show'])
     ->name('products.show');

Route::middleware('auth')->group(function() {
    Route::get('/account', [AccountController::class, 'index'])->name('account');

    Route::resource('categories', CategoryController::class)->except('show');

    Route::resource('products', ProductController::class)->except('show');
    Route::get('products/{product}/delete-image', [ProductController::class, 'deleteImage'])
        ->name('products.delete-image');


    Route::resource('profile', UserProfileController::class);
    Route::patch('profile/{user}/update-password', [UserProfileController::class, 'updatePassword'])
        ->name('profile.update-password');

    Route::resource('address', UserAddressController::class);
});

Route::middleware('admin')->group(function() {
    Route::resource('roles', RoleController::class)->except('show');
});
