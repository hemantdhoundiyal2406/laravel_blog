@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h2 fw-bold mb-1">Dashboard</h1>
            <p class="text-muted-soft mb-0">Quick overview of blogs, categories, messages, and subscribers.</p>
        </div>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-brand align-self-start"><i class="bi bi-plus-lg me-1"></i> Add Blog</a>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="admin-card p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted-soft mb-1">Total Blogs</p>
                        <h2 class="fw-bold mb-0">{{ $stats['posts'] }}</h2>
                    </div>
                    <span class="category-icon bg-danger-subtle text-danger"><i class="bi bi-journal-text"></i></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="admin-card p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted-soft mb-1">Categories</p>
                        <h2 class="fw-bold mb-0">{{ $stats['categories'] }}</h2>
                    </div>
                    <span class="category-icon bg-primary-subtle text-primary"><i class="bi bi-grid"></i></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="admin-card p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted-soft mb-1">Messages</p>
                        <h2 class="fw-bold mb-0">{{ $stats['contacts'] }}</h2>
                    </div>
                    <span class="category-icon bg-warning-subtle text-warning"><i class="bi bi-inbox"></i></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="admin-card p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted-soft mb-1">Subscribers</p>
                        <h2 class="fw-bold mb-0">{{ $stats['subscribers'] }}</h2>
                    </div>
                    <span class="category-icon bg-success-subtle text-success"><i class="bi bi-envelope-paper"></i></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-xl-7">
            <div class="admin-card p-4">
                <div class="d-flex justify-content-between gap-3 mb-3">
                    <h2 class="h5 fw-bold mb-0">Latest Blogs</h2>
                    <a href="{{ route('admin.posts.index') }}" class="fw-bold text-danger">Manage</a>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestPosts as $post)
                                <tr>
                                    <td class="fw-bold">{{ $post->title }}</td>
                                    <td>{{ $post->category->name }}</td>
                                    <td><span class="badge text-bg-{{ $post->status === 'published' ? 'success' : 'secondary' }}">{{ ucfirst($post->status) }}</span></td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-muted-soft">No posts yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xl-5">
            <div class="admin-card p-4">
                <div class="d-flex justify-content-between gap-3 mb-3">
                    <h2 class="h5 fw-bold mb-0">Recent Messages</h2>
                    <a href="{{ route('admin.contacts.index') }}" class="fw-bold text-danger">View all</a>
                </div>
                <div class="d-grid gap-3">
                    @forelse($latestContacts as $contact)
                        <a href="{{ route('admin.contacts.show', $contact) }}" class="d-flex justify-content-between gap-3 border-bottom pb-3">
                            <span>
                                <strong class="d-block">{{ $contact->name }}</strong>
                                <span class="text-muted-soft small">{{ $contact->subject }}</span>
                            </span>
                            <span class="text-muted-soft small">{{ $contact->created_at->diffForHumans() }}</span>
                        </a>
                    @empty
                        <p class="text-muted-soft mb-0">No messages yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
