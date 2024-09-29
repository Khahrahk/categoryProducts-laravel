<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [\App\Http\Controllers\AuthController::class, 'user']);

    Route::prefix('categories')->as('categories.')->group(function () {
        Route::get('list', [\App\Http\Controllers\CategoryController::class, 'categoryList'])->name('list');
        Route::post('update', [\App\Http\Controllers\CategoryController::class, 'update'])->name('update');
        Route::post('store', [\App\Http\Controllers\CategoryController::class, 'store'])->name('store');
        Route::post('delete', [\App\Http\Controllers\CategoryController::class, 'delete'])->name('delete');
    });

    Route::prefix('products')->as('products.')->group(function () {
        Route::get('list', [\App\Http\Controllers\ProductController::class, 'productList'])->name('list');
        Route::post('update', [\App\Http\Controllers\ProductController::class, 'update'])->name('update');
        Route::post('store', [\App\Http\Controllers\ProductController::class, 'store'])->name('store');
        Route::post('delete', [\App\Http\Controllers\ProductController::class, 'delete'])->name('delete');
    });
});
