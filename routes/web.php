<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BagController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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
Route::view('/favourites', 'favourites')->name('favourites');
Route::view('/payment', 'payment')->name('payment');
Route::view('/help', 'help')->name('help');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', function () {
    return view('log-out');
})->middleware('auth')->name('logout.confirm');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout.perform');
Route::view('/profile', 'profile')->middleware('auth')->name('profile');

Route::view('/admin/products', 'admin-product')->name('admin.products');
Route::view('/admin/products/create', 'admin-add-product')->name('admin.products.create');
Route::view('/admin/products/edit', 'admin-edit-product')->name('admin.products.edit');
Route::view('/admin/profile', 'admin-profile')->name('admin.profile');
