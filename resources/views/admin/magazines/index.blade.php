@extends('admin.layouts.app')

@section('title', 'Magazines')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Magazines</h1>
        <a href="{{ route('admin.magazines.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Magazine
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">All Magazines</h6>
                <div class="d-flex align-items-center">
                    <form method="GET" action="{{ route('admin.magazines.index') }}" class="d-flex me-3">
                        <input type="text" 
                               name="search" 
                               class="form-control form-control-sm me-2" 
                               placeholder="Search magazines..." 
                               value="{{ request('search') }}"
                               style="width: 200px;">
                        <button type="submit" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('search'))
                            <a href="{{ route('admin.magazines.index') }}" class="btn btn-outline-secondary btn-sm ms-1">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </form>
                    <form method="GET" action="{{ route('admin.magazines.index') }}" class="d-flex align-items-center">
                        <label class="form-label me-2 mb-0 small">Show:</label>
                        <select name="per_page" class="form-select form-select-sm" onchange="this.form.submit()" style="width: auto;">
                            <option value="5" {{ request('per_page', 5) == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        </select>
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($magazines->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Cover</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Week/Year</th>
                                <th>Status</th>
                                <th>Featured</th>
                                <th>Downloads</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($magazines as $magazine)
                                <tr>
                                    <td>
                                        @if($magazine->cover_image)
                                            <img src="{{ asset('storage/' . $magazine->cover_image) }}" 
                                                 alt="{{ $magazine->title }}" 
                                                 style="width: 50px; height: 70px; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                                 style="width: 50px; height: 70px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $magazine->title }}</td>
                                    <td>{{ $magazine->category->name }}</td>
                                    <td>${{ number_format($magazine->price, 2) }}</td>
                                    <td>Week {{ $magazine->week_number }}, {{ $magazine->year }}</td>
                                    <td>
                                        @if($magazine->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($magazine->is_featured)
                                            <span class="badge bg-warning">
                                                <i class="fas fa-star"></i> Featured
                                            </span>
                                        @else
                                            <span class="badge bg-light text-muted">Regular</span>
                                        @endif
                                    </td>
                                    <td>{{ $magazine->download_count }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.magazines.show', $magazine) }}" 
                                               class="btn btn-info btn-sm" title="View Details">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.magazines.edit', $magazine) }}" 
                                               class="btn btn-warning btn-sm" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('admin.magazines.destroy', $magazine) }}" 
                                                  method="POST" 
                                                  style="display: inline;"
                                                  onsubmit="return confirm('Are you sure you want to delete this magazine?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination Section -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted">
                        @if($magazines->total() > 0)
                            Showing {{ $magazines->firstItem() }} to {{ $magazines->lastItem() }} of {{ $magazines->total() }} results
                            @if(request('search'))
                                for "<strong>{{ request('search') }}</strong>"
                            @endif
                        @endif
                    </div>
                    <div>
                        {{ $magazines->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="bi bi-journal-text" style="font-size: 3rem; color: #ddd;"></i>
                    <h5 class="text-muted mt-3">No magazines found</h5>
                    <p class="text-muted">Start by adding your first magazine.</p>
                    <a href="{{ route('admin.magazines.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Add First Magazine
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection