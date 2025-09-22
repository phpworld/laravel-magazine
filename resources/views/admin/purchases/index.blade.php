@extends('admin.layouts.app')

@section('title', 'Purchases Management')
@section('page-title', 'Purchases')

@section('content')
<div class="row">
    <!-- Stats Cards -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Purchases</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $stats['total_purchases'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-cart fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card users">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Completed</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $stats['completed_purchases'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-check-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card magazines">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Pending</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $stats['pending_purchases'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-clock fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card sales">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Revenue</div>
                        <div class="h5 mb-0 font-weight-bold">₹{{ number_format($stats['total_revenue'], 2) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-currency-rupee fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Search & Filter</h6>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.purchases.index') }}">
            <div class="row">
                <div class="col-md-3">
                    <label for="search" class="form-label">Search</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           value="{{ request('search') }}" placeholder="User name, email, or magazine title">
                </div>
                <div class="col-md-2">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                        <option value="refunded" {{ request('status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="date_from" class="form-label">From Date</label>
                    <input type="date" class="form-control" id="date_from" name="date_from" value="{{ request('date_from') }}">
                </div>
                <div class="col-md-2">
                    <label for="date_to" class="form-label">To Date</label>
                    <input type="date" class="form-control" id="date_to" name="date_to" value="{{ request('date_to') }}">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ route('admin.purchases.index') }}" class="btn btn-secondary">Clear</a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Purchases Table -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Purchases</h6>
    </div>
    <div class="card-body">
        @if($purchases->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Magazine</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Payment ID</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchases as $purchase)
                            <tr>
                                <td>{{ $purchase->id }}</td>
                                <td>
                                    <strong>{{ $purchase->user->name }}</strong><br>
                                    <small class="text-muted">{{ $purchase->user->email }}</small>
                                </td>
                                <td>{{ $purchase->magazine->title }}</td>
                                <td>₹{{ number_format($purchase->amount, 2) }}</td>
                                <td>
                                    @php
                                        $statusClass = [
                                            'completed' => 'success',
                                            'pending' => 'warning', 
                                            'failed' => 'danger',
                                            'refunded' => 'info'
                                        ][$purchase->payment_status] ?? 'secondary';
                                    @endphp
                                    <span class="badge bg-{{ $statusClass }}">
                                        {{ ucfirst($purchase->payment_status) }}
                                    </span>
                                </td>
                                <td>
                                    @if($purchase->razorpay_payment_id)
                                        <small>{{ $purchase->razorpay_payment_id }}</small>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $purchase->created_at->format('M d, Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.purchases.show', $purchase) }}" 
                                           class="btn btn-sm btn-info">View</a>
                                        
                                        @if($purchase->payment_status !== 'completed')
                                            <button type="button" class="btn btn-sm btn-warning" 
                                                    onclick="updateStatus({{ $purchase->id }}, 'completed')">
                                                Mark Complete
                                            </button>
                                        @endif
                                        
                                        @if($purchase->payment_status === 'completed')
                                            <button type="button" class="btn btn-sm btn-secondary" 
                                                    onclick="updateStatus({{ $purchase->id }}, 'refunded')">
                                                Refund
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $purchases->withQueryString()->links() }}
            </div>
        @else
            <div class="text-center text-muted py-4">
                <i class="bi bi-cart-x" style="font-size: 3rem;"></i>
                <p class="mt-2">No purchases found</p>
            </div>
        @endif
    </div>
</div>

<!-- Status Update Form (Hidden) -->
<form id="statusUpdateForm" method="POST" style="display: none;">
    @csrf
    @method('PATCH')
    <input type="hidden" name="payment_status" id="statusInput">
</form>
@endsection

@section('scripts')
<script>
function updateStatus(purchaseId, status) {
    if (confirm('Are you sure you want to update this purchase status?')) {
        const form = document.getElementById('statusUpdateForm');
        form.action = `/admin/purchases/${purchaseId}/status`;
        document.getElementById('statusInput').value = status;
        form.submit();
    }
}
</script>
@endsection