<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;


Route::get('/',function() {
    return view('index');
})->name('home');

Route::get('/index',function(){
    return view('index');
})->name('home');

Route::get('/shopping',function(){
    return view('shopping');
})->name('shop');

Route::get('/cart',function(){
    return view('cart');
})->name('cart');

// Auth
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
