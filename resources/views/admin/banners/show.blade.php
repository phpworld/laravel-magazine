@extends('admin.layouts.app')

@section('title', 'View Banner')
@section('page-title', 'Banner Details')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.banners.index') }}">Banners</a></li>
                    <li class="breadcrumb-item active">{{ $banner->title }}</li>
                </ol>
            </nav>
            <div>
                <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-warning me-2">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Banners
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <!-- Banner Preview -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-eye me-2"></i>Banner Preview
                </h6>
            </div>
            <div class="card-body p-0">
                @if($banner->image_path && Storage::disk('public')->exists($banner->image_path))
                    <div class="position-relative">
                        <img src="{{ Storage::url($banner->image_path) }}" alt="{{ $banner->title }}" 
                             class="img-fluid w-100" style="max-height: 400px; object-fit: cover;">
                        
                        <!-- Overlay Content -->
                        <div class="position-absolute top-50 start-50 translate-middle text-center text-white" 
                             style="text-shadow: 2px 2px 4px rgba(0,0,0,0.7);">
                            <h2 class="display-4 fw-bold mb-3">{{ $banner->title }}</h2>
                            @if($banner->subtitle)
                                <p class="lead mb-4">{{ $banner->subtitle }}</p>
                            @endif
                            @if($banner->button_text && $banner->button_url)
                                <a href="{{ $banner->button_url }}" class="btn btn-primary btn-lg" target="_blank">
                                    {{ $banner->button_text }}
                                </a>
                            @endif
                        </div>
                    </div>
                @elseif($banner->image_path)
                    <div class="d-flex align-items-center justify-content-center py-5 bg-danger text-white">
                        <div class="text-center">
                            <i class="bi bi-exclamation-triangle" style="font-size: 3rem;"></i>
                            <h4 class="mt-2">Image Missing</h4>
                            <p>Image file not found: {{ $banner->image_path }}</p>
                            <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-light">
                                <i class="bi bi-upload"></i> Upload New Image
                            </a>
                        </div>
                    </div>
                @else
                    <div class="d-flex align-items-center justify-content-center py-5">
                        <div class="text-center text-muted">
                            <i class="bi bi-image" style="font-size: 3rem;"></i>
                            <p class="mt-2">No image uploaded</p>
                            <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-primary">
                                <i class="bi bi-upload"></i> Upload Image
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Banner Information -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-info-circle me-2"></i>Banner Information
                </h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Title:</strong></td>
                        <td>{{ $banner->title }}</td>
                    </tr>
                    <tr>
                        <td><strong>Subtitle:</strong></td>
                        <td>{{ $banner->subtitle ?? 'Not set' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Sort Order:</strong></td>
                        <td>{{ $banner->sort_order }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            <span class="badge {{ $banner->is_active ? 'bg-success' : 'bg-secondary' }}">
                                <i class="bi bi-{{ $banner->is_active ? 'check-circle' : 'x-circle' }}"></i>
                                {{ $banner->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                    </tr>
                    @if($banner->button_text)
                    <tr>
                        <td><strong>Button Text:</strong></td>
                        <td>{{ $banner->button_text }}</td>
                    </tr>
                    @endif
                    @if($banner->button_url)
                    <tr>
                        <td><strong>Button URL:</strong></td>
                        <td>
                            <a href="{{ $banner->button_url }}" target="_blank" class="text-primary">
                                {{ Str::limit($banner->button_url, 30) }}
                                <i class="bi bi-box-arrow-up-right ms-1"></i>
                            </a>
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td><strong>Created:</strong></td>
                        <td>{{ $banner->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Updated:</strong></td>
                        <td>{{ $banner->updated_at->format('M d, Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        @if($banner->description)
        <!-- Description -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-card-text me-2"></i>Description
                </h6>
            </div>
            <div class="card-body">
                <p class="mb-0">{{ $banner->description }}</p>
            </div>
        </div>
        @endif

        <!-- Actions -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-gear me-2"></i>Actions
                </h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit Banner
                    </a>
                    
                    <form method="POST" action="{{ route('admin.banners.toggle-status', $banner) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn {{ $banner->is_active ? 'btn-secondary' : 'btn-success' }} w-100"
                                onclick="return confirm('Are you sure you want to {{ $banner->is_active ? 'deactivate' : 'activate' }} this banner?')">
                            <i class="bi bi-{{ $banner->is_active ? 'x-circle' : 'check-circle' }}"></i>
                            {{ $banner->is_active ? 'Deactivate' : 'Activate' }} Banner
                        </button>
                    </form>
                    
                    <form method="POST" action="{{ route('admin.banners.destroy', $banner) }}" 
                          onsubmit="return confirm('Are you sure you want to delete this banner? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="bi bi-trash"></i> Delete Banner
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection