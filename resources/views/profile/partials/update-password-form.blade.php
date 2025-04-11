<section>
    <header>
        <h2 class="h4 fw-bold text-primary">
            Update Password
        </h2>

        <p class="mt-1 text-muted">
            Make sure to use a long and random password to protect your account.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="current_password" class="form-label">Current Password</label>
            <input type="password" id="current_password" name="current_password" class="form-control" autocomplete="current-password">
            @error('current_password')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input type="password" id="password" name="password" class="form-control" autocomplete="new-password">
            @error('password')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" autocomplete="new-password">
            @error('password_confirmation')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-success">Save</button>

            @if (session('status') === 'password-updated')
                <span class="text-success fw-bold">Saved successfully ✅</span>
            @endif
        </div>
    </form>
</section>