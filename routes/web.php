<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/index',function(){
    return view("index");
})->name('homePage');

Route::get('/shopping', function () {
    return view('shopping');
})->name('shop');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');
