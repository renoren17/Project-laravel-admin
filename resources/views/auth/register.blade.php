@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<p class="panel-title">Register a new membership</p>

@if ($errors->any())
    <div class="alert alert-danger py-2 small">{{ $errors->first() }}</div>
@endif

<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="input-group mb-3">
        <input type="text" name="name" class="form-control" placeholder="Full Name" value="{{ old('name') }}" required autofocus>
        <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
        </div>
    </div>

    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
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

    <div class="input-group mb-3">
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
        <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
        </div>
    </div>

    <div class="row align-items-center">
        <div class="col-7">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="terms" class="custom-control-input" id="agreeTerms" required>
                <label for="agreeTerms" class="custom-control-label">I agree to the <a href="#">terms</a></label>
            </div>
        </div>
        <div class="col-5 text-right">
            <button type="submit" class="btn btn-brand btn-block">Register</button>
        </div>
    </div>
</form>

<div class="or-divider">- OR -</div>

<button class="btn btn-facebook btn-block"><i class="fab fa-facebook-f"></i>Sign up using Facebook</button>
<button class="btn btn-google btn-block mt-2"><i class="fab fa-google"></i>Sign up using Google</button>

<div class="foot-links">
    <a href="{{ route('login') }}">I already have a membership</a>
</div>
@endsection