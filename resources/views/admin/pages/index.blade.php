@extends('admin.layouts.app')

@section('title', 'Manage Pages')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Manage Pages</h1>
                <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Page
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="card-title mb-0">Pages List</h5>
                        </div>
                        <div class="col-md-6">
                            <form method="GET" action="{{ route('admin.pages.index') }}" class="d-flex">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" 
                                           value="{{ request('search') }}" placeholder="Search pages...">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    @if(request('search'))
                                        <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($pages->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Status</th>
                                        <th>Sort Order</th>
                                        <th>Last Updated</th>
                                        <th width="180">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pages as $page)
                                        <tr>
                                            <td>
                                                <strong>{{ $page->title }}</strong>
                                                @if($page->meta_title)
                                                    <br><small class="text-muted">Meta: {{ Str::limit($page->meta_title, 50) }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <code>{{ $page->slug }}</code>
                                            </td>
                                            <td>
                                                @if($page->is_published)
                                                    <span class="badge bg-success">Published</span>
                                                @else
                                                    <span class="badge bg-warning">Draft</span>
                                                @endif
                                            </td>
                                            <td>{{ $page->sort_order }}</td>
                                            <td>{{ $page->updated_at->format('M d, Y') }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('admin.pages.edit', $page) }}" 
                                                       class="btn btn-outline-primary" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    @if($page->is_published)
                                                        <a href="{{ route('pages.show', $page->slug) }}" 
                                                           class="btn btn-outline-info" title="View" target="_blank">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    @endif
                                                    <button type="button" class="btn btn-outline-danger" 
                                                            title="Delete" onclick="deletePage({{ $page->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted">
                                    Showing {{ $pages->firstItem() }} to {{ $pages->lastItem() }} 
                                    of {{ $pages->total() }} results
                                </div>
                                {{ $pages->links() }}
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No pages found</h5>
                            <p class="text-muted">
                                @if(request('search'))
                                    No pages match your search criteria.
                                @else
                                    Get started by creating your first page.
                                @endif
                            </p>
                            @if(!request('search'))
                                <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Create First Page
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
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
                Are you sure you want to delete this page? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
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
function deletePage(pageId) {
    const form = document.getElementById('deleteForm');
    form.action = `/admin/pages/${pageId}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endpush