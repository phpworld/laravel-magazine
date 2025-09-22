@extends('admin.layouts.app')

@section('title', 'Banner Management')
@section('page-title', 'Banner Management')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="alert alert-info mb-0">
                <i class="bi bi-info-circle"></i>
                <strong>Banner Management:</strong> Create and manage multiple homepage banners/sliders with drag-and-drop ordering.
            </div>
            <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add New Banner
            </a>
        </div>
    </div>
</div>

@if($banners->count() > 0)
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="bi bi-images me-2"></i>Homepage Banners ({{ $banners->count() }})
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="bannersTable">
                <thead>
                    <tr>
                        <th width="50">Order</th>
                        <th width="100">Image</th>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Button</th>
                        <th width="100">Status</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody id="sortableBanners">
                    @foreach($banners as $banner)
                    <tr data-id="{{ $banner->id }}" data-order="{{ $banner->sort_order }}">
                        <td class="text-center">
                            <i class="bi bi-grip-vertical text-muted" style="cursor: move;"></i>
                            <span class="sort-order">{{ $banner->sort_order }}</span>
                        </td>
                        <td>
                            @if($banner->image_path && Storage::disk('public')->exists($banner->image_path))
                                <img src="{{ Storage::url($banner->image_path) }}" alt="{{ $banner->title }}" 
                                     class="img-thumbnail" style="max-height: 60px; max-width: 100px;">
                            @elseif($banner->image_path)
                                <div class="bg-danger d-flex align-items-center justify-content-center text-white" style="height: 60px; width: 100px; font-size: 12px;">
                                    <div class="text-center">
                                        <i class="bi bi-exclamation-triangle"></i><br>
                                        Missing
                                    </div>
                                </div>
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 60px; width: 100px;">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $banner->title }}</strong>
                            @if($banner->description)
                                <br><small class="text-muted">{{ Str::limit($banner->description, 50) }}</small>
                            @endif
                        </td>
                        <td>
                            <span class="text-muted">{{ $banner->subtitle ?? 'No subtitle' }}</span>
                        </td>
                        <td>
                            @if($banner->button_text && $banner->button_url)
                                <span class="badge bg-info">{{ $banner->button_text }}</span>
                                <br><small class="text-muted">{{ Str::limit($banner->button_url, 30) }}</small>
                            @else
                                <span class="text-muted">No button</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <form method="POST" action="{{ route('admin.banners.toggle-status', $banner) }}" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm {{ $banner->is_active ? 'btn-success' : 'btn-secondary' }}" 
                                        onclick="return confirm('Are you sure you want to {{ $banner->is_active ? 'deactivate' : 'activate' }} this banner?')">
                                    <i class="bi bi-{{ $banner->is_active ? 'check-circle' : 'x-circle' }}"></i>
                                    {{ $banner->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.banners.show', $banner) }}" class="btn btn-sm btn-info" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.banners.destroy', $banner) }}" class="d-inline" 
                                      onsubmit="return confirm('Are you sure you want to delete this banner? This action cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
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
    </div>
</div>
@else
<div class="card shadow">
    <div class="card-body text-center py-5">
        <i class="bi bi-images text-muted" style="font-size: 3rem;"></i>
        <h4 class="mt-3">No Banners Found</h4>
        <p class="text-muted">Create your first homepage banner to get started.</p>
        <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Create First Banner
        </a>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sortableElement = document.getElementById('sortableBanners');
    
    if (sortableElement) {
        const sortable = Sortable.create(sortableElement, {
            handle: '.bi-grip-vertical',
            animation: 150,
            onEnd: function(evt) {
                const banners = [];
                const rows = sortableElement.querySelectorAll('tr[data-id]');
                
                rows.forEach((row, index) => {
                    banners.push({
                        id: row.getAttribute('data-id'),
                        sort_order: index + 1
                    });
                    
                    // Update the display order
                    const orderSpan = row.querySelector('.sort-order');
                    if (orderSpan) {
                        orderSpan.textContent = index + 1;
                    }
                });
                
                // Send AJAX request to update order
                fetch('{{ route("admin.banners.update-order") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ banners: banners })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message (you can customize this)
                        console.log('Banner order updated successfully');
                    } else {
                        alert('Error updating banner order: ' + data.message);
                        location.reload(); // Reload to restore original order
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating banner order.');
                    location.reload(); // Reload to restore original order
                });
            }
        });
    }
});
</script>
@endsection