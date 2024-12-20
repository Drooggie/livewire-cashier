<?php

use App\Console\Commands\AbandonedCart;
use App\Livewire\Cart;
use App\Livewire\CheckoutStatus;
use App\Livewire\OrderPreview;
use App\Livewire\Product;
use App\Livewire\StoreFront;
use App\Livewire\Welcome;
use App\Mail\AbandonedCartMail;
use App\Mail\SendOrderConfirmation;
use App\Models\Cart as ModelsCart;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', StoreFront::class)->name('home');

Route::get('/product/{product}', Product::class)->name('product');

Route::get('/cart', Cart::class)->name('cart');



Route::get('/preview', function () {
    $cart = ModelsCart::with('user')->find('25');

    return new AbandonedCartMail($cart);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/checkout-status', CheckoutStatus::class)->name('checkout-status');

    Route::get('/order/{order}', OrderPreview::class)->name('order-preview');
});
