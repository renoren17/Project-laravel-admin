<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ===== Auth (tampilan saja, belum ada proses login) =====
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', function () {
    return back()->with('status', 'Link reset password telah dikirim (simulasi).');
})->name('password.email');

Route::post('/logout', function () {
    return redirect('/login');
})->name('logout');

// ===== Dashboard (punya Cinta) =====
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//users bagian rakha ganteng
Route::get('/users', function () {
    return view('users');
});