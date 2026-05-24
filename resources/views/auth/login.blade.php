<x-guest-layout>
    <h1 class="h3 fw-bold text-center mb-2">Welcome back</h1>
    <p class="text-muted-soft text-center mb-4">Login to open the admin dashboard.</p>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="d-grid gap-3">
        @csrf

        <div>
            <label for="email" class="form-label fw-bold">Email</label>
            <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password" class="form-label fw-bold">Password</label>
            <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex align-items-center justify-content-between gap-3">
            <div class="form-check">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label class="form-check-label" for="remember_me">Remember me</label>
            </div>

            @if (Route::has('password.request'))
                <a class="small fw-bold text-danger" href="{{ route('password.request') }}">Forgot password?</a>
            @endif
        </div>

        <button class="btn btn-brand py-3" type="submit">Log in</button>

        <p class="text-center text-muted-soft mb-0">
            New here?
            <a class="fw-bold text-danger" href="{{ route('register') }}">Create account</a>
        </p>
    </form>
</x-guest-layout>
