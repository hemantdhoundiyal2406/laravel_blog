<article class="article-card">
    <a href="{{ route('blog.show', $post->slug) }}">
        <img src="{{ $post->image_url }}" class="article-image" alt="{{ $post->title }}">
    </a>
    <div class="p-3 p-lg-4">
        <span class="badge-category mb-3">{{ $post->category->name }}</span>
        <h3 class="h5 fw-bold mb-3">
            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
        </h3>
        <p class="text-muted-soft mb-3">{{ $post->short_description }}</p>
        <div class="meta-text d-flex flex-wrap gap-2">
            <span>{{ $post->created_at->format('M d, Y') }}</span>
            <span>&bull;</span>
            <span>{{ $post->read_time }} min read</span>
        </div>
    </div>
</article>
