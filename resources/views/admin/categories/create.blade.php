@extends('layouts.admin')

@section('title', 'Add Category')

@section('content')
    <div class="d-flex justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h1 class="h2 fw-bold mb-1">Add Category</h1>
            <p class="text-muted-soft mb-0">Create a category for grouping blog posts.</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Back</a>
    </div>

    <div class="admin-card p-4">
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @include('admin.categories.form')
        </form>
    </div>
@endsection
