@extends('admin.layouts.app')

@section('title', 'Edit Page')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Edit Page: {{ $page->title }}</h1>
                <div>
                    @if($page->is_published)
                        <a href="{{ route('pages.show', $page->slug) }}" class="btn btn-outline-info me-2" target="_blank">
                            <i class="fas fa-eye"></i> View Page
                        </a>
                    @endif
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Pages
                    </a>
                </div>
            </div>

            <form action="{{ route('admin.pages.update', $page) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Page Content</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                           id="title" name="title" value="{{ old('title', $page->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                           id="slug" name="slug" value="{{ old('slug', $page->slug) }}"
                                           placeholder="Leave empty to auto-generate from title">
                                    <div class="form-text">URL-friendly version of the title. Leave empty to auto-generate.</div>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" 
                                              id="content" name="content" rows="15" required>{{ old('content', $page->content) }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- SEO Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">SEO Settings</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="meta_title" class="form-label">Meta Title</label>
                                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror" 
                                           id="meta_title" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}"
                                           maxlength="60" placeholder="Leave empty to use page title">
                                    <div class="form-text">Recommended: 50-60 characters</div>
                                    @error('meta_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                              id="meta_description" name="meta_description" rows="3" 
                                              maxlength="160" placeholder="Brief description for search engines">{{ old('meta_description', $page->meta_description) }}</textarea>
                                    <div class="form-text">Recommended: 150-160 characters</div>
                                    @error('meta_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Page Settings</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_published" 
                                               name="is_published" {{ old('is_published', $page->is_published) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_published">
                                            Published
                                        </label>
                                    </div>
                                    <div class="form-text">Uncheck to save as draft</div>
                                </div>

                                <div class="mb-3">
                                    <label for="sort_order" class="form-label">Sort Order</label>
                                    <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                           id="sort_order" name="sort_order" value="{{ old('sort_order', $page->sort_order) }}" min="0">
                                    <div class="form-text">Used for ordering in navigation menus</div>
                                    @error('sort_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <hr>

                                <div class="mb-3">
                                    <small class="text-muted">
                                        <strong>Created:</strong> {{ $page->created_at->format('M d, Y \a\t g:i A') }}<br>
                                        <strong>Last Updated:</strong> {{ $page->updated_at->format('M d, Y \a\t g:i A') }}
                                    </small>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Update Page
                                    </button>
                                    <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">
                                        Cancel
                                    </a>
                                    <button type="button" class="btn btn-outline-danger" onclick="deletePage({{ $page->id }})">
                                        <i class="fas fa-trash"></i> Delete Page
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the page "{{ $page->title }}"? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" action="{{ route('admin.pages.destroy', $page) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Auto-generate slug from title (only if slug is empty or auto-generated)
const originalSlug = '{{ $page->slug }}';
let isAutoSlug = false;

document.getElementById('title').addEventListener('input', function() {
    const title = this.value;
    const slugField = document.getElementById('slug');
    
    if (slugField.value === '' || isAutoSlug) {
        const slug = title.toLowerCase()
            .replace(/[^a-z0-9 -]/g, '') // Remove special characters
            .replace(/\s+/g, '-') // Replace spaces with hyphens
            .replace(/-+/g, '-') // Replace multiple hyphens with single
            .trim('-'); // Remove leading/trailing hyphens
        
        slugField.value = slug;
        isAutoSlug = true;
    }
});

// Stop auto-generation when user manually edits slug
document.getElementById('slug').addEventListener('input', function() {
    isAutoSlug = false;
});

// Character counters
document.getElementById('meta_title').addEventListener('input', function() {
    updateCharacterCount(this, 60);
});

document.getElementById('meta_description').addEventListener('input', function() {
    updateCharacterCount(this, 160);
});

function updateCharacterCount(element, maxLength) {
    const currentLength = element.value.length;
    const helpText = element.nextElementSibling;
    
    if (helpText && helpText.classList.contains('form-text')) {
        helpText.textContent = `${currentLength}/${maxLength} characters`;
        
        if (currentLength > maxLength) {
            helpText.classList.add('text-danger');
        } else {
            helpText.classList.remove('text-danger');
        }
    }
}

// Initialize character counters
updateCharacterCount(document.getElementById('meta_title'), 60);
updateCharacterCount(document.getElementById('meta_description'), 160);

function deletePage(pageId) {
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endpush