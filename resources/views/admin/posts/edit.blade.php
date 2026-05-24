@extends('layouts.admin')

@section('title', 'Edit Blog')

@section('content')
    <div class="d-flex justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h1 class="h2 fw-bold mb-1">Edit Blog</h1>
            <p class="text-muted-soft mb-0">Update article content, image, category, and publish status.</p>
        </div>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Back</a>
    </div>

    <div class="admin-card p-4">
        <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.posts.form')
        </form>
    </div>
@endsection
