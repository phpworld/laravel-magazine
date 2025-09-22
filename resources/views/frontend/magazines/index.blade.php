@extends('frontend.layouts.app')

@section('title', 'All Magazines - MagStore')
@section('description', 'Browse our complete collection of premium digital magazines across all categories.')

@section('content')
<!-- Page Header -->
<section class="py-4 mt-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8" data-aos="fade-right">
                <h1 class="h2 fw-bold text-white mb-2">All Magazines</h1>
                <p class="text-white-50">Discover our complete collection of premium digital magazines</p>
                
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Magazines</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-4 text-center" data-aos="fade-left">
                <div class="text-white">
                    <h3 class="fw-bold">{{ $magazines->total() }}</h3>
                    <small>Total Magazines Available</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filters & Search -->
<section class="py-3 bg-light border-bottom">
    <div class="container">
        <form method="GET" action="{{ route('magazines.index') }}" class="row g-3 align-items-center">
            <!-- Search -->
            <div class="col-lg-4 col-md-6">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control" 
                           placeholder="Search magazines..." 
                           value="{{ request('search') }}">
                </div>
            </div>
            
            <!-- Category Filter -->
            <div class="col-lg-3 col-md-6">
                <select name="category" class="form-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }} ({{ $category->magazines_count }})
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- Sort -->
            <div class="col-lg-3 col-md-6">
                <select name="sort" class="form-select">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest First</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Title A-Z</option>
                </select>
            </div>
            
            <!-- Filter Button -->
            <div class="col-lg-2 col-md-6">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-funnel me-1"></i>Filter
                </button>
            </div>
        </form>
    </div>
</section>

<!-- Featured Magazines (if no filters applied) -->
@if(!request()->hasAny(['search', 'category', 'sort']) && $featuredMagazines->count() > 0)
<section class="py-3">
    <div class="container">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h3 class="h5 fw-bold mb-0">Featured This Week</h3>
                <p class="text-muted mb-0 small">Our top picks for this week</p>
            </div>
            <div class="col-auto">
                <button class="btn btn-outline-secondary btn-sm me-2" type="button" data-bs-target="#featuredCarousel" data-bs-slide="prev">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-target="#featuredCarousel" data-bs-slide="next">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>
        
        <div id="featuredCarousel" class="carousel slide multi-item-carousel" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                @php
                    $totalMagazines = $featuredMagazines->count();
                @endphp
                @for($i = 0; $i < $totalMagazines; $i++)
                    <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                        <div class="row g-3">
                            @for($j = 0; $j < 3; $j++)
                                @php
                                    $magazineIndex = ($i + $j) % $totalMagazines;
                                    $magazine = $featuredMagazines[$magazineIndex];
                                @endphp
                                <div class="col-lg-4">
                                    <div class="magazine-card-rectangular">
                                        <div class="d-flex">
                                            <div class="magazine-image-container position-relative">
                                                @if($magazine->cover_image)
                                                    <img src="{{ asset('storage/' . $magazine->cover_image) }}" 
                                                         alt="{{ $magazine->title }}" 
                                                         class="magazine-cover-rect">
                                                @else
                                                    <div class="magazine-cover-rect bg-light d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-journal-text" style="font-size: 1.2rem; color: #ddd;"></i>
                                                    </div>
                                                @endif
                                                <div class="badge bg-warning text-dark position-absolute top-0 start-0 m-1 small">
                                                    <i class="bi bi-star-fill"></i>
                                                </div>
                                                <div class="badge bg-light text-primary position-absolute top-0 end-0 m-1 small">{{ $magazine->category->name }}</div>
                                            </div>
                                            
                                            <div class="magazine-content-rect flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-start mb-1">
                                                    <small class="text-muted">{{ $magazine->publication_date->format('M d, Y') }}</small>
                                                    <span class="fw-bold text-primary">₹{{ number_format($magazine->price) }}</span>
                                                </div>
                                                
                                                <h6 class="fw-bold mb-1">{{ Str::limit($magazine->title, 35) }}</h6>
                                                <p class="text-muted mb-2 small">{{ Str::limit($magazine->description, 50) }}</p>
                                                
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('magazines.show', $magazine) }}" class="btn btn-outline-primary btn-sm flex-fill">
                                                        View Details
                                                    </a>
                                                    @auth
                                                        @if(!auth()->user()->hasPurchased($magazine))
                                                            <a href="{{ route('magazines.show', $magazine) }}" class="btn btn-primary btn-sm">
                                                                <i class="bi bi-cart-plus"></i>
                                                            </a>
                                                        @else
                                                            <span class="btn btn-success btn-sm" title="Already Purchased">
                                                                <i class="bi bi-check-circle"></i>
                                                            </span>
                                                        @endif
                                                    @else
                                                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm" title="Login to Purchase">
                                                            <i class="bi bi-cart-plus"></i>
                                                        </a>
                                                    @endauth
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</section>
@endif

<!-- All Magazines -->
<section class="py-3">
    <div class="container">
        <!-- Results Info -->
        <div class="row align-items-center mb-3">
            <div class="col-md-6">
                <h4 class="h5 fw-bold mb-0">
                    @if(request('search'))
                        Search Results for "{{ request('search') }}"
                    @elseif(request('category'))
                        {{ $categories->where('id', request('category'))->first()->name ?? 'Category' }} Magazines
                    @else
                        All Magazines
                    @endif
                </h4>
                <p class="text-muted mb-0 small">
                    Showing {{ $magazines->firstItem() ?? 0 }}-{{ $magazines->lastItem() ?? 0 }} 
                    of {{ $magazines->total() }} results
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                @if(request()->hasAny(['search', 'category', 'sort']))
                    <a href="{{ route('magazines.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-x-circle me-1"></i>Clear Filters
                    </a>
                @endif
            </div>
        </div>

        @if($magazines->count() > 0)
            <!-- Magazines Grid -->
            <div class="row g-3">
                @foreach($magazines as $magazine)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
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
                                    
                                    <!-- Badges -->
                                    <div class="badge bg-light text-primary position-absolute top-0 start-0 m-2 small">{{ $magazine->category->name }}</div>
                                    <div class="badge bg-primary position-absolute top-0 end-0 m-2 small">Week {{ $magazine->week_number }}</div>
                                </div>
                                
                                <div class="magazine-content-rect flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        <small class="text-muted">{{ $magazine->publication_date->format('M d, Y') }}</small>
                                        <span class="fw-bold text-primary">₹{{ number_format($magazine->price) }}</span>
                                    </div>
                                    
                                    <h6 class="fw-bold mb-1">{{ Str::limit($magazine->title, 35) }}</h6>
                                    <p class="text-muted mb-2 small">{{ Str::limit($magazine->description, 50) }}</p>
                                    
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('magazines.show', $magazine) }}" class="btn btn-outline-primary btn-sm flex-fill">
                                            View Details
                                        </a>
                                        @auth
                                            @if(!auth()->user()->hasPurchased($magazine))
                                                <a href="{{ route('magazines.show', $magazine) }}" class="btn btn-primary btn-sm">
                                                    <i class="bi bi-cart-plus"></i>
                                                </a>
                                            @else
                                                <span class="btn btn-success btn-sm" title="Already Purchased">
                                                    <i class="bi bi-check-circle"></i>
                                                </span>
                                            @endif
                                        @else
                                            <a href="{{ route('login') }}" class="btn btn-primary btn-sm" title="Login to Purchase">
                                                <i class="bi bi-cart-plus"></i>
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        {{ $magazines->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        @else
            <!-- No Results -->
            <div class="text-center py-4" data-aos="fade-up">
                <i class="bi bi-search" style="font-size: 3rem; color: #ddd;"></i>
                <h4 class="mt-3 text-muted h5">No magazines found</h4>
                <p class="text-muted">
                    @if(request('search'))
                        No results found for "{{ request('search') }}". Try different keywords.
                    @else
                        No magazines available in this category yet.
                    @endif
                </p>
                <div class="mt-4">
                    <a href="{{ route('magazines.index') }}" class="btn btn-primary me-2">
                        <i class="bi bi-arrow-left me-1"></i>Browse All
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-outline-primary">
                        <i class="bi bi-house me-1"></i>Go Home
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

@push('styles')
<style>
.hover-overlay {
    transition: opacity 0.3s ease;
}

.magazine-card:hover .hover-overlay {
    opacity: 1 !important;
}

.btn-white {
    background: white;
    color: #333;
    border: none;
}

.btn-white:hover {
    background: #f8f9fa;
    color: #333;
}

.transition-opacity {
    transition: opacity 0.3s ease;
}
</style>
@endpush