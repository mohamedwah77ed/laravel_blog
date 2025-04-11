@extends('layouts.guest')

@section('content')
    <h2 class="text-center mb-4">Create an Account</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Your Name" value="{{ old('name') }}" required autofocus>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="you@example.com" value="{{ old('email') }}" required>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="••••••••" required>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <a href="{{ route('login') }}" class="text-decoration-none text-primary small">Already have an account?</a>
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </form>
@endsection
