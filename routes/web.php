<?php

use App\Livewire\Counter;
use App\Livewire\Users;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/counter', Counter::class);
// Route::get('/users', Users::class);

Route::get('/users', function () {
    return view('users');
})->name('users');



// Auth Login Page Warga
Route::get('/auth', function () {
    return view('login.index');
})->middleware('guest')->name('auth.index');
