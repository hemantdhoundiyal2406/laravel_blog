@extends('layouts.public')

@section('title', 'About - Purely Blog')

@section('content')
    <section class="page-hero py-5">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <span class="badge-category mb-3">About</span>
                    <h1 class="font-display fw-bold display-5 mb-3">A calm place for better daily living</h1>
                    <p class="lead text-muted-soft mb-0">Purely Blog shares beginner-friendly ideas about habits, wellness, travel, personal growth, and mindful routines.</p>
                </div>
                <div class="col-lg-5">
                    <img src="https://images.unsplash.com/photo-1499209974431-9dddcece7f88?auto=format&fit=crop&w=900&q=80" class="img-fluid rounded-4 shadow-sm" alt="Writer desk">
                </div>
            </div>
        </div>
    </section>

    <section class="container py-5">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="soft-panel p-4 h-100">
                    <i class="bi bi-bullseye fs-1 text-danger"></i>
                    <h2 class="h4 fw-bold mt-3">Mission</h2>
                    <p class="text-muted-soft mb-0">To make self-improvement simple, honest, and useful for everyday readers.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="soft-panel p-4 h-100">
                    <i class="bi bi-eye fs-1 text-primary"></i>
                    <h2 class="h4 fw-bold mt-3">Vision</h2>
                    <p class="text-muted-soft mb-0">To build a thoughtful blog where readers can learn, reflect, and grow one article at a time.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="soft-panel p-4 h-100">
                    <i class="bi bi-stars fs-1 text-warning"></i>
                    <h2 class="h4 fw-bold mt-3">Why This Blog</h2>
                    <p class="text-muted-soft mb-0">Because modern life is busy, and clear practical content can help people feel more in control.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
