@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')
<p class="panel-title">You forgot your password? Here you can easily retrieve a new password.</p>

@if (session('status'))
    <div class="alert alert-success py-2 small">{{ session('status') }}</div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autofocus>
        <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
        </div>
    </div>

    <button type="submit" class="btn btn-brand btn-block">Request new password</button>
</form>

<div class="foot-links mt-3">
    <a href="{{ route('login') }}">Login</a>
    <a href="{{ route('register') }}">Register a new membership</a>
</div>
@endsection