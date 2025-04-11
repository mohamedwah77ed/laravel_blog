@extends('layouts.guest')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="you@example.com" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('password.request') }}" class="text-decoration-none small text-primary">Forgot password?</a>
        </div>

        <button type="submit" class="btn btn-primary w-100">Sign In</button>
    </form>

    <div class="text-center mt-3">
        <span class="text-muted">Don't have an account?</span>
        <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Sign Up</a>
    </div>

    <div class="text-center mt-3">
        <a href="{{ route('admin.login.form') }}" class="text-decoration-none text-warning">Login as Admin</a>
    </div>
@endsection
