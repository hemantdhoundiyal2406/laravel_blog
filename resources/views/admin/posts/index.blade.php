@extends('layouts.admin')

@section('title', 'Blog Management')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h2 fw-bold mb-1">Blog Management</h1>
            <p class="text-muted-soft mb-0">Add, edit, publish, and delete blog articles.</p>
        </div>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-brand align-self-start"><i class="bi bi-plus-lg me-1"></i> Add Blog</a>
    </div>

    <div class="admin-card p-4">
        <form action="{{ route('admin.posts.index') }}" method="GET" class="row g-2 mb-4">
            <div class="col-md-9">
                <input type="search" name="search" class="form-control" placeholder="Search blog title" value="{{ request('search') }}">
            </div>
            <div class="col-md-3 d-grid">
                <button class="btn btn-navy" type="submit"><i class="bi bi-search me-1"></i> Search</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Blog</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Flags</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                        <tr>
                            <td><img src="{{ $post->image_url }}" class="thumb-small" alt="{{ $post->title }}"></td>
                            <td>
                                <strong class="d-block">{{ $post->title }}</strong>
                                <span class="text-muted-soft small">{{ $post->read_time }} min read</span>
                            </td>
                            <td>{{ $post->category->name }}</td>
                            <td><span class="badge text-bg-{{ $post->status === 'published' ? 'success' : 'secondary' }}">{{ ucfirst($post->status) }}</span></td>
                            <td>
                                @if($post->is_featured)<span class="badge text-bg-danger">Featured</span>@endif
                                @if($post->is_popular)<span class="badge text-bg-warning">Popular</span>@endif
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-sm btn-outline-secondary" target="_blank" title="View"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete this blog post?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" type="submit" title="Delete"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6"><div class="empty-state">No blog posts found.</div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $posts->links() }}
    </div>
@endsection
