<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BurgerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 

Route::get('/', [BurgerController::class, 'index'])->name('home');
Route::get('/burgers/{burger}', [BurgerController::class, 'show'])->name('burgers.show');
Route::get('/custom-burger', [BurgerController::class, 'custom'])->name('burgers.custom');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/remove/{index}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update/{index}', [CartController::class, 'update'])->name('cart.update');
    
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/confirmation/{order}', [OrderController::class, 'confirmation'])->name('order.confirmation');
});
Route::get('/commandes-recues', function() {
    return response(Storage::get('commandes_recues.txt'))
        ->header('Content-Type', 'text/plain');
});
Route::get('/commandes', function() {
    return File::get(public_path('commandes.html'));
});