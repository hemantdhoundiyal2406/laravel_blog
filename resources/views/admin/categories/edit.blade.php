@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
    <div class="d-flex justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h1 class="h2 fw-bold mb-1">Edit Category</h1>
            <p class="text-muted-soft mb-0">Update category name, slug, icon, or image.</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Back</a>
    </div>

    <div class="admin-card p-4">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.categories.form')
        </form>
    </div>
@endsection
