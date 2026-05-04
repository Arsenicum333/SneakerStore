<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\BagController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FavouriteController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/catalog', [ProductController::class, 'index'])->name('catalog');
Route::get('/product', [ProductController::class, 'showFirst'])->name('product');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::get('/bag', [BagController::class, 'index'])->name('bag');
Route::post('/bag/items', [BagController::class, 'add'])->name('bag.items.add');
Route::patch('/bag/items/{sizeId}', [BagController::class, 'update'])->name('bag.items.update');
Route::delete('/bag/items/{sizeId}', [BagController::class, 'remove'])->name('bag.items.remove');
Route::get('/favourites', [FavouriteController::class, 'index'])->name('favourites');
Route::post('/favourites/toggle', [FavouriteController::class, 'toggle'])->name('favourites.toggle');
Route::delete('/favourites/{variantId}', [FavouriteController::class, 'remove'])->name('favourites.remove');
Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
Route::post('/payment', [PaymentController::class, 'store'])->middleware('auth')->name('payment.perform');
Route::view('/help', 'help')->name('help');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', function () {
    return view('log-out');
})->middleware('auth')->name('logout.confirm');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout.perform');
Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth')->name('profile');
Route::put('/profile', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/products', [AdminProductController::class, 'index'])->name('products');
    Route::get('/profile', [ProfileController::class, 'adminIndex'])->name('profile');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::patch('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');
});
