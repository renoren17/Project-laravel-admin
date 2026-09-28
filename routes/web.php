<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CastController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Models\AdminCode;
use Illuminate\Support\Str;

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
        'name' => ['required', 'string', 'max:45'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        'password' => ['required', 'string', 'confirmed', 'min:8'],
        'terms' => ['accepted'],
    ]);

    $user = DB::transaction(function () use ($data) {
        $role = \App\Models\Role::firstOrCreate([
            'nama' => 'User',
        ]);

        $profileId = DB::table('profiles')->insertGetId([
            'umur' => 0,
            'bio' => '',
            'alamat' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return \App\Models\User::unguarded(function () use ($data, $role, $profileId) {
            return \App\Models\User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role_id' => $role->id,
                'profile_id' => $profileId,
            ]);
        });
    });

    Auth::login($user);
    $request->session()->regenerate();

    return redirect('/dashboard');
})->name('register.store');

Route::get('/register/admin', function () {
    return view('auth.register-admin');
})->name('register.admin');

Route::post('/register/admin', function (Request $request) {
    $data = $request->validate([
        'name' => ['required', 'string', 'max:45'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        'password' => ['required', 'string', 'confirmed', 'min:8'],
        'terms' => ['accepted'],
        'kode' => ['required', 'string', 'exists:admin_codes,kode'],
    ]);

    $adminCode = AdminCode::where('kode', $data['kode'])->first();

    if ($adminCode && $adminCode->user_id !== null) {
        return back()->withErrors([
            'kode' => 'Kode admin ini sudah dipakai.',
        ])->onlyInput('email', 'name');
    }

    $role = \App\Models\Role::firstOrCreate([
        'nama' => 'Admin',
    ]);

    $user = DB::transaction(function () use ($data, $role, $adminCode) {
        $profileId = DB::table('profiles')->insertGetId([
            'umur' => 0,
            'bio' => '',
            'alamat' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return \App\Models\User::unguarded(function () use ($data, $role, $profileId) {
            return \App\Models\User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role_id' => $role->id,
                'profile_id' => $profileId,
            ]);
        });
    });

    $adminCode->update([
        'user_id' => $user->id,
    ]);

    Auth::login($user);
    $request->session()->regenerate();

    return redirect('/dashboard')->with('success', 'Akun admin berhasil dibuat.');
})->name('register.admin.store');

Route::middleware(['auth', 'can:owner'])->group(function () {
    Route::get('/owner/admin-codes', [OwnerController::class, 'index'])->name('owner.admin-codes');
    Route::post('/owner/admin-codes', [OwnerController::class, 'store'])->name('owner.admin-codes.store');
});

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

// Dashboard user / katalog film
Route::get('/dashboard', function () {
    $latestFilms = \App\Models\Film::with('genres')->latest()->take(4)->get();
    $totalFilms = \App\Models\Film::count();
    $totalGenres = \App\Models\Genre::count();
    $totalCasts = \App\Models\Cast::count();
    $totalRoles = \App\Models\Role::count();
    $latestKritiks = \App\Models\Kritik::with(['film', 'user'])->latest()->take(3)->get();

    return view('dashboard', compact('latestFilms', 'totalFilms', 'totalGenres', 'totalCasts', 'totalRoles', 'latestKritiks'));
})->middleware('auth')->name('dashboard');

Route::get('/movie/{film}', [FilmController::class, 'publicShow'])->name('movie.show');

//buat genre populer
Route::get('/dashboard', function () {
    $latestFilms = \App\Models\Film::with('genres')->latest()->take(4)->get();
    $totalFilms = \App\Models\Film::count();
    $totalGenres = \App\Models\Genre::count();
    $totalCasts = \App\Models\Cast::count();
    $totalRoles = \App\Models\Role::count();
    $latestKritiks = \App\Models\Kritik::with(['film', 'user'])->latest()->take(3)->get();
    $popularGenres = \App\Models\Genre::withCount('films')
        ->orderByDesc('films_count')
        ->take(4)
        ->get();

    return view('dashboard', compact('latestFilms', 'totalFilms', 'totalGenres', 'totalCasts', 'totalRoles', 'latestKritiks', 'popularGenres'));
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
    // Read-only access for authenticated users, including Owner.
    Route::get('/cast', [CastController::class, 'index'])->name('cast.index');
    Route::get('/genre', [GenreController::class, 'index'])->name('genre.index');
    Route::get('/film', [FilmController::class, 'index'])->name('film.index');

    Route::middleware('can:admin')->group(function () {
        // Cast changes
        Route::get('/cast/create', [CastController::class, 'create'])->name('cast.create');
        Route::post('/cast', [CastController::class, 'store'])->name('cast.store');
        Route::get('/cast/{cast_id}/edit', [CastController::class, 'edit'])->name('cast.edit');
        Route::put('/cast/{cast_id}', [CastController::class, 'update'])->name('cast.update');
        Route::delete('/cast/{cast_id}', [CastController::class, 'destroy'])->name('cast.delete');

        // Genre changes
        Route::get('/genre/create', [GenreController::class, 'create'])->name('genre.create');
        Route::post('/genre', [GenreController::class, 'store'])->name('genre.store');
        Route::get('/genre/{id}/edit', [GenreController::class, 'edit'])->name('genre.edit');
        Route::put('/genre/{id}', [GenreController::class, 'update'])->name('genre.update');
        Route::delete('/genre/{id}', [GenreController::class, 'destroy'])->name('genre.destroy');

        // Film changes
        Route::get('/film/create', [FilmController::class, 'create'])->name('film.create');
        Route::get('/film/{film}/edit', [FilmController::class, 'edit'])->name('film.edit');
        Route::post('/film', [FilmController::class, 'store'])->name('film.store');
        Route::put('/film/{film}', [FilmController::class, 'update'])->name('film.update');
        Route::patch('/film/{film}', [FilmController::class, 'update']);
        Route::delete('/film/{film}', [FilmController::class, 'destroy'])->name('film.destroy');
    });

    Route::get('/cast/{cast_id}', [CastController::class, 'show'])->name('cast.show');
    Route::get('/film/{film}', [FilmController::class, 'show'])->name('film.show');

    // Profile
    Route::resource('profiles', ProfileController::class)->only([
        'index',
    ]);
    Route::delete('/profiles/{profile}', [ProfileController::class, 'destroy'])
        ->middleware('can:owner')
        ->name('profiles.destroy');

    // Role
    Route::resource('roles', RoleController::class)->only([
        'index',
    ]);

    Route::delete('/profiles/{profile}/fire', [ProfileController::class, 'fire'])
        ->middleware('can:owner')
        ->name('profiles.fire');
});
