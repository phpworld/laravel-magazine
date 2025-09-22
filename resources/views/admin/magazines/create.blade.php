@extends('admin.layouts.app')

@section('title', 'Create Magazine')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create New Magazine</h1>
        <a href="{{ route('admin.magazines.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Magazines
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Magazine Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.magazines.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}" 
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-select @error('category_id') is-invalid @enderror" 
                                    id="category_id" 
                                    name="category_id" 
                                    required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" 
                              name="description" 
                              rows="4" 
                              required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="price" class="form-label">Price ($) <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control @error('price') is-invalid @enderror" 
                                   id="price" 
                                   name="price" 
                                   step="0.01" 
                                   min="0" 
                                   value="{{ old('price') }}" 
                                   required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="week_number" class="form-label">Week Number <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control @error('week_number') is-invalid @enderror" 
                                   id="week_number" 
                                   name="week_number" 
                                   min="1" 
                                   max="53" 
                                   value="{{ old('week_number', date('W')) }}" 
                                   required>
                            @error('week_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="year" class="form-label">Year <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control @error('year') is-invalid @enderror" 
                                   id="year" 
                                   name="year" 
                                   min="2000" 
                                   max="{{ date('Y') + 1 }}" 
                                   value="{{ old('year', date('Y')) }}" 
                                   required>
                            @error('year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="publication_date" class="form-label">Publication Date <span class="text-danger">*</span></label>
                    <input type="date" 
                           class="form-control @error('publication_date') is-invalid @enderror" 
                           id="publication_date" 
                           name="publication_date" 
                           value="{{ old('publication_date', date('Y-m-d')) }}" 
                           required>
                    @error('publication_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="cover_image" class="form-label">Cover Image</label>
                            <input type="file" 
                                   class="form-control @error('cover_image') is-invalid @enderror" 
                                   id="cover_image" 
                                   name="cover_image" 
                                   accept="image/*">
                            <div class="form-text">Recommended: 400x600px, JPG/PNG, Max 2MB</div>
                            @error('cover_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="pdf_file" class="form-label">PDF File <span class="text-danger">*</span></label>
                            <input type="file" 
                                   class="form-control @error('pdf_file') is-invalid @enderror" 
                                   id="pdf_file" 
                                   name="pdf_file" 
                                   accept=".pdf" 
                                   required>
                            <div class="form-text">PDF format only, Max 10MB</div>
                            @error('pdf_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" 
                           class="form-check-input" 
                           id="is_active" 
                           name="is_active" 
                           value="1" 
                           {{ old('is_active', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">
                        Active (Magazine will be visible to users)
                    </label>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" 
                           class="form-check-input" 
                           id="is_featured" 
                           name="is_featured" 
                           value="1" 
                           {{ old('is_featured', false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_featured">
                        Featured (Show in "Featured This Week" section)
                    </label>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create Magazine
                    </button>
                    <a href="{{ route('admin.magazines.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('title').addEventListener('input', function() {
    // Auto-generate slug preview (optional)
    const title = this.value;
    const slug = title.toLowerCase()
        .replace(/[^\w\s-]/g, '')
        .replace(/[\s_-]+/g, '-')
        .replace(/^-+|-+$/g, '');
    console.log('Generated slug:', slug);
});
</script>
@endsection