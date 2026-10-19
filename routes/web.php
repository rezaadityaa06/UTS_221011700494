<?php

use App\Http\Controllers\EcoProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EcoProductController::class, 'home'])->name('home');
Route::get('/produk', [EcoProductController::class, 'index'])->name('products.index');
Route::get('/produk/{ecoProduct}', [EcoProductController::class, 'show'])
    ->whereNumber('ecoProduct')->name('products.show');
