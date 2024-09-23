<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])->name('products.index');

Route::post('/', [ProductController::class, 'checkCost']);

Route::prefix('api')->name('api.')->group(function () {
    Route::post('checkout', [ProductController::class, 'checkout'])->name('checkout');
});