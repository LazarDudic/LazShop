<?php

use App\Http\Controllers\Auth\Role\RoleController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'index'])->name('home');
Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/account', [App\Http\Controllers\AccountController::class, 'index'])->name('account');
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::get('products/{product}/delete-image', [ProductController::class, 'deleteImage'])
        ->name('products.delete-image');
    Route::resource('roles', RoleController::class)->except('show');
});
