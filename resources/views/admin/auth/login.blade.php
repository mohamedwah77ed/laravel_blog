@extends('layouts.guest')

@section('content')
    <h2 class="text-center mb-4">Admin Login</h2>

    {{-- Display Errors --}}
    
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
@endsection
