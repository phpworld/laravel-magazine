@extends('frontend.layouts.app')

@section('title', 'My Dashboard - MagStore')

@section('content')
<div class="container py-5 mt-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="#overview" class="list-group-item list-group-item-action active" data-bs-toggle="pill">
                            <i class="bi bi-speedometer2 me-2"></i>Overview
                        </a>
                        <a href="#purchases" class="list-group-item list-group-item-action" data-bs-toggle="pill">
                            <i class="bi bi-bag-check me-2"></i>My Purchases
                        </a>
                        <a href="#account" class="list-group-item list-group-item-action" data-bs-toggle="pill">
                            <i class="bi bi-person me-2"></i>Account Settings
                        </a>
                        <a href="#downloads" class="list-group-item list-group-item-action" data-bs-toggle="pill">
                            <i class="bi bi-download me-2"></i>Downloads
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-md-9">
            <div class="tab-content">
                <!-- Overview Tab -->
                <div class="tab-pane fade show active" id="overview">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2 class="fw-bold">Welcome back, {{ auth()->user()->name }}!</h2>
                            <p class="text-muted mb-0">Here's what's happening with your account today.</p>
                        </div>
                    </div>
                    
                    <!-- Stats Cards -->
                    <div class="row g-4 mb-5">
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center p-4">
                                    <div class="bg-primary bg-gradient text-white rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                                        <i class="bi bi-bag-check fs-4"></i>
                                    </div>
                                    <h4 class="fw-bold">{{ $purchaseCount }}</h4>
                                    <p class="text-muted mb-0">Total Purchases</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center p-4">
                                    <div class="bg-success bg-gradient text-white rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                                        <i class="bi bi-download fs-4"></i>
                                    </div>
                                    <h4 class="fw-bold">{{ $totalDownloads }}</h4>
                                    <p class="text-muted mb-0">Downloads</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center p-4">
                                    <div class="bg-info bg-gradient text-white rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                                        <i class="bi bi-currency-rupee fs-4"></i>
                                    </div>
                                    <h4 class="fw-bold">₹{{ number_format($totalSpent) }}</h4>
                                    <p class="text-muted mb-0">Total Spent</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Activity -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-bottom-0 py-3">
                            <h5 class="fw-bold mb-0">Recent Activity</h5>
                        </div>
                        <div class="card-body">
                            @if($recentPurchases->count() > 0)
                                @foreach($recentPurchases as $purchase)
                                    <div class="d-flex align-items-center py-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                        <div class="bg-primary bg-gradient text-white rounded-circle p-2 me-3">
                                            <i class="bi bi-bag-check"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">{{ $purchase->magazine->title }}</h6>
                                            <p class="text-muted small mb-0">Purchased {{ $purchase->created_at->diffForHumans() }}</p>
                                        </div>
                                        <div class="text-end">
                                            <span class="fw-bold">₹{{ number_format($purchase->amount) }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-5">
                                    <i class="bi bi-bag text-muted" style="font-size: 3rem;"></i>
                                    <h5 class="text-muted mt-3">No purchases yet</h5>
                                    <p class="text-muted">Start exploring our magazine collection!</p>
                                    <a href="{{ route('magazines.index') }}" class="btn btn-primary">Browse Magazines</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Purchases Tab -->
                <div class="tab-pane fade" id="purchases">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-bold">My Purchases</h3>
                        <a href="{{ route('magazines.index') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Browse More
                        </a>
                    </div>
                    
                    @if($purchases->count() > 0)
                        <div class="row g-4">
                            @foreach($purchases as $purchase)
                                <div class="col-lg-6">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="row g-0">
                                            <div class="col-4">
                                                @if($purchase->magazine->cover_image)
                                                    <img src="{{ asset('storage/' . $purchase->magazine->cover_image) }}" 
                                                         alt="{{ $purchase->magazine->title }}" 
                                                         class="img-fluid rounded-start"
                                                         style="height: 150px; object-fit: cover; width: 100%;">
                                                @else
                                                    <div class="bg-light rounded-start d-flex align-items-center justify-content-center" style="height: 150px;">
                                                        <i class="bi bi-journal-text text-muted" style="font-size: 2rem;"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body p-3">
                                                    <h6 class="card-title fw-bold">{{ Str::limit($purchase->magazine->title, 40) }}</h6>
                                                    <p class="card-text text-muted small">{{ $purchase->magazine->category->name }}</p>
                                                    <p class="card-text">
                                                        <small class="text-muted">
                                                            Purchased {{ $purchase->created_at->format('M d, Y') }}
                                                        </small>
                                                    </p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="fw-bold text-primary">₹{{ number_format($purchase->amount) }}</span>
                                                        <div>
                                                            <a href="#" onclick="downloadMagazine({{ $purchase->magazine->id }})" class="btn btn-sm btn-success me-1" title="Download">
                                                                <i class="bi bi-download"></i>
                                                            </a>
                                                            <a href="{{ route('magazines.show', $purchase->magazine) }}" class="btn btn-sm btn-outline-primary" title="View Details">
                                                                <i class="bi bi-eye"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-4">
                            {{ $purchases->links() }}
                        </div>
                    @else
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center py-5">
                                <i class="bi bi-bag text-muted" style="font-size: 4rem;"></i>
                                <h4 class="text-muted mt-3">No purchases yet</h4>
                                <p class="text-muted">Discover and purchase amazing magazines from our collection</p>
                                <a href="{{ route('magazines.index') }}" class="btn btn-primary btn-lg">
                                    <i class="bi bi-search me-2"></i>Browse Magazines
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
                
                <!-- Account Tab -->
                <div class="tab-pane fade" id="account">
                    <h3 class="fw-bold mb-4">Account Settings</h3>
                    
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <form>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label fw-bold">Full Name</label>
                                        <input type="text" class="form-control" id="name" value="{{ auth()->user()->name }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label fw-bold">Email Address</label>
                                        <input type="email" class="form-control" id="email" value="{{ auth()->user()->email }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="password" class="form-label fw-bold">New Password</label>
                                        <input type="password" class="form-control" id="password" placeholder="Leave blank to keep current">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
                                        <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm new password">
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle me-2"></i>Update Account
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Downloads Tab -->
                <div class="tab-pane fade" id="downloads">
                    <h3 class="fw-bold mb-4">Download History</h3>
                    
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            @if($purchases->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Magazine</th>
                                                <th>Category</th>
                                                <th>Downloads</th>
                                                <th>Last Downloaded</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($purchases as $purchase)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if($purchase->magazine->cover_image)
                                                                <img src="{{ asset('storage/' . $purchase->magazine->cover_image) }}" 
                                                                     alt="{{ $purchase->magazine->title }}" 
                                                                     class="rounded me-3"
                                                                     style="width: 40px; height: 40px; object-fit: cover;">
                                                            @endif
                                                            <div>
                                                                <h6 class="mb-0">{{ Str::limit($purchase->magazine->title, 30) }}</h6>
                                                                <small class="text-muted">Week {{ $purchase->magazine->week_number }}, {{ $purchase->magazine->year }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $purchase->magazine->category->name }}</td>
                                                    <td>
                                                        <span class="badge bg-info">{{ $purchase->download_count }}</span>
                                                    </td>
                                                    <td>
                                                        @if($purchase->last_downloaded_at)
                                                            {{ $purchase->last_downloaded_at->diffForHumans() }}
                                                        @else
                                                            <span class="text-muted">Never</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="#" onclick="downloadMagazine({{ $purchase->magazine->id }})" class="btn btn-sm btn-success">
                                                            <i class="bi bi-download me-1"></i>Download
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="bi bi-download text-muted" style="font-size: 3rem;"></i>
                                    <h5 class="text-muted mt-3">No downloads yet</h5>
                                    <p class="text-muted">Purchase magazines to start downloading</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Initialize Bootstrap tabs
var triggerTabList = [].slice.call(document.querySelectorAll('[data-bs-toggle="pill"]'));
triggerTabList.forEach(function (triggerEl) {
    var tabTrigger = new bootstrap.Tab(triggerEl);
    
    triggerEl.addEventListener('click', function (event) {
        event.preventDefault();
        tabTrigger.show();
    });
});

function downloadMagazine(magazineId) {
    const downloadBtn = event.target;
    const originalText = downloadBtn.innerHTML;
    downloadBtn.innerHTML = '<i class="bi bi-hourglass-split me-1"></i>Preparing...';
    downloadBtn.disabled = true;

    window.location.href = '{{ route("magazine.download", ":id") }}'.replace(':id', magazineId);
    
    // Reset button after a delay
    setTimeout(() => {
        downloadBtn.innerHTML = originalText;
        downloadBtn.disabled = false;
    }, 3000);
}
</script>
@endpush