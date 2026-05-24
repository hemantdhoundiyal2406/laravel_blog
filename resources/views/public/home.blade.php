@extends('layouts.public')

@section('title', 'My Blog - Mindful Living Articles')

@section('content')
    <section class="container py-4 py-lg-5">
        @if($featuredPost)
            <div class="featured-hero" style="--hero-image: url('{{ $featuredPost->image_url }}');">
                <div class="hero-content">
                    <p class="text-uppercase fw-bold text-danger mb-3">Featured Post</p>
                    <h1 class="hero-title font-display mb-3">{{ $featuredPost->title }}</h1>
                    <p class="lead text-muted-soft mb-4">{{ $featuredPost->short_description }}</p>
                    <div class="d-flex flex-wrap align-items-center gap-3 meta-text mb-4">
                        <span class="d-inline-flex align-items-center gap-2">
                            <span class="rounded-circle bg-danger-subtle text-danger d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                                <i class="bi bi-person-heart"></i>
                            </span>
                            by Admin
                        </span>
                        <span>&bull;</span>
                        <span>{{ $featuredPost->created_at->format('M d, Y') }}</span>
                        <span>&bull;</span>
                        <span>{{ $featuredPost->read_time }} min read</span>
                    </div>
                    <a href="{{ route('blog.show', $featuredPost->slug) }}" class="btn btn-brand px-4 py-3">
                        Read Full Article <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        @endif
    </section>

    <section class="container pb-4">
        <h2 class="section-label text-center mb-3">Explore Categories</h2>
        <div class="row g-3">
            @foreach($categories as $category)
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('blog.index', ['category' => $category->slug]) }}" class="category-card h-100 d-flex flex-column align-items-center justify-content-center text-center p-3">
                        <span class="category-icon mb-3"><i class="bi {{ $category->icon ?? 'bi-folder' }}"></i></span>
                        <span class="fw-bold">{{ $category->name }}</span>
                        <span class="text-muted-soft small">{{ $category->posts_count }} Posts</span>
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    <section class="container py-4">
        <div class="d-flex align-items-center justify-content-between gap-3 mb-3">
            <h2 class="section-label mb-0">Latest Articles</h2>
            <a href="{{ route('blog.index') }}" class="text-danger fw-bold">View all articles <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
        <div class="row g-4">
            @forelse($latestPosts as $post)
                <div class="col-md-6 col-lg-3">
                    @include('partials.post-card', ['post' => $post])
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state">No posts available yet.</div>
                </div>
            @endforelse
        </div>
    </section>

    <section class="container py-4">
        <div class="d-flex align-items-center justify-content-between gap-3 mb-3">
            <h2 class="section-label mb-0">Popular Posts</h2>
            <a href="{{ route('blog.index') }}" class="text-danger fw-bold">View all popular posts <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
        <div class="row g-4">
            @forelse($popularPosts as $post)
                <div class="col-lg-4">
                    <div class="d-flex gap-3 align-items-center">
                        <span class="popular-number">{{ $loop->iteration }}</span>
                        <a href="{{ route('blog.show', $post->slug) }}">
                            <img src="{{ $post->image_url }}" class="popular-thumb" alt="{{ $post->title }}">
                        </a>
                        <div>
                            <h3 class="h6 fw-bold mb-2"><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h3>
                            <div class="meta-text d-flex flex-wrap gap-2">
                                <span>{{ $post->created_at->format('M d, Y') }}</span>
                                <span>&bull;</span>
                                <span>{{ $post->read_time }} min read</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state">Popular posts will appear here.</div>
                </div>
            @endforelse
        </div>
    </section>

    @include('partials.newsletter')
@endsection
