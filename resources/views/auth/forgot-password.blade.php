<x-guest-layout>
    <h1 class="h3 fw-bold text-center mb-2">Forgot password</h1>
    <p class="text-muted-soft text-center mb-4">Enter your email and Laravel will send a reset link.</p>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="d-grid gap-3">
        @csrf
        <div>
            <label for="email" class="form-label fw-bold">Email</label>
            <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button class="btn btn-brand py-3" type="submit">Email Password Reset Link</button>
        <a class="text-center fw-bold text-danger" href="{{ route('login') }}">Back to login</a>
    </form>
</x-guest-layout>
