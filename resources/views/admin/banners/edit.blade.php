@extends('admin.layouts.app')

@section('title', 'Edit Banner')
@section('page-title', 'Edit Banner')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.banners.index') }}">Banners</a></li>
                    <li class="breadcrumb-item active">Edit: {{ $banner->title }}</li>
                </ol>
            </nav>
            <div>
                <a href="{{ route('admin.banners.show', $banner) }}" class="btn btn-info me-2">
                    <i class="bi bi-eye"></i> View
                </a>
                <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Banners
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="bi bi-pencil me-2"></i>Edit Banner: {{ $banner->title }}
        </h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.banners.update', $banner) }}" enctype="multipart/form-data" id="bannerForm">
            @csrf
            @method('PATCH')
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title', $banner->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                               id="sort_order" name="sort_order" value="{{ old('sort_order', $banner->sort_order) }}" min="0">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="subtitle" class="form-label">Subtitle</label>
                <input type="text" class="form-control @error('subtitle') is-invalid @enderror" 
                       id="subtitle" name="subtitle" value="{{ old('subtitle', $banner->subtitle) }}">
                @error('subtitle')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="3">{{ old('description', $banner->description) }}</textarea>
                <small class="form-text text-muted">Optional description for the banner</small>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Banner Image</label>
                
                @if($banner->image_path)
                    <div class="mb-3">
                        @if(Storage::disk('public')->exists($banner->image_path))
                            <img src="{{ Storage::url($banner->image_path) }}" alt="{{ $banner->title }}" 
                                 class="img-thumbnail" style="max-height: 200px;">
                            <div class="mt-2">
                                <small class="text-muted">Current image</small>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <i class="bi bi-exclamation-triangle"></i>
                                <strong>Image not found:</strong> {{ $banner->image_path }}
                                <br><small>The original image file is missing. Please upload a new image.</small>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i>
                        <strong>No image uploaded yet.</strong> Please select an image to upload.
                    </div>
                @endif
                
                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                       id="image" name="image" accept="image/*">
                <small class="form-text text-muted">
                    @if($banner->image_path && !Storage::disk('public')->exists($banner->image_path))
                        <strong>Required:</strong> Original image is missing, please upload a new image.
                    @else
                        Leave empty to keep current image.
                    @endif
                    Recommended size: 1920x800px. Max file size: 5MB. Supported formats: JPEG, PNG, JPG, GIF
                </small>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="button_text" class="form-label">Button Text</label>
                        <input type="text" class="form-control @error('button_text') is-invalid @enderror" 
                               id="button_text" name="button_text" value="{{ old('button_text', $banner->button_text) }}" 
                               placeholder="e.g., Shop Now, Learn More">
                        @error('button_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="button_url" class="form-label">Button URL</label>
                        <input type="url" class="form-control @error('button_url') is-invalid @enderror" 
                               id="button_url" name="button_url" value="{{ old('button_url', $banner->button_url) }}" 
                               placeholder="https://example.com">
                        @error('button_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                           {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">
                        Active (Show on homepage)
                    </label>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Update Banner
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    const form = document.getElementById('bannerForm');
    
    // Debug form submission
    form.addEventListener('submit', function(e) {
        console.log('Form submission triggered');
        console.log('Form action:', this.action);
        console.log('Form method:', this.method);
        console.log('Form enctype:', this.enctype);
        
        // Check if required fields are filled
        const title = document.getElementById('title').value;
        if (!title.trim()) {
            alert('Title is required!');
            e.preventDefault();
            return false;
        }
        
        console.log('Form validation passed, submitting...');
    });
    
    // Preview new image when selected
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            console.log('New image selected:', file.name);
            const reader = new FileReader();
            reader.onload = function(e) {
                let preview = document.getElementById('newImagePreview');
                if (!preview) {
                    preview = document.createElement('div');
                    preview.id = 'newImagePreview';
                    preview.className = 'mt-2';
                    imageInput.parentNode.appendChild(preview);
                }
                preview.innerHTML = `
                    <div class="border-top pt-2 mt-2">
                        <img src="${e.target.result}" alt="New Preview" class="img-thumbnail" style="max-height: 200px;">
                        <small class="d-block text-muted mt-1">New image preview</small>
                    </div>
                `;
            };
            reader.readAsDataURL(file);
        } else {
            const preview = document.getElementById('newImagePreview');
            if (preview) {
                preview.remove();
            }
        }
    });
});
</script>
@endsection