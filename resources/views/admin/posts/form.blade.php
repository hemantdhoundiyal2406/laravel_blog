@csrf

<div class="row g-3">
    <div class="col-lg-8">
        <label for="title" class="form-label fw-bold">Title</label>
        <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $post->title ?? '') }}" required>
        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-lg-4">
        <label for="slug" class="form-label fw-bold">Slug</label>
        <input type="text" id="slug" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $post->slug ?? '') }}" placeholder="auto generated if blank">
        @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-lg-6">
        <label for="category_id" class="form-label fw-bold">Category</label>
        <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
            <option value="">Select category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected((string) old('category_id', $post->category_id ?? '') === (string) $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-lg-3">
        <label for="read_time" class="form-label fw-bold">Read Time</label>
        <input type="number" id="read_time" name="read_time" min="1" max="60" class="form-control @error('read_time') is-invalid @enderror" value="{{ old('read_time', $post->read_time ?? 5) }}" required>
        @error('read_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-lg-3">
        <label for="status" class="form-label fw-bold">Status</label>
        <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
            <option value="published" @selected(old('status', $post->status ?? 'published') === 'published')>Published</option>
            <option value="unpublished" @selected(old('status', $post->status ?? '') === 'unpublished')>Unpublished</option>
        </select>
        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-12">
        <label for="short_description" class="form-label fw-bold">Short Description</label>
        <textarea id="short_description" name="short_description" rows="3" class="form-control @error('short_description') is-invalid @enderror" required>{{ old('short_description', $post->short_description ?? '') }}</textarea>
        @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-12">
        <label for="content" class="form-label fw-bold">Full Content</label>
        <div class="rich-editor-wrapper @error('content') is-invalid @enderror">
            <div id="content-editor" class="rich-editor"></div>
            <textarea id="content" name="content" class="d-none">{{ old('content', $post->content ?? '') }}</textarea>
        </div>
        @error('content')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>

    <div class="col-lg-8">
        <label for="image" class="form-label fw-bold">Blog Image</label>
        <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" @isset($post) @else required @endisset>
        <div class="form-text">Accepted: jpg, jpeg, png, webp. Max size: 2MB.</div>
        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    @isset($post)
        <div class="col-lg-4">
            <label class="form-label fw-bold">Current Image</label>
            <div><img src="{{ $post->image_url }}" class="img-fluid rounded-3 border" alt="{{ $post->title }}"></div>
        </div>
    @endisset

    <div class="col-12">
        <div class="d-flex flex-wrap gap-4">
            <div class="form-check">
                <input type="checkbox" id="is_featured" name="is_featured" class="form-check-input" value="1" @checked(old('is_featured', $post->is_featured ?? false))>
                <label class="form-check-label fw-bold" for="is_featured">Featured Post</label>
            </div>
            <div class="form-check">
                <input type="checkbox" id="is_popular" name="is_popular" class="form-check-input" value="1" @checked(old('is_popular', $post->is_popular ?? false))>
                <label class="form-check-label fw-bold" for="is_popular">Popular Post</label>
            </div>
        </div>
    </div>

    <div class="col-12 d-flex gap-2 pt-3">
        <button class="btn btn-brand px-4" type="submit"><i class="bi bi-save me-1"></i> Save Blog</button>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
</div>

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const textarea = document.getElementById('content');
            const editorElement = document.getElementById('content-editor');

            if (!textarea || !editorElement || typeof Quill === 'undefined') {
                return;
            }

            const quill = new Quill(editorElement, {
                theme: 'snow',
                placeholder: 'Write full blog content here...',
                modules: {
                    toolbar: [
                        [{ header: [2, 3, false] }],
                        ['bold', 'italic', 'underline'],
                        [{ list: 'ordered' }, { list: 'bullet' }],
                        ['blockquote', 'link'],
                        ['clean']
                    ]
                }
            });

            const initialContent = textarea.value.trim();

            if (initialContent) {
                if (initialContent.includes('<') && initialContent.includes('>')) {
                    quill.clipboard.dangerouslyPasteHTML(initialContent);
                } else {
                    quill.setText(initialContent);
                }
            }

            textarea.closest('form').addEventListener('submit', function () {
                textarea.value = quill.getText().trim() ? quill.root.innerHTML.trim() : '';
            });
        });
    </script>
@endpush
