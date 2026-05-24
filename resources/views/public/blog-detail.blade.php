@extends('layouts.public')

@section('title', $post->title.' - Purely Blog')

@section('content')
    <section class="container py-5">
        <div class="row g-5">
            <div class="col-lg-8">
                <span class="badge-category blue mb-3">{{ $post->category->name }}</span>
                <h1 class="detail-title mb-3">{{ $post->title }}</h1>
                <div class="meta-text d-flex flex-wrap gap-3 mb-4">
                    <span><i class="bi bi-calendar3 me-1"></i>{{ $post->created_at->format('M d, Y') }}</span>
                    <span><i class="bi bi-clock me-1"></i>{{ $post->read_time }} min read</span>
                </div>

                <img src="{{ $post->image_url }}" class="detail-image mb-4" alt="{{ $post->title }}">

                <article class="post-content">
                    @if($post->content !== strip_tags($post->content))
                        {!! $post->content !!}
                    @else
                        {!! nl2br(e($post->content)) !!}
                    @endif
                </article>

                <div class="d-flex flex-column flex-md-row justify-content-between gap-3 border-top border-bottom py-4 my-5">
                    @if($previousPost)
                        <a class="fw-bold text-danger" href="{{ route('blog.show', $previousPost->slug) }}"><i class="bi bi-arrow-left me-1"></i> Previous Post</a>
                    @else
                        <span></span>
                    @endif

                    @if($nextPost)
                        <a class="fw-bold text-danger" href="{{ route('blog.show', $nextPost->slug) }}">Next Post <i class="bi bi-arrow-right ms-1"></i></a>
                    @endif
                </div>

                <div id="newsletter" class="soft-panel p-4 p-lg-5">
                    <div class="row align-items-center g-3">
                        <div class="col-lg-5">
                            <h2 class="h3 fw-bold mb-2">Stay Inspired</h2>
                            <p class="text-muted-soft mb-0">Subscribe to get travel inspiration and fresh blog updates.</p>
                        </div>
                        <div class="col-lg-7">
                            <form action="{{ route('subscribe.store') }}" method="POST" class="row g-2">
                                @csrf
                                <div class="col-md">
                                    <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                                </div>
                                <div class="col-md-auto">
                                    <button class="btn btn-navy w-100 px-4" type="submit">Subscribe</button>
                                </div>
                                <div class="col-12 small text-muted-soft">We respect your privacy. Unsubscribe anytime.</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <aside class="col-lg-4">
                <div class="sidebar-card p-4">
                    <h2 class="h4 fw-bold mb-4">Related Posts</h2>
                    <div class="d-grid gap-4">
                        @forelse($relatedPosts as $related)
                            <div class="d-flex gap-3">
                                <a href="{{ route('blog.show', $related->slug) }}">
                                    <img src="{{ $related->image_url }}" class="related-thumb" alt="{{ $related->title }}">
                                </a>
                                <div>
                                    <a href="{{ route('blog.index', ['category' => $related->category->slug]) }}" class="text-primary fw-bold small">{{ $related->category->name }}</a>
                                    <h3 class="h6 fw-bold mt-2 mb-2">
                                        <a href="{{ route('blog.show', $related->slug) }}">{{ $related->title }}</a>
                                    </h3>
                                    <div class="meta-text d-flex flex-wrap gap-2">
                                        <span>{{ $related->created_at->format('M d, Y') }}</span>
                                        <span>&bull;</span>
                                        <span>{{ $related->read_time }} min read</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted-soft mb-0">Related posts will appear here.</p>
                        @endforelse
                    </div>
                </div>
            </aside>
        </div>
    </section>
@endsection
