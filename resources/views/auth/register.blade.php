<x-guest-layout>
    <h1 class="h3 fw-bold text-center mb-2">Create account</h1>
    <p class="text-muted-soft text-center mb-4">Register to access the blog admin panel.</p>

    <form method="POST" action="{{ route('register') }}" class="d-grid gap-3">
        @csrf

        <div>
            <label for="name" class="form-label fw-bold">Name</label>
            <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="email" class="form-label fw-bold">Email</label>
            <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password" class="form-label fw-bold">Password</label>
            <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
        </div>

        <button class="btn btn-brand py-3" type="submit">Register</button>

        <p class="text-center text-muted-soft mb-0">
            Already registered?
            <a class="fw-bold text-danger" href="{{ route('login') }}">Log in</a>
        </p>
    </form>
</x-guest-layout>
