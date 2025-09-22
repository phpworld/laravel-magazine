@extends('frontend.layouts.app')

@section('title', $magazine->title . ' - MagStore')
@section('description', Str::limit($magazine->description, 160))

@section('content')
<!-- Magazine Hero -->
<section class="py-5 mt-5">
    <div class="container">
        <div class="row">
            <!-- Magazine Cover & Actions -->
            <div class="col-lg-4" data-aos="fade-right">
                <div class="text-center mb-4">
                    @if($magazine->cover_image)
                        <img src="{{ asset('storage/' . $magazine->cover_image) }}" 
                             alt="{{ $magazine->title }}" 
                             class="img-fluid rounded-3 shadow-lg"
                             style="max-height: 500px; width: auto;">
                    @else
                        <div class="bg-light rounded-3 shadow-lg d-flex align-items-center justify-content-center" 
                             style="height: 500px; width: 100%;">
                            <i class="bi bi-journal-text" style="font-size: 6rem; color: #ddd;"></i>
                        </div>
                    @endif
                </div>
                
                <!-- Purchase/Download Section -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <span class="price-tag fs-4">₹{{ number_format($magazine->price) }}</span>
                        </div>
                        
                        @auth
                            @if($userHasPurchased)
                                <div class="alert alert-success mb-3">
                                    <i class="bi bi-check-circle me-2"></i>
                                    You own this magazine
                                </div>
                                <a href="#" onclick="downloadMagazine({{ $magazine->id }})" class="btn btn-success btn-lg w-100 mb-2">
                                    <i class="bi bi-download me-2"></i>Download PDF
                                </a>
                                <small class="text-muted d-block">Downloaded {{ auth()->user()->purchases()->where('magazine_id', $magazine->id)->first()->download_count ?? 0 }} times</small>
                            @else
                                <button class="btn btn-gradient btn-lg w-100 mb-3" onclick="purchaseMagazine({{ $magazine->id }})">
                                    <i class="bi bi-cart-plus me-2"></i>Buy Now
                                </button>
                                <div class="d-grid gap-2">
                                    <small class="text-muted">
                                        <i class="bi bi-shield-check me-1"></i>Secure payment via Razorpay
                                    </small>
                                    <small class="text-muted">
                                        <i class="bi bi-download me-1"></i>Instant PDF download
                                    </small>
                                </div>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-gradient btn-lg w-100 mb-3">
                                <i class="bi bi-person me-2"></i>Login to Purchase
                            </a>
                            <small class="text-muted">
                                Don't have an account? 
                                <a href="{{ route('register') }}" class="text-decoration-none">Sign up</a>
                            </small>
                        @endauth
                    </div>
                </div>
                
                <!-- Magazine Info -->
                <div class="card border-0 shadow-sm mt-3">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">Magazine Details</h6>
                        <ul class="list-unstyled small">
                            <li class="mb-2">
                                <i class="bi bi-tag text-primary me-2"></i>
                                <strong>Category:</strong> {{ $magazine->category->name }}
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-calendar text-primary me-2"></i>
                                <strong>Published:</strong> {{ $magazine->publication_date->format('M d, Y') }}
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-calendar-week text-primary me-2"></i>
                                <strong>Week:</strong> {{ $magazine->week_number }}, {{ $magazine->year }}
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-download text-primary me-2"></i>
                                <strong>Downloads:</strong> {{ number_format($magazine->download_count) }}
                            </li>
                            <li class="mb-0">
                                <i class="bi bi-file-earmark-pdf text-primary me-2"></i>
                                <strong>Format:</strong> PDF
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Magazine Content -->
            <div class="col-lg-8" data-aos="fade-left">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('magazines.index') }}">Magazines</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('magazines.index', ['category' => $magazine->category_id]) }}">{{ $magazine->category->name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $magazine->title }}</li>
                    </ol>
                </nav>
                
                <!-- Magazine Header -->
                <div class="mb-4">
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                        <span class="badge bg-primary">{{ $magazine->category->name }}</span>
                        <span class="badge bg-light text-dark">Week {{ $magazine->week_number }}, {{ $magazine->year }}</span>
                        <span class="badge bg-success">{{ $magazine->publication_date->format('M d, Y') }}</span>
                    </div>
                    
                    <h1 class="display-5 fw-bold mb-3">{{ $magazine->title }}</h1>
                    
                    <div class="d-flex align-items-center text-muted mb-4">
                        <i class="bi bi-calendar me-2"></i>
                        <span>Published {{ $magazine->publication_date->diffForHumans() }}</span>
                        <span class="mx-3">•</span>
                        <i class="bi bi-eye me-2"></i>
                        <span>{{ number_format($magazine->download_count) }} downloads</span>
                    </div>
                </div>
                
                <!-- Magazine Description -->
                <div class="mb-5">
                    <h3 class="fw-bold mb-3">About This Magazine</h3>
                    <div class="fs-5 text-muted lh-lg">
                        {!! nl2br(e($magazine->description)) !!}
                    </div>
                </div>
                
                <!-- Features -->
                <div class="mb-5">
                    <h4 class="fw-bold mb-3">What You'll Get</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-gradient text-white rounded-circle p-2 me-3">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">High-Quality PDF</h6>
                                    <small class="text-muted">Optimized for all devices</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-gradient text-white rounded-circle p-2 me-3">
                                    <i class="bi bi-download"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Instant Download</h6>
                                    <small class="text-muted">Available immediately after purchase</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-info bg-gradient text-white rounded-circle p-2 me-3">
                                    <i class="bi bi-infinity"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Unlimited Access</h6>
                                    <small class="text-muted">Download anytime from your account</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-warning bg-gradient text-white rounded-circle p-2 me-3">
                                    <i class="bi bi-devices"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Multi-Device</h6>
                                    <small class="text-muted">Read on phone, tablet, or computer</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Magazines -->
@if($relatedMagazines->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <h3 class="fw-bold">More from {{ $magazine->category->name }}</h3>
                <p class="text-muted">Other magazines you might like</p>
            </div>
        </div>
        
        <div class="row g-4">
            @foreach($relatedMagazines as $related)
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="magazine-card card-hover h-100">
                        <div class="position-relative">
                            @if($related->cover_image)
                                <img src="{{ asset('storage/' . $related->cover_image) }}" 
                                     alt="{{ $related->title }}" 
                                     class="card-img-top"
                                     style="height: 250px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                                    <i class="bi bi-journal-text" style="font-size: 3rem; color: #ddd;"></i>
                                </div>
                            @endif
                            <div class="badge bg-primary position-absolute top-0 end-0 m-2">
                                ₹{{ number_format($related->price) }}
                            </div>
                        </div>
                        
                        <div class="card-body p-3">
                            <h6 class="card-title fw-bold mb-2">{{ Str::limit($related->title, 40) }}</h6>
                            <p class="card-text text-muted small">{{ Str::limit($related->description, 80) }}</p>
                            
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <small class="text-muted">Week {{ $related->week_number }}</small>
                                <a href="{{ route('magazines.show', $related) }}" class="btn btn-sm btn-outline-primary">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection

@push('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
function purchaseMagazine(magazineId) {
    // Show loading state
    const purchaseBtn = event.target;
    const originalText = purchaseBtn.innerHTML;
    purchaseBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Processing...';
    purchaseBtn.disabled = true;

    // Create order
    fetch('{{ route("payment.create-order") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            magazine_id: magazineId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Initialize Razorpay checkout
            const options = {
                key: '{{ config("services.razorpay.key") }}',
                amount: data.amount,
                currency: data.currency,
                order_id: data.order_id,
                name: 'MagStore',
                description: data.magazine.title,
                image: '{{ asset("images/logo.png") }}',
                prefill: {
                    name: data.user.name,
                    email: data.user.email,
                    contact: data.user.contact
                },
                notes: {
                    magazine_id: data.magazine.id
                },
                theme: {
                    color: '#667eea'
                },
                handler: function(response) {
                    // Payment successful, verify payment
                    verifyPayment(response, magazineId);
                },
                modal: {
                    ondismiss: function() {
                        // Reset button state if payment cancelled
                        purchaseBtn.innerHTML = originalText;
                        purchaseBtn.disabled = false;
                    }
                }
            };

            const rzp = new Razorpay(options);
            rzp.open();
        } else {
            alert(data.message);
            purchaseBtn.innerHTML = originalText;
            purchaseBtn.disabled = false;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Something went wrong. Please try again.');
        purchaseBtn.innerHTML = originalText;
        purchaseBtn.disabled = false;
    });
}

function verifyPayment(paymentResponse, magazineId) {
    fetch('{{ route("payment.verify") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            razorpay_payment_id: paymentResponse.razorpay_payment_id,
            razorpay_order_id: paymentResponse.razorpay_order_id,
            razorpay_signature: paymentResponse.razorpay_signature,
            magazine_id: magazineId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message
            showSuccessAlert(data.message);
            // Reload page to show download button
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Payment verification failed. Please contact support.');
    });
}

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

function showSuccessAlert(message) {
    const alertHTML = `
        <div class="alert alert-success alert-dismissible fade show position-fixed" 
             style="top: 100px; right: 20px; z-index: 9999; min-width: 300px;" role="alert">
            <i class="bi bi-check-circle me-2"></i>${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    document.body.insertAdjacentHTML('beforeend', alertHTML);
}
</script>
@endpush