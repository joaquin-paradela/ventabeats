<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/cart', [CartController::class, 'cart'])->name('cart.index');
    Route::get('/success', [ProductController::class, 'success'])->name('checkout.success');
    Route::get('/cancel', [ProductController::class, 'cancel'])->name('checkout.cancel');

    Route::post('/add', [CartController::class, 'add'])->name('cart.store');
    Route::post('/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/checkout', [ProductController::class, 'checkout'])->name('checkout');
    Route::post('/webhook', [ProductController::class, 'webhook'])->name('checkout.webhook');
    Route::post('/checkout/process', [CartController::class, 'processCheckout'])->name('checkout.process');

});

Route::middleware('auth', 'role:admin')->group(function() {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/beats', [AdminController::class, 'beats'])->name('admin.beats');

});

Route::get('/shop', [CartController::class, 'shop'])->name('shop');





require __DIR__.'/auth.php';
