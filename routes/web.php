<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ItemController;
use App\Http\Controllers\User\CartController;

Route::prefix('/')
->name('items.')
->controller(ItemController::class)
->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('shop/{id}', 'shopShow')->name('shop');
    Route::get('show/{id}', 'show')->name('show');
});

Route::prefix('carts')
->middleware(['auth:users'])
->name('carts.')
->controller(CartController::class)
->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/{id}', 'store')->name('store');
    Route::post('delete/{id}', 'delete')->name('delete');
    Route::get('checkout', 'checkout')->name('checkout');
    Route::get('cancel', 'cancel')->name('cancel');
    Route::get('success', 'success')->name('success');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
