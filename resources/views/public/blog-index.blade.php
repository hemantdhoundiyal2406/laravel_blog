@extends('layouts.public')

@section('title', 'Blog Articles - My Blog')

@section('content')
    <section class="page-hero py-5">
        <div class="container">
            <div class="row align-items-end g-4">
                <div class="col-lg-7">
                    <span class="badge-category mb-3">Blog</span>
                    <h1 class="font-display fw-bold display-5 mb-3">All mindful living articles</h1>
                    <p class="lead text-muted-soft mb-0">Browse practical guides on lifestyle, wellness, travel, growth, and calm daily habits.</p>
                </div>
                <div class="col-lg-5">
                    <form action="{{ route('blog.index') }}" method="GET" class="soft-panel p-3">
                        <div class="row g-2">
                            <div class="col-md-7">
                                <input type="search" name="search" class="form-control" placeholder="Search articles" value="{{ request('search') }}">
                            </div>
                            <div class="col-md-5">
                                <select name="category" class="form-select">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 d-flex gap-2">
                                <button class="btn btn-brand flex-fill" type="submit"><i class="bi bi-search me-1"></i> Search</button>
                                <a href="{{ route('blog.index') }}" class="btn btn-outline-secondary">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="container py-5">
        <div class="d-flex flex-wrap gap-2 mb-4">
            <a class="btn btn-sm {{ request('category') ? 'btn-outline-secondary' : 'btn-brand' }}" href="{{ route('blog.index') }}">All</a>
            @foreach($categories as $category)
                <a class="btn btn-sm {{ request('category') === $category->slug ? 'btn-brand' : 'btn-outline-secondary' }}" href="{{ route('blog.index', ['category' => $category->slug]) }}">
                    {{ $category->name }} ({{ $category->posts_count }})
                </a>
            @endforeach
        </div>

        <div class="row g-4">
            @forelse($posts as $post)
                <div class="col-md-6 col-lg-4">
                    @include('partials.post-card', ['post' => $post])
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state">No articles found for your filters.</div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </section>
@endsection
