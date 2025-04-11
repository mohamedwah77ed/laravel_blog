<section>
    <header>
        <h2 class="h4 fw-bold text-primary">
            Account Information
        </h2>

        <p class="mt-1 text-muted">
            Update your account information and email address.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-danger">
                        Your email is not verified.

                        <button form="send-verification" class="btn btn-link p-0 text-primary">
                            Click here to resend the verification link.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="text-success fw-bold mt-1">
                            A new verification link has been sent to your email.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-success">Save Changes</button>

            @if (session('status') === 'profile-updated')
                <span class="text-success fw-bold">Updated Successfully ✅</span>
            @endif
        </div>
    </form>
</section>