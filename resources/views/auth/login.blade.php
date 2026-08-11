@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<p class="panel-title">Sign in to start your session</p>

@if ($errors->any())
    <div class="alert alert-danger py-2 small">{{ $errors->first() }}</div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autofocus>
        <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
        </div>
    </div>

    <div class="input-group mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
        </div>
    </div>

    <div class="row align-items-center">
        <div class="col-7">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="remember" class="custom-control-input" id="rememberMe">
                <label for="rememberMe" class="custom-control-label">Remember Me</label>
            </div>
        </div>
        <div class="col-5 text-right">
            <button type="submit" class="btn btn-brand btn-block">Sign In</button>
        </div>
    </div>
</form>

<div class="or-divider">- OR -</div>

<button class="btn btn-facebook btn-block"><i class="fab fa-facebook-f"></i>Sign in using Facebook</button>
<button class="btn btn-google btn-block mt-2"><i class="fab fa-google"></i>Sign in using Google</button>

<div class="foot-links">
    <a href="{{ route('password.request') }}">I forgot my password</a>
    <a href="{{ route('register') }}">Register a new membership</a>
</div>
@endsection