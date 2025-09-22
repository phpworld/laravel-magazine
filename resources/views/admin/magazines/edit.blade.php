@extends('admin.layouts.app')

@section('title', 'Edit Magazine')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Magazine</h1>
        <div>
            <a href="{{ route('admin.magazines.show', $magazine) }}" class="btn btn-info me-2">
                <i class="bi bi-eye"></i> View Magazine
            </a>
            <a href="{{ route('admin.magazines.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to Magazines
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('admin.magazines.update', $magazine) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
            <!-- Main Form -->
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-white">
                        <h6 class="m-0 font-weight-bold">Magazine Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $magazine->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="5" required>{{ old('description', $magazine->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                                    <select class="form-select @error('category_id') is-invalid @enderror" 
                                            id="category_id" name="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                    {{ old('category_id', $magazine->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price (₹) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                           id="price" name="price" step="0.01" min="0" 
                                           value="{{ old('price', $magazine->price) }}" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="publication_date" class="form-label">Publication Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('publication_date') is-invalid @enderror" 
                                           id="publication_date" name="publication_date" 
                                           value="{{ old('publication_date', $magazine->publication_date->format('Y-m-d')) }}" required>
                                    @error('publication_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="week_number" class="form-label">Week Number <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('week_number') is-invalid @enderror" 
                                           id="week_number" name="week_number" min="1" max="53" 
                                           value="{{ old('week_number', $magazine->week_number) }}" required>
                                    @error('week_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="year" class="form-label">Year <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('year') is-invalid @enderror" 
                                           id="year" name="year" min="2000" max="{{ date('Y') + 1 }}" 
                                           value="{{ old('year', $magazine->year) }}" required>
                                    @error('year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active"
                                       {{ old('is_active', $magazine->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active (visible to users)
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="is_featured" name="is_featured"
                                       {{ old('is_featured', $magazine->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">
                                    Featured (show in "Featured This Week" section)
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- File Uploads and Current Files -->
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header bg-success text-white">
                        <h6 class="m-0 font-weight-bold">Current Cover Image</h6>
                    </div>
                    <div class="card-body text-center">
                        @if($magazine->cover_image)
                            <img src="{{ asset('storage/' . $magazine->cover_image) }}" 
                                 alt="{{ $magazine->title }}" 
                                 class="img-fluid rounded shadow mb-3"
                                 style="max-height: 200px;">
                            <p class="text-success small">
                                <i class="bi bi-check-circle me-1"></i>
                                Current image uploaded
                            </p>
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3" 
                                 style="height: 200px;">
                                <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                            </div>
                            <p class="text-warning small">
                                <i class="bi bi-exclamation-triangle me-1"></i>
                                No cover image uploaded
                            </p>
                        @endif
                        
                        <div class="mb-3">
                            <label for="cover_image" class="form-label">Update Cover Image</label>
                            <input type="file" class="form-control @error('cover_image') is-invalid @enderror" 
                                   id="cover_image" name="cover_image" accept="image/*">
                            <small class="text-muted">Leave empty to keep current image</small>
                            @error('cover_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header bg-info text-white">
                        <h6 class="m-0 font-weight-bold">PDF File</h6>
                    </div>
                    <div class="card-body">
                        @if($magazine->pdf_file)
                            <div class="text-center mb-3">
                                <i class="bi bi-file-earmark-pdf text-danger" style="font-size: 3rem;"></i>
                                <p class="text-success small mt-2">
                                    <i class="bi bi-check-circle me-1"></i>
                                    PDF file uploaded
                                </p>
                                <a href="{{ asset('storage/' . $magazine->pdf_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye me-1"></i>View PDF
                                </a>
                            </div>
                        @else
                            <div class="text-center mb-3">
                                <i class="bi bi-file-earmark-pdf text-muted" style="font-size: 3rem;"></i>
                                <p class="text-warning small mt-2">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    No PDF file uploaded
                                </p>
                            </div>
                        @endif
                        
                        <div class="mb-3">
                            <label for="pdf_file" class="form-label">Update PDF File</label>
                            <input type="file" class="form-control @error('pdf_file') is-invalid @enderror" 
                                   id="pdf_file" name="pdf_file" accept=".pdf">
                            <small class="text-muted">Leave empty to keep current file</small>
                            @error('pdf_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-1"></i>Update Magazine
                            </button>
                            <a href="{{ route('admin.magazines.show', $magazine) }}" class="btn btn-info">
                                <i class="bi bi-eye me-1"></i>View Magazine
                            </a>
                            <a href="{{ route('admin.magazines.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate slug from title
    const titleInput = document.getElementById('title');
    
    titleInput.addEventListener('input', function() {
        // This is just for visual feedback - the actual slug is generated server-side
        console.log('Title changed to:', this.value);
    });
    
    // Show file name when file is selected
    const coverImageInput = document.getElementById('cover_image');
    const pdfFileInput = document.getElementById('pdf_file');
    
    coverImageInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            console.log('Cover image selected:', this.files[0].name);
        }
    });
    
    pdfFileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            console.log('PDF file selected:', this.files[0].name);
        }
    });
});
</script>
@endpush