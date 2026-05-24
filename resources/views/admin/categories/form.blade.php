@csrf

<div class="row g-3">
    <div class="col-lg-6">
        <label for="name" class="form-label fw-bold">Category Name</label>
        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name ?? '') }}" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-lg-6">
        <label for="slug" class="form-label fw-bold">Slug</label>
        <input type="text" id="slug" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $category->slug ?? '') }}" placeholder="auto generated if blank">
        @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-lg-6">
        <label for="icon" class="form-label fw-bold">Icon Class</label>
        <input type="text" id="icon" name="icon" class="form-control @error('icon') is-invalid @enderror" value="{{ old('icon', $category->icon ?? '') }}" placeholder="Example: bi-leaf">
        <div class="form-text">Use Bootstrap Icons class names like bi-heart-pulse, bi-airplane, bi-camera.</div>
        @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-lg-6">
        <label for="image" class="form-label fw-bold">Image (Optional)</label>
        <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    @isset($category)
        @if($category->image_url)
            <div class="col-lg-4">
                <label class="form-label fw-bold">Current Image</label>
                <div><img src="{{ $category->image_url }}" class="img-fluid rounded-3 border" alt="{{ $category->name }}"></div>
            </div>
        @endif
    @endisset

    <div class="col-12 d-flex gap-2 pt-3">
        <button class="btn btn-brand px-4" type="submit"><i class="bi bi-save me-1"></i> Save Category</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
</div>
