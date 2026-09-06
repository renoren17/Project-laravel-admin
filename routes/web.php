<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CastController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FilmController;

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

// users bagian rakha ganteng
Route::get('/users', function () {
    return view('users');
});

// faq punya Wildan
Route::get('/faq', function () {
    return view('faq');
});

// ===== Cast =====
Route::get('/cast', [CastController::class, 'index'])->name('cast.index');
Route::get('/cast/create', [CastController::class, 'create'])->name('cast.create');
Route::post('/cast', [CastController::class, 'store'])->name('cast.store');

// ===== Genre =====
Route::get('/genre', [GenreController::class, 'index'])->name('genre.index');
Route::get('/genre/create', [GenreController::class, 'create'])->name('genre.create');
Route::post('/genre', [GenreController::class, 'store'])->name('genre.store');

// ===== Film =====
Route::resource('film', FilmController::class);

// ===== Profile =====
Route::resource('profiles', ProfileController::class)->only([
    'index',
    'create',
    'store',
]);
