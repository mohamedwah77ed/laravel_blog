@extends('layouts.guest')

@section('content')
    <h2 class="text-center mb-4">Reset Your Password</h2>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
            @if ($errors->has('email'))
                <div class="alert alert-danger mt-2">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
            @if ($errors->has('password'))
                <div class="alert alert-danger mt-2">{{ $errors->first('password') }}</div>
            @endif
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm New Password</label>
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            @if ($errors->has('password_confirmation'))
                <div class="alert alert-danger mt-2">{{ $errors->first('password_confirmation') }}</div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary w-100">Reset Password</button>
    </form>
@endsection
