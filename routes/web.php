<?php

use App\Livewire\Cart;
use App\Livewire\Product;
use App\Livewire\StoreFront;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', StoreFront::class)->name('home');

Route::get('/product/{product}', Product::class)->name('product');

Route::get('/cart', Cart::class)->name('cart');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
