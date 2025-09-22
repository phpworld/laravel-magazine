@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Stats Cards -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card magazines">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Magazines</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $stats['total_magazines'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-journal-text fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Categories</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $stats['total_categories'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-tags fa-2x"></i>
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
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Users</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $stats['total_users'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-people fa-2x"></i>
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
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Sales</div>
                        <div class="h5 mb-0 font-weight-bold">₹{{ number_format($stats['total_sales'], 2) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-currency-rupee fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Weekly Sales Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Weekly Sales Overview</h6>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i>
                    This week's sales: <strong>₹{{ number_format($stats['weekly_sales'], 2) }}</strong>
                </div>
                <div class="text-center">
                    <i class="bi bi-bar-chart-line" style="font-size: 3rem; color: #ddd;"></i>
                    <p class="text-muted mt-2">Sales chart will be implemented here</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.magazines.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Add New Magazine
                    </a>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Add New Category
                    </a>
                    <a href="{{ route('admin.magazines.index') }}" class="btn btn-info">
                        <i class="bi bi-journal-text"></i> Manage Magazines
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-warning">
                        <i class="bi bi-tags"></i> Manage Categories
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Purchases -->
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Recent Purchases</h6>
            </div>
            <div class="card-body">
                @if($recent_purchases->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Magazine</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent_purchases as $purchase)
                                    <tr>
                                        <td>{{ $purchase->user->name }}</td>
                                        <td>{{ $purchase->magazine->title }}</td>
                                        <td>₹{{ number_format($purchase->amount, 2) }}</td>
                                        <td>{{ $purchase->created_at->format('M d, Y H:i') }}</td>
                                        <td>
                                            <span class="badge bg-success">{{ ucfirst($purchase->payment_status) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-cart-x" style="font-size: 3rem;"></i>
                        <p class="mt-2">No purchases yet</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection