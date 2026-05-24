<x-guest-layout>
    <h1 class="h3 fw-bold text-center mb-2">Confirm password</h1>
    <p class="text-muted-soft text-center mb-4">Please confirm your password before continuing.</p>

    <form method="POST" action="{{ route('password.confirm') }}" class="d-grid gap-3">
        @csrf
        <div>
            <label for="password" class="form-label fw-bold">Password</label>
            <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button class="btn btn-brand py-3" type="submit">Confirm</button>
    </form>
</x-guest-layout>
