@extends('layouts.admin')

@section('title', 'Category Management')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h2 fw-bold mb-1">Category Management</h1>
            <p class="text-muted-soft mb-0">Create and organize blog categories.</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-brand align-self-start"><i class="bi bi-plus-lg me-1"></i> Add Category</a>
    </div>

    <div class="admin-card p-4">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Slug</th>
                        <th>Posts</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <span class="category-icon"><i class="bi {{ $category->icon ?? 'bi-folder' }}"></i></span>
                                    <strong>{{ $category->name }}</strong>
                                </div>
                            </td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->posts_count }}</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category? Posts in this category will also be deleted.')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" type="submit" title="Delete"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4"><div class="empty-state">No categories found.</div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $categories->links() }}
    </div>
@endsection
