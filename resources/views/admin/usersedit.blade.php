@extends('layouts.editusersadmin')

@section('title', 'Update User Data')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Update User Data</h2>
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="password">New Password (Optional)</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
@endsection