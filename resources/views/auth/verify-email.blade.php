<x-guest-layout>
    <h1 class="h3 fw-bold text-center mb-2">Verify email</h1>
    <p class="text-muted-soft text-center mb-4">A verification link has been sent to your email address.</p>

    @if(session('status') === 'verification-link-sent')
        <div class="alert alert-success">A new verification link has been sent.</div>
    @endif

    <div class="d-grid gap-2">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button class="btn btn-brand w-100 py-3" type="submit">Resend Verification Email</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-outline-secondary w-100" type="submit">Log Out</button>
        </form>
    </div>
</x-guest-layout>
