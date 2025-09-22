@extends('frontend.layouts.app')

@section('title', 'Premium Digital Magazines - MagStore')
@section('description', 'Discover and purchase premium digital magazines. Weekly publications across Technology, Business, Lifestyle, Sports, and Entertainment.')

@section('content')
@if($banners && $banners->count() > 0)
<!-- Banner Slider Section -->
<section class="banner-slider">
    <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="8000" data-bs-pause="hover">
        <div class="carousel-indicators">
            @foreach($banners as $index => $banner)
                <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="{{ $index }}" 
                        class="{{ $index === 0 ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
        
        <div class="carousel-inner">
            @foreach($banners as $index => $banner)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    @if($banner->image_path && Storage::disk('public')->exists($banner->image_path))
                        <div class="banner-slide" style="background-image: url('{{ $banner->image_url }}');">
                    @else
                        <div class="banner-slide" style="background: var(--primary-gradient);">
                    @endif
                        <div class="banner-overlay"></div>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 text-center" data-aos="fade-up">
                                    <div class="banner-content">
                                        <h1 class="display-2 fw-bold text-white mb-4">
                                            {{ $banner->title }}
                                        </h1>
                                        @if($banner->subtitle)
                                            <h2 class="h3 text-white mb-4">{{ $banner->subtitle }}</h2>
                                        @endif
                                        @if($banner->description)
                                            <p class="lead text-white-50 mb-5 mx-auto" style="max-width: 600px;">
                                                {{ $banner->description }}
                                            </p>
                                        @endif
                                        <div class="d-flex flex-wrap gap-3 justify-content-center mb-4">
                                            @if($banner->button_text && $banner->button_url)
                                                <a href="{{ $banner->button_url }}" 
                                                   class="btn btn-light btn-lg rounded-pill px-5 banner-btn" 
                                                   target="_blank" 
                                                   rel="noopener">
                                                    <i class="bi bi-arrow-right me-2"></i>{{ $banner->button_text }}
                                                </a>
                                            @endif
                                            <a href="{{ route('magazines.index') }}" 
                                               class="btn btn-outline-light btn-lg rounded-pill px-5 banner-btn">
                                                <i class="bi bi-collection me-2"></i>Browse Magazines
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
        
        <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    
    <!-- Quick Stats -->
    <div class="position-absolute bottom-0 start-0 w-100 pb-4" style="z-index: 3;">
        <div class="container">
            <div class="row text-white text-center">
                <div class="col-4">
                    <h3 class="fw-bold mb-1">{{ App\Models\Magazine::where('is_active', true)->count() }}+</h3>
                    <small class="text-white-50">Magazines</small>
                </div>
                <div class="col-4">
                    <h3 class="fw-bold mb-1">{{ App\Models\Category::where('is_active', true)->count() }}+</h3>
                    <small class="text-white-50">Categories</small>
                </div>
                <div class="col-4">
                    <h3 class="fw-bold mb-1">{{ App\Models\User::where('role', 'user')->count() }}+</h3>
                    <small class="text-white-50">Readers</small>
                </div>
            </div>
        </div>
    </div>
</section>
@else
<!-- Default Hero Section (when no banners) -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h1 class="display-3 fw-bold text-white mb-4">
                    Discover Premium
                    <span class="d-block">Digital Magazines</span>
                </h1>
                <p class="lead text-white-50 mb-5">
                    Access the world's best weekly magazines in PDF format. From technology trends to lifestyle insights, find your next great read.
                </p>
                <div class="d-flex flex-wrap gap-3 mb-5">
                    <a href="{{ route('magazines.index') }}" class="btn btn-light btn-lg rounded-pill px-4">
                        <i class="bi bi-collection me-2"></i>Browse Magazines
                    </a>
                    <a href="#features" class="btn btn-outline-light btn-lg rounded-pill px-4">
                        <i class="bi bi-play-circle me-2"></i>Learn More
                    </a>
                </div>
                
                <!-- Quick Stats -->
                <div class="row text-white">
                    <div class="col-4 text-center">
                        <h3 class="fw-bold">{{ App\Models\Magazine::where('is_active', true)->count() }}+</h3>
                        <small class="text-white-50">Magazines</small>
                    </div>
                    <div class="col-4 text-center">
                        <h3 class="fw-bold">{{ App\Models\Category::where('is_active', true)->count() }}+</h3>
                        <small class="text-white-50">Categories</small>
                    </div>
                    <div class="col-4 text-center">
                        <h3 class="fw-bold">{{ App\Models\User::where('role', 'user')->count() }}+</h3>
                        <small class="text-white-50">Readers</small>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 text-center" data-aos="fade-left">
                <div class="floating-animation">
                    <div class="row g-3">
                        @foreach($featuredMagazines->take(6) as $index => $magazine)
                            <div class="col-6 {{ $index % 2 == 0 ? '' : 'mt-5' }}">
                                <div class="magazine-card card-hover">
                                    @if($magazine->cover_image)
                                        <img src="{{ asset('storage/' . $magazine->cover_image) }}" 
                                             alt="{{ $magazine->title }}" 
                                             class="img-fluid rounded-3"
                                             style="height: 200px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded-3 d-flex align-items-center justify-content-center" style="height: 200px;">
                                            <i class="bi bi-journal-text" style="font-size: 3rem; color: #ddd;"></i>
                                        </div>
                                    @endif
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <span class="badge bg-primary">₹{{ number_format($magazine->price) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scroll indicator -->
    <div class="position-absolute bottom-0 start-50 translate-middle-x mb-4">
        <a href="#features" class="text-white text-decoration-none">
            <i class="bi bi-chevron-down fs-3 animate-bounce"></i>
        </a>
    </div>
</section>
@endif

<!-- Categories Section -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <h2 class="h3 fw-bold mb-3">Explore Categories</h2>
                <p class="text-muted">Find magazines that match your interests and expertise</p>
            </div>
        </div>
        
        <div class="row g-3">
            @foreach($categories as $category)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <a href="{{ route('magazines.index', ['category' => $category->id]) }}" class="text-decoration-none">
                        <div class="category-card-compact d-flex align-items-center p-3 border rounded-3 bg-white shadow-sm h-100" style="height: 100px !important; min-height: 100px; max-height: 100px;">
                            <!-- Icon Section (Left) -->
                            <div class="category-icon-compact flex-shrink-0 me-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--bs-primary), var(--bs-info));">
                                @switch($category->name)
                                    @case('Technology')
                                        <i class="bi bi-cpu text-white" style="font-size: 1.5rem;"></i>
                                        @break
                                    @case('Business')
                                        <i class="bi bi-briefcase text-white" style="font-size: 1.5rem;"></i>
                                        @break
                                    @case('Lifestyle')
                                        <i class="bi bi-heart text-white" style="font-size: 1.5rem;"></i>
                                        @break
                                    @case('Sports')
                                        <i class="bi bi-trophy text-white" style="font-size: 1.5rem;"></i>
                                        @break
                                    @case('Entertainment')
                                        <i class="bi bi-camera-reels text-white" style="font-size: 1.5rem;"></i>
                                        @break
                                    @case('Education')
                                        <i class="bi bi-book text-white" style="font-size: 1.5rem;"></i>
                                        @break
                                    @case('Health')
                                        <i class="bi bi-heart-pulse text-white" style="font-size: 1.5rem;"></i>
                                        @break
                                    @case('Science')
                                        <i class="bi bi-lightbulb text-white" style="font-size: 1.5rem;"></i>
                                        @break
                                    @default
                                        <i class="bi bi-journal-text text-white" style="font-size: 1.5rem;"></i>
                                @endswitch
                            </div>
                            
                            <!-- Content Section (Right) -->
                            <div class="category-content-compact flex-grow-1 overflow-hidden">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <h6 class="fw-bold mb-0 text-dark">{{ $category->name }}</h6>
                                    <span class="badge bg-primary bg-gradient small">{{ $category->magazines_count }}</span>
                                </div>
                                <p class="text-muted mb-1 small" style="line-height: 1.3; font-size: 0.8rem;">{{ Str::limit($category->description, 50) }}</p>
                                <span class="text-primary fw-semibold" style="font-size: 0.8rem;">Explore <i class="bi bi-arrow-right ms-1"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        
        <div class="row mt-5">
            <div class="col-12 text-center" data-aos="fade-up">
                <a href="{{ route('magazines.index') }}" class="btn btn-outline-primary btn-lg">
                    <i class="bi bi-grid me-2"></i>View All Categories
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Latest Magazines Section -->
<section class="section-padding">
    <div class="container">
        <div class="row justify-content-between align-items-center mb-4">
            <div class="col-lg-6" data-aos="fade-right">
                <h2 class="h3 fw-bold mb-2">Latest Magazines</h2>
                <p class="text-muted">Discover our newest publications</p>
            </div>
            <div class="col-lg-auto" data-aos="fade-left">
                <a href="{{ route('magazines.index') }}" class="btn btn-outline-primary btn-sm">
                    View All <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
        
        <div class="row g-3">
            @foreach($latestMagazines as $magazine)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="magazine-card-rectangular">
                        <div class="d-flex">
                            <div class="magazine-image-container position-relative">
                                @if($magazine->cover_image)
                                    <img src="{{ asset('storage/' . $magazine->cover_image) }}" 
                                         alt="{{ $magazine->title }}" 
                                         class="magazine-cover-rect">
                                @else
                                    <div class="magazine-cover-rect bg-light d-flex align-items-center justify-content-center">
                                        <i class="bi bi-journal-text" style="font-size: 2rem; color: #ddd;"></i>
                                    </div>
                                @endif
                                <div class="badge bg-primary position-absolute top-0 end-0 m-2">
                                    Week {{ $magazine->week_number }}
                                </div>
                            </div>
                            
                            <div class="magazine-content-rect flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <span class="badge bg-light text-primary small">{{ $magazine->category->name }}</span>
                                    <small class="text-muted">{{ $magazine->publication_date->format('M d') }}</small>
                                </div>
                                
                                <h6 class="fw-bold mb-1">{{ Str::limit($magazine->title, 35) }}</h6>
                                <p class="text-muted mb-2 small">{{ Str::limit($magazine->description, 50) }}</p>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-primary">₹{{ number_format($magazine->price) }}</span>
                                    <a href="{{ route('magazines.show', $magazine) }}" class="btn btn-outline-primary btn-sm">
                                        View
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section section-padding">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <h2 class="display-4 fw-bold">{{ App\Models\Magazine::where('is_active', true)->count() }}+</h2>
                <p class="mb-0">Premium Magazines</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <h2 class="display-4 fw-bold">{{ App\Models\Purchase::where('payment_status', 'completed')->count() }}+</h2>
                <p class="mb-0">Happy Customers</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <h2 class="display-4 fw-bold">{{ App\Models\Category::where('is_active', true)->count() }}+</h2>
                <p class="mb-0">Categories</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                <h2 class="display-4 fw-bold">24/7</h2>
                <p class="mb-0">Support Available</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <h2 class="display-5 fw-bold mb-4">Ready to Start Reading?</h2>
                <p class="lead text-muted mb-5">Join thousands of readers who trust MagStore for their digital magazine needs</p>
                
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="{{ route('magazines.index') }}" class="btn btn-gradient btn-lg">
                        <i class="bi bi-collection me-2"></i>Browse Magazines
                    </a>
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-gradient-secondary btn-lg">
                            <i class="bi bi-person-plus me-2"></i>Create Account
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.animate-bounce {
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    60% {
        transform: translateY(-5px);
    }
}
</style>
@endpush