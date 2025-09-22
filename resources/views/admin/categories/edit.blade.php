@extends('admin.layouts.app')

@section('title', 'Edit Category')
@section('page-title', 'Edit Category: ' . $category->name)

@section('page-actions')
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back to Categories
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Edit Category Information</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $category->name) }}" 
                               required 
                               placeholder="Enter category name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">This will be used to organize magazines</div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="4" 
                                  placeholder="Enter category description">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Brief description of what this category contains</div>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" 
                               class="form-check-input" 
                               id="is_active" 
                               name="is_active" 
                               value="1" 
                               {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            <strong>Active</strong>
                            <br>
                            <small class="text-muted">Users can see magazines in this category</small>
                        </label>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Update Category
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bi bi-info-circle"></i> Category Stats
                </h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h4 class="text-primary">{{ $category->magazines()->count() }}</h4>
                            <small class="text-muted">Magazines</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <h4 class="text-success">{{ $category->magazines()->where('is_active', true)->count() }}</h4>
                        <small class="text-muted">Active</small>
                    </div>
                </div>
                
                <hr>
                
                <div class="small">
                    <p class="mb-2"><strong>Current Slug:</strong> <code>{{ $category->slug }}</code></p>
                    <p class="mb-2"><strong>Created:</strong> {{ $category->created_at->format('M d, Y H:i') }}</p>
                    <p class="mb-0"><strong>Last Updated:</strong> {{ $category->updated_at->format('M d, Y H:i') }}</p>
                </div>
                
                @if($category->magazines()->count() > 0)
                    <hr>
                    <h6 class="mb-2">Recent Magazines:</h6>
                    <div class="list-group list-group-flush">
                        @foreach($category->magazines()->latest()->take(3)->get() as $magazine)
                            <div class="list-group-item border-0 px-0 py-1">
                                <small>{{ Str::limit($magazine->title, 30) }}</small>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        
        @if($category->magazines()->count() > 0)
            <div class="card mt-3">
                <div class="card-header bg-warning text-dark">
                    <h6 class="card-title mb-0">
                        <i class="bi bi-exclamation-triangle"></i> Important
                    </h6>
                </div>
                <div class="card-body">
                    <p class="small mb-0">This category has {{ $category->magazines()->count() }} magazine(s). Deleting this category will also affect these magazines.</p>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection