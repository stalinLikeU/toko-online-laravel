<?php

use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/transactions', [\App\Http\Controllers\TransactionController::class, 'index'])->name('transactions.index');
});

Route::get('/',[\App\Http\Controllers\HomeController::class,'index'])->name('home');
Route::get('/products',[\App\Http\Controllers\HomeController::class,'produts'])->name('products');

Route::middleware(['auth'])->group(function () {
    Route::get('/checkout/{product}', [\App\Http\Controllers\CheckoutController::class, 'checkoutForm'])->name('checkout.checkout-form')->middleware(\App\Http\Middleware\EnsureUserCanCheckout::class);
    Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'processCheckout'])->name('checkout.process-checkout')->middleware(\App\Http\Middleware\EnsureUserCanCheckout::class);
    Route::post('/checkout/store-transaction', [\App\Http\Controllers\CheckoutController::class, 'storeTransaction'])->name('checkout.storeTransaction');
});
