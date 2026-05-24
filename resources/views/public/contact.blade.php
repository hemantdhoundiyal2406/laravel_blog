@extends('layouts.public')

@section('title', 'Contact - Purely Blog')

@section('content')
    <section class="page-hero py-5">
        <div class="container">
            <span class="badge-category mb-3">Contact</span>
            <h1 class="font-display fw-bold display-5 mb-3">Send a message</h1>
            <p class="lead text-muted-soft mb-0">Have a question, idea, or collaboration request? Use the form below.</p>
        </div>
    </section>

    <section class="container py-5">
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="soft-panel p-4 p-lg-5">
                    <form action="{{ route('contact.store') }}" method="POST" class="row g-3">
                        @csrf
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-bold">Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="col-12">
                            <label for="subject" class="form-label fw-bold">Subject</label>
                            <input type="text" id="subject" name="subject" class="form-control" value="{{ old('subject') }}" required>
                        </div>
                        <div class="col-12">
                            <label for="message" class="form-label fw-bold">Message</label>
                            <textarea id="message" name="message" class="form-control" rows="6" required>{{ old('message') }}</textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-brand px-4 py-3" type="submit">Send Message <i class="bi bi-send ms-1"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="soft-panel p-4 h-100">
                    <h2 class="h4 fw-bold mb-4">Contact Info</h2>
                    <div class="d-grid gap-4">
                        <div class="d-flex gap-3">
                            <span class="category-icon bg-danger-subtle text-danger"><i class="bi bi-envelope"></i></span>
                            <div>
                                <h3 class="h6 fw-bold">Email</h3>
                                <p class="text-muted-soft mb-0">hello@purelyblog.com</p>
                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <span class="category-icon bg-primary-subtle text-primary"><i class="bi bi-geo-alt"></i></span>
                            <div>
                                <h3 class="h6 fw-bold">Location</h3>
                                <p class="text-muted-soft mb-0">Pune, India</p>
                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <span class="category-icon bg-warning-subtle text-warning"><i class="bi bi-clock"></i></span>
                            <div>
                                <h3 class="h6 fw-bold">Working Hours</h3>
                                <p class="text-muted-soft mb-0">Monday - Friday, 9AM - 5PM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
