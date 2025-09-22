@extends('frontend.layouts.app')

@section('title', 'My Purchases - MagStore')

@section('content')
<div class="container py-5 mt-5">
    <div class="row">
        <!-- Header -->
        <div class="col-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Purchases</li>
                </ol>
            </nav>
            
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="fw-bold mb-2">My Purchases</h1>
                    <p class="text-muted mb-0">View and manage your purchased magazines</p>
                </div>
                <a href="{{ route('magazines.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-plus-circle me-2"></i>Browse More Magazines
                </a>
            </div>
        </div>
    </div>

    @if($purchases->count() > 0)
        <!-- Purchase Stats -->
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="bg-primary bg-gradient text-white rounded-circle p-3 mx-auto mb-3" style="width: 50px; height: 50px;">
                            <i class="bi bi-bag-check fs-5"></i>
                        </div>
                        <h4 class="fw-bold">{{ $purchases->total() }}</h4>
                        <small class="text-muted">Total Purchases</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="bg-success bg-gradient text-white rounded-circle p-3 mx-auto mb-3" style="width: 50px; height: 50px;">
                            <i class="bi bi-currency-rupee fs-5"></i>
                        </div>
                        <h4 class="fw-bold">₹{{ number_format($purchases->sum('amount')) }}</h4>
                        <small class="text-muted">Total Spent</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="bg-info bg-gradient text-white rounded-circle p-3 mx-auto mb-3" style="width: 50px; height: 50px;">
                            <i class="bi bi-download fs-5"></i>
                        </div>
                        <h4 class="fw-bold">{{ $purchases->sum('download_count') }}</h4>
                        <small class="text-muted">Total Downloads</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="bg-warning bg-gradient text-white rounded-circle p-3 mx-auto mb-3" style="width: 50px; height: 50px;">
                            <i class="bi bi-calendar-event fs-5"></i>
                        </div>
                        <h4 class="fw-bold">{{ $purchases->where('created_at', '>=', now()->startOfMonth())->count() }}</h4>
                        <small class="text-muted">This Month</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Purchases List -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Purchase History</h5>
                    <small class="text-muted">{{ $purchases->total() }} purchases found</small>
                </div>
            </div>
            <div class="card-body p-0">
                @foreach($purchases as $purchase)
                    <div class="border-bottom p-4">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                @if($purchase->magazine->cover_image)
                                    <img src="{{ asset('storage/' . $purchase->magazine->cover_image) }}" 
                                         alt="{{ $purchase->magazine->title }}" 
                                         class="img-fluid rounded shadow-sm"
                                         style="width: 80px; height: 110px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center rounded" 
                                         style="width: 80px; height: 110px;">
                                        <i class="bi bi-journal-text text-muted fs-3"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="col-md-6">
                                <h6 class="fw-bold mb-1">{{ $purchase->magazine->title }}</h6>
                                <div class="d-flex flex-wrap gap-2 mb-2">
                                    <span class="badge bg-light text-dark">{{ $purchase->magazine->category->name }}</span>
                                    <span class="badge bg-success">{{ ucfirst($purchase->payment_status) }}</span>
                                </div>
                                <div class="small text-muted">
                                    <div class="mb-1">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        Purchased: {{ $purchase->created_at->format('M d, Y g:i A') }}
                                    </div>
                                    <div class="mb-1">
                                        <i class="bi bi-download me-1"></i>
                                        Downloaded {{ $purchase->download_count }} times
                                    </div>
                                    @if($purchase->last_downloaded_at)
                                        <div>
                                            <i class="bi bi-clock me-1"></i>
                                            Last download: {{ $purchase->last_downloaded_at->diffForHumans() }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-2 text-center">
                                <div class="fw-bold text-primary fs-5">₹{{ number_format($purchase->amount) }}</div>
                                <small class="text-muted">Amount Paid</small>
                            </div>
                            
                            <div class="col-md-2 text-end">
                                <div class="d-flex flex-column gap-2">
                                    <a href="{{ route('magazines.show', $purchase->magazine) }}" 
                                       class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-eye me-1"></i>View Details
                                    </a>
                                    <a href="#" onclick="downloadMagazine({{ $purchase->magazine->id }})" 
                                       class="btn btn-success btn-sm">
                                        <i class="bi bi-download me-1"></i>Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $purchases->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="bi bi-bag-x text-muted" style="font-size: 4rem;"></i>
            </div>
            <h3 class="fw-bold mb-3">No Purchases Yet</h3>
            <p class="text-muted mb-4">You haven't purchased any magazines yet. Start exploring our collection!</p>
            <a href="{{ route('magazines.index') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-collection me-2"></i>Browse Magazines
            </a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function downloadMagazine(magazineId) {
    const downloadBtn = event.target;
    const originalText = downloadBtn.innerHTML;
    downloadBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Preparing...';
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