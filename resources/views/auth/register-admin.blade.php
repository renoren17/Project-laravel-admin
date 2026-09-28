@extends('layouts.auth')

@section('title', 'Register Admin')

@section('content')
<p class="panel-title mb-2">Buat akun administrator</p>
<p class="auth-note">Gunakan kode admin yang diberikan oleh Owner. Kode hanya dapat digunakan satu kali.</p>

@if ($errors->any())
    <div class="alert alert-danger py-2 small">{{ $errors->first() }}</div>
@endif

    <form method="POST" action="{{ route('register.admin.store') }}">
        @csrf

    <div class="input-group mb-3">
        <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" value="{{ old('name') }}" required autofocus>
        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-user"></i></span></div>
    </div>

    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-envelope"></i></span></div>
    </div>

    <div class="input-group mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-lock"></i></span></div>
    </div>

    <div class="input-group mb-3">
        <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-lock"></i></span></div>
    </div>

    <div class="input-group mb-2">
        <input type="text" name="kode" class="form-control code-input" placeholder="Kode Admin" value="{{ old('kode') }}" required>
        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-key"></i></span></div>
    </div>

    <div class="custom-control custom-checkbox mb-3">
        <input type="checkbox" name="terms" value="1" class="custom-control-input" id="agreeAdminTerms" {{ old('terms') ? 'checked' : '' }} required>
        <label for="agreeAdminTerms" class="custom-control-label">Saya setuju dengan syarat dan ketentuan</label>
    </div>

    <button type="submit" class="btn btn-brand btn-block">
        <i class="fas fa-user-shield mr-1"></i> Daftar sebagai Admin
    </button>
</form>

<div class="foot-links">
    <a href="{{ route('register') }}">Kembali ke register biasa</a>
    <a href="{{ route('login') }}">Saya sudah memiliki akun</a>
</div>
@endsection
