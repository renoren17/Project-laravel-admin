<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CastController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;

Route::get('/', function () {
    return view('welcome');
});

// Auth
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required', 'string'],
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    return back()
        ->withErrors([
            'email' => 'Email atau password salah.',
        ])
        ->onlyInput('email');
})->name('login.authenticate');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {
    $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        'password' => ['required', 'string', 'confirmed', 'min:8'],
        'terms' => ['accepted'],
    ]);

    $user = DB::transaction(function () use ($data) {
        $roleId = DB::table('roles')->value('id');

        if (!$roleId) {
            $roleId = DB::table('roles')->insertGetId([
                'nama' => 'User',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $profileId = DB::table('profiles')->insertGetId([
            'umur' => 0,
            'bio' => '',
            'alamat' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return \App\Models\User::unguarded(function () use ($data, $roleId, $profileId) {
            return \App\Models\User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role_id' => $roleId,
                'profile_id' => $profileId,
            ]);
        });
    });

    Auth::login($user);
    $request->session()->regenerate();

    return redirect('/dashboard');
})->name('register.store');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', function () {
    return back()->with('status', 'Link reset password telah dikirim.');
})->name('password.email');

Route::post('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Users
Route::get('/users', function () {
    return view('users');
})->middleware('auth');

// FAQ
Route::get('/faq', function () {
    return view('faq');
})->middleware('auth');

// CRUD yang membutuhkan login
Route::middleware('auth')->group(function () {
    // Cast
    Route::get('/cast', [CastController::class, 'index'])->name('cast.index');
    Route::get('/cast/create', [CastController::class, 'create'])->name('cast.create');
    Route::post('/cast', [CastController::class, 'store'])->name('cast.store');

    // Genre
    Route::get('/genre', [GenreController::class, 'index'])->name('genre.index');
    Route::get('/genre/create', [GenreController::class, 'create'])->name('genre.create');
    Route::post('/genre', [GenreController::class, 'store'])->name('genre.store');

    // Film
    Route::resource('film', FilmController::class);

    // Profile
    Route::resource('profiles', ProfileController::class)->only([
        'index',
        'create',
        'store',
    ]);

    // Role
    Route::resource('roles', RoleController::class)->only([
        'index',
        'create',
        'store',
    ]);
});