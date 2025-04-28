<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

Route::get('/products/search', [ProductController::class, 'search']);
Route::apiResource('products', ProductController::class);
