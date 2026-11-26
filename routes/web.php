<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{PublicController, AdminProductController};

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/produk/{product}', [PublicController::class, 'show'])->name('public.products.show');
Route::resource('admin/products', AdminProductController::class)->names('admin.products');
