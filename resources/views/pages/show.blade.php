@extends('frontend.layouts.app')

@section('title', $page->meta_title ?: $page->title)
@section('description', $page->meta_description ?: Str::limit(strip_tags($page->content), 155))

@section('meta')
<meta name="keywords" content="{{ $page->title }}">

<!-- Open Graph Meta Tags -->
<meta property="og:title" content="{{ $page->meta_title ?: $page->title }}">
<meta property="og:description" content="{{ $page->meta_description ?: Str::limit(strip_tags($page->content), 155) }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">

<!-- Twitter Card Meta Tags -->
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="{{ $page->meta_title ?: $page->title }}">
<meta name="twitter:description" content="{{ $page->meta_description ?: Str::limit(strip_tags($page->content), 155) }}">

<!-- Canonical URL -->
<link rel="canonical" href="{{ url()->current() }}">
@endsection

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
                </ol>
            </nav>

            <!-- Page Header -->
            <div class="mb-5">
                <h1 class="display-4 fw-bold text-primary mb-3">{{ $page->title }}</h1>
                <div class="text-muted">
                    <small>
                        <i class="fas fa-clock"></i> 
                        Last updated: {{ $page->updated_at->format('F j, Y') }}
                    </small>
                </div>
            </div>

            <!-- Page Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 p-md-5">
                            <div class="page-content">
                                {!! nl2br(e($page->content)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="mt-5">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('home') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left"></i> Back to Home
                        </a>
                    </div>
                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-secondary" onclick="window.print()">
                                <i class="fas fa-print"></i> Print
                            </button>
                            <button type="button" class="btn btn-outline-secondary" onclick="sharePage()">
                                <i class="fas fa-share"></i> Share
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Us specific content -->
@if(Str::contains(strtolower($page->slug), 'contact'))
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-envelope"></i> Send us a Message
                    </h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('styles')
<style>
.page-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #333;
}

.page-content h1,
.page-content h2,
.page-content h3,
.page-content h4,
.page-content h5,
.page-content h6 {
    color: #2c3e50;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.page-content p {
    margin-bottom: 1.5rem;
}

.page-content ul,
.page-content ol {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
}

.page-content li {
    margin-bottom: 0.5rem;
}

.page-content blockquote {
    border-left: 4px solid #007bff;
    padding-left: 1rem;
    margin: 2rem 0;
    font-style: italic;
    background-color: #f8f9fa;
    padding: 1rem;
    border-radius: 0.25rem;
}

@media print {
    .breadcrumb,
    .btn,
    .btn-group {
        display: none !important;
    }
    
    .card {
        border: none !important;
        box-shadow: none !important;
    }
}
</style>
@endpush

@push('scripts')
<script>
function sharePage() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $page->title }}',
            text: '{{ $page->meta_description ?: Str::limit(strip_tags($page->content), 100) }}',
            url: window.location.href
        });
    } else {
        // Fallback for browsers that don't support Web Share API
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(function() {
            alert('Page URL copied to clipboard!');
        }).catch(function() {
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = url;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            alert('Page URL copied to clipboard!');
        });
    }
}
</script>
@endpush