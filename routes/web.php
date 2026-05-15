<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Productcontroller;
use App\Http\Controllers\Ordercontroller;


Route::get('/',function() {
    return view('index');
})->name('home');

Route::get('/index',function(){
    return view('index');
});

// Auth
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/shopping', [Productcontroller::class, 'index'])->name('shop');

Route::get('/cart',function(){return view('cart');})->name('cart');

// order — requires login
Route::middleware('auth')->post('/order',[Ordercontroller::class,'store'])->name('order.store');
