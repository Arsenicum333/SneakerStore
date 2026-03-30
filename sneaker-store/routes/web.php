<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::view('/catalog', 'all-products')->name('catalog');
Route::view('/product', 'product')->name('product');
Route::view('/bag', 'bag')->name('bag');
Route::view('/favourites', 'favourites')->name('favourites');
Route::view('/payment', 'payment')->name('payment');
Route::view('/help', 'help')->name('help');

Route::view('/login', 'sign-in')->name('login');
Route::view('/register', 'log-in')->name('register');
Route::view('/logout', 'log-out')->name('logout');
Route::view('/profile', 'profile')->name('profile');

Route::view('/admin/products', 'admin-product')->name('admin.products');
Route::view('/admin/products/create', 'admin-add-product')->name('admin.products.create');
Route::view('/admin/products/edit', 'admin-edit-product')->name('admin.products.edit');
Route::view('/admin/profile', 'admin-profile')->name('admin.profile');
