@extends('admin.layouts.app')

@section('title', 'Purchase Details')
@section('page-title', 'Purchase #' . $purchase->id)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Purchase Information</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="font-weight-bold">Purchase Details</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Purchase ID:</strong></td>
                                <td>{{ $purchase->id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Amount:</strong></td>
                                <td>₹{{ number_format($purchase->amount, 2) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
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
                            </tr>
                            <tr>
                                <td><strong>Purchase Date:</strong></td>
                                <td>{{ $purchase->created_at->format('M d, Y H:i:s') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="font-weight-bold">Payment Details</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Razorpay Order ID:</strong></td>
                                <td>{{ $purchase->razorpay_order_id ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Razorpay Payment ID:</strong></td>
                                <td>{{ $purchase->razorpay_payment_id ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Razorpay Signature:</strong></td>
                                <td>
                                    @if($purchase->razorpay_signature)
                                        <small class="text-muted">{{ Str::limit($purchase->razorpay_signature, 20) }}...</small>
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Magazine Information</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        @if($purchase->magazine->cover_image)
                            <img src="{{ Storage::url($purchase->magazine->cover_image) }}" 
                                 alt="{{ $purchase->magazine->title }}" 
                                 class="img-fluid rounded">
                        @else
                            <div class="bg-light p-4 text-center rounded">
                                <i class="bi bi-journal-text text-muted" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-9">
                        <h5>{{ $purchase->magazine->title }}</h5>
                        <p class="text-muted">{{ $purchase->magazine->description }}</p>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Category:</strong> {{ $purchase->magazine->category->name }}<br>
                                <strong>Price:</strong> ₹{{ number_format($purchase->magazine->price, 2) }}<br>
                                <strong>Issue Date:</strong> {{ $purchase->magazine->issue_date->format('M d, Y') }}
                            </div>
                            <div class="col-md-6">
                                <strong>Published:</strong> {{ $purchase->magazine->is_published ? 'Yes' : 'No' }}<br>
                                <strong>Created:</strong> {{ $purchase->magazine->created_at->format('M d, Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Customer Information</h6>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <i class="bi bi-person-circle" style="font-size: 3rem; color: #ddd;"></i>
                    <h5 class="mt-2">{{ $purchase->user->name }}</h5>
                    <p class="text-muted">{{ $purchase->user->email }}</p>
                </div>
                
                <table class="table table-borderless table-sm">
                    <tr>
                        <td><strong>Role:</strong></td>
                        <td>
                            <span class="badge bg-{{ $purchase->user->role === 'admin' ? 'danger' : 'primary' }}">
                                {{ ucfirst($purchase->user->role) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Member Since:</strong></td>
                        <td>{{ $purchase->user->created_at->format('M d, Y') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total Purchases:</strong></td>
                        <td>{{ $purchase->user->purchases()->count() }}</td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.users.show', $purchase->user) }}" 
                   class="btn btn-sm btn-primary">View User Profile</a>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Actions</h6>
            </div>
            <div class="card-body">
                @if($purchase->payment_status === 'pending')
                    <button type="button" class="btn btn-success btn-sm w-100 mb-2" 
                            onclick="updateStatus('completed')">
                        <i class="bi bi-check-circle"></i> Mark as Completed
                    </button>
                    <button type="button" class="btn btn-danger btn-sm w-100 mb-2" 
                            onclick="updateStatus('failed')">
                        <i class="bi bi-x-circle"></i> Mark as Failed
                    </button>
                @elseif($purchase->payment_status === 'completed')
                    <button type="button" class="btn btn-warning btn-sm w-100 mb-2" 
                            onclick="updateStatus('refunded')">
                        <i class="bi bi-arrow-counterclockwise"></i> Process Refund
                    </button>
                @endif
                
                <form method="POST" action="{{ route('admin.purchases.destroy', $purchase) }}" 
                      onsubmit="return confirm('Are you sure you want to delete this purchase record?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm w-100">
                        <i class="bi bi-trash"></i> Delete Record
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="mb-3">
    <a href="{{ route('admin.purchases.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back to Purchases
    </a>
</div>

<!-- Status Update Form (Hidden) -->
<form id="statusUpdateForm" method="POST" action="{{ route('admin.purchases.update-status', $purchase) }}" style="display: none;">
    @csrf
    @method('PATCH')
    <input type="hidden" name="payment_status" id="statusInput">
</form>
@endsection

@section('scripts')
<script>
function updateStatus(status) {
    if (confirm('Are you sure you want to update this purchase status to ' + status + '?')) {
        document.getElementById('statusInput').value = status;
        document.getElementById('statusUpdateForm').submit();
    }
}
</script>
@endsection