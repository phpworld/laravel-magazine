@extends('admin.layouts.app')

@section('title', 'Magazine Details')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Magazine Details</h1>
        <div>
            <a href="{{ route('admin.magazines.edit', $magazine) }}" class="btn btn-primary me-2">
                <i class="bi bi-pencil-square"></i> Edit Magazine
            </a>
            <a href="{{ route('admin.magazines.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to Magazines
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Magazine Cover and Basic Info -->
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">Cover Image</h6>
                </div>
                <div class="card-body text-center">
                    @if($magazine->cover_image)
                        <img src="{{ asset('storage/' . $magazine->cover_image) }}" 
                             alt="{{ $magazine->title }}" 
                             class="img-fluid rounded shadow"
                             style="max-height: 400px;">
                    @else
                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                             style="height: 400px;">
                            <i class="bi bi-journal-text text-muted" style="font-size: 5rem;"></i>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow mb-4">
                <div class="card-header bg-success text-white">
                    <h6 class="m-0 font-weight-bold">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.magazines.edit', $magazine) }}" class="btn btn-primary">
                            <i class="bi bi-pencil-square me-2"></i>Edit Magazine
                        </a>
                        @if($magazine->pdf_file)
                            <a href="{{ asset('storage/' . $magazine->pdf_file) }}" target="_blank" class="btn btn-success">
                                <i class="bi bi-file-earmark-pdf me-2"></i>View PDF
                            </a>
                        @endif
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="bi bi-trash me-2"></i>Delete Magazine
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Magazine Details -->
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white">
                    <h6 class="m-0 font-weight-bold">Magazine Information</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Title:</strong></div>
                        <div class="col-sm-9">{{ $magazine->title }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Category:</strong></div>
                        <div class="col-sm-9">
                            <span class="badge bg-primary">{{ $magazine->category->name }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Price:</strong></div>
                        <div class="col-sm-9">
                            <span class="text-success fw-bold">₹{{ number_format($magazine->price) }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Publication Date:</strong></div>
                        <div class="col-sm-9">{{ $magazine->publication_date->format('M d, Y') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Week/Year:</strong></div>
                        <div class="col-sm-9">Week {{ $magazine->week_number }}, {{ $magazine->year }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Status:</strong></div>
                        <div class="col-sm-9">
                            @if($magazine->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Downloads:</strong></div>
                        <div class="col-sm-9">{{ number_format($magazine->download_count) }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Slug:</strong></div>
                        <div class="col-sm-9"><code>{{ $magazine->slug }}</code></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Created:</strong></div>
                        <div class="col-sm-9">{{ $magazine->created_at->format('M d, Y H:i A') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Updated:</strong></div>
                        <div class="col-sm-9">{{ $magazine->updated_at->format('M d, Y H:i A') }}</div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="card shadow mb-4">
                <div class="card-header bg-warning text-dark">
                    <h6 class="m-0 font-weight-bold">Description</h6>
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ $magazine->description }}</p>
                </div>
            </div>

            <!-- Files Information -->
            <div class="card shadow mb-4">
                <div class="card-header bg-secondary text-white">
                    <h6 class="m-0 font-weight-bold">Files</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Cover Image</h6>
                            @if($magazine->cover_image)
                                <p class="text-success">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Uploaded
                                </p>
                                <small class="text-muted">{{ $magazine->cover_image }}</small>
                            @else
                                <p class="text-danger">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Not uploaded
                                </p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h6>PDF File</h6>
                            @if($magazine->pdf_file)
                                <p class="text-success">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Uploaded
                                </p>
                                <small class="text-muted">{{ $magazine->pdf_file }}</small>
                            @else
                                <p class="text-danger">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Not uploaded
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete "<strong>{{ $magazine->title }}</strong>"?</p>
                <p class="text-danger"><strong>Warning:</strong> This action cannot be undone. All associated files will be deleted permanently.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.magazines.destroy', $magazine) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>Delete Magazine
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection