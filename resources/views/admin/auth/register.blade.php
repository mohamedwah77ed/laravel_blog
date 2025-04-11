@extends('layouts.guest')

@section('content')
    <h2 class="text-center mb-4">إنشاء حساب أدمن</h2>
    <form method="POST" action="{{ route('admin.register') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">البريد الإلكتروني</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">كلمة المرور</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">إنشاء الحساب</button>
    </form>
@endsection