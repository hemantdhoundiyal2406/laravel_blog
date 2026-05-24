@extends('layouts.admin')

@section('title', 'View Message')

@section('content')
    <div class="d-flex justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h1 class="h2 fw-bold mb-1">View Message</h1>
            <p class="text-muted-soft mb-0">Contact form message details.</p>
        </div>
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Back</a>
    </div>

    <div class="admin-card p-4 p-lg-5">
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <p class="text-muted-soft mb-1">Name</p>
                <h2 class="h5 fw-bold">{{ $contact->name }}</h2>
            </div>
            <div class="col-md-4">
                <p class="text-muted-soft mb-1">Email</p>
                <h2 class="h5 fw-bold">{{ $contact->email }}</h2>
            </div>
            <div class="col-md-4">
                <p class="text-muted-soft mb-1">Date</p>
                <h2 class="h5 fw-bold">{{ $contact->created_at->format('M d, Y h:i A') }}</h2>
            </div>
        </div>

        <p class="text-muted-soft mb-1">Subject</p>
        <h3 class="h4 fw-bold mb-3">{{ $contact->subject }}</h3>

        <p class="text-muted-soft mb-1">Message</p>
        <p class="mb-4" style="white-space: pre-line;">{{ $contact->message }}</p>

        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Delete this message?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger" type="submit"><i class="bi bi-trash me-1"></i> Delete Message</button>
        </form>
    </div>
@endsection
