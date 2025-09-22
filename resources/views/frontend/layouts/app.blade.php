<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Premium Magazine Store')</title>
    <meta name="description" content="@yield('description', 'Discover and purchase premium digital magazines online')">

    <!-- Favicon -->
    @php
        $favicon = \App\Models\Option::where('key', 'favicon')->first()?->value;
    @endphp
    @if($favicon && Storage::disk('public')->exists($favicon))
        <link rel="icon" type="image/x-icon" href="{{ Storage::url($favicon) }}">
        <link rel="apple-touch-icon" href="{{ Storage::url($favicon) }}">
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --dark-gradient: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
        }

        .hero-section {
            background: var(--primary-gradient);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .banner-slider {
            position: relative;
            height: 600px;
            overflow: hidden;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        .banner-slide {
            height: 600px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            display: flex;
            align-items: center;
            transition: all 0.8s ease-in-out;
        }

        .banner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.3) 100%);
            z-index: 1;
        }

        .banner-content {
            position: relative;
            z-index: 10;
            text-align: center;
            padding: 40px 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .banner-content .btn {
            position: relative;
            z-index: 11;
            pointer-events: auto;
        }

        .banner-btn {
            position: relative !important;
            z-index: 15 !important;
            pointer-events: auto !important;
            display: inline-block !important;
            text-decoration: none !important;
            padding: 15px 30px;
            margin: 0 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            border: 2px solid transparent;
        }

        .banner-btn:hover {
            transform: translateY(-3px);
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .banner-btn.btn-primary {
            background: linear-gradient(45deg, #007bff, #0056b3) !important;
            border-color: #007bff !important;
            color: white !important;
        }

        .banner-btn.btn-primary:hover {
            background: linear-gradient(45deg, #0056b3, #004085) !important;
            border-color: #004085 !important;
        }

        .banner-btn.btn-outline-light {
            background: rgba(255, 255, 255, 0.1) !important;
            border-color: rgba(255, 255, 255, 0.7) !important;
            backdrop-filter: blur(5px);
            color: white !important;
        }

        .banner-btn.btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.9) !important;
            color: #333 !important;
            border-color: rgba(255, 255, 255, 0.9) !important;
        }

        .banner-content h1 {
            text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 20px;
            line-height: 1.2;
            animation: fadeInUp 1s ease-out;
        }

        .banner-content h2 {
            text-shadow: 1px 1px 4px rgba(0,0,0,0.5);
            font-weight: 600;
            margin-bottom: 25px;
            opacity: 0.95;
            line-height: 1.4;
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        .banner-content p {
            text-shadow: 1px 1px 4px rgba(0,0,0,0.5);
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 35px;
            animation: fadeInUp 1s ease-out 0.4s both;
        }

        .banner-buttons {
            animation: fadeInUp 1s ease-out 0.6s both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .carousel-indicators {
            bottom: 30px;
            margin-bottom: 0;
        }

        .carousel-indicators [data-bs-target] {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.7);
            background-color: transparent;
            margin: 0 8px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .carousel-indicators [data-bs-target]:hover {
            border-color: rgba(255, 255, 255, 0.9);
            transform: scale(1.2);
        }

        .carousel-indicators .active {
            background-color: white;
            border-color: white;
            transform: scale(1.1);
        }

        .carousel-inner {
            height: 600px;
        }

        .carousel-item {
            height: 600px;
            transition: transform 0.8s ease-in-out;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
            color: white;
            z-index: 5;
            opacity: 0.7;
            transition: opacity 0.3s ease;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            opacity: 1;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 50%;
            width: 60px;
            height: 60px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .carousel-control-prev-icon:hover,
        .carousel-control-next-icon:hover {
            background-color: rgba(0, 0, 0, 0.8);
            transform: scale(1.1);
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
            z-index: 3;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 30px;
            height: 30px;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .card-hover {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .magazine-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
        }

        .magazine-card .badge {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 2;
        }

        .price-tag {
            background: var(--secondary-gradient);
            color: white;
            border-radius: 50px;
            padding: 8px 20px;
            font-weight: 600;
            display: inline-block;
        }

        .btn-gradient {
            background: var(--primary-gradient);
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-gradient-secondary {
            background: var(--secondary-gradient);
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-gradient-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(240, 147, 251, 0.4);
            color: white;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            position: relative;
            z-index: 1050;
        }

        .navbar .dropdown-menu {
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            border-radius: 10px;
            z-index: 1060;
            margin-top: 0.5rem;
        }

        .navbar .dropdown-toggle::after {
            margin-left: 0.5em;
        }

        /* Ensure dropdown is visible when shown */
        .navbar .dropdown-menu.show {
            display: block !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: flex !important;
            align-items: center;
        }
        
        .navbar-logo {
            height: 40px;
            max-width: 180px;
            object-fit: contain;
        }

        .section-padding {
            padding: 40px 0;
        }

        .category-card {
            background: white;
            border-radius: 15px;
            padding: 25px 20px;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            position: relative;
            overflow: hidden;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .category-card:hover::before {
            transform: scaleX(1);
        }

        .category-card:hover {
            border-color: #667eea;
            transform: translateY(-8px);
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.15);
        }

        .category-card-compact {
            background: white;
            border-radius: 12px;
            padding: 20px;
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            height: 100px !important;
            min-height: 100px;
            max-height: 100px;
            overflow: hidden;
        }

        .category-card-compact:hover {
            border-color: #667eea;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
        }

        .category-icon-compact {
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .category-card-compact:hover .category-icon-compact {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
        }

        .category-content-compact {
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }

        .category-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 1.8rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            position: relative;
            transition: all 0.3s ease;
        }

        .category-card:hover .category-icon {
            transform: scale(1.1);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.3);
        }

        @media (max-width: 768px) {
            .category-card {
                padding: 20px 15px;
            }
            
            .category-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
        }

        .category-icon-small {
            width: 40px;
            height: 40px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .magazine-card-minimal {
            background: white;
            border-radius: 12px;
            padding: 15px;
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .magazine-card-minimal:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
            border-color: #667eea;
        }

        .magazine-card-rectangular {
            background: white;
            border-radius: 12px;
            padding: 20px;
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            height: 225px;
            position: relative;
            overflow: hidden;
        }

        .magazine-card-rectangular:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(103, 126, 234, 0.15);
            border-color: #667eea;
        }

        .magazine-image-container {
            flex-shrink: 0;
            width: 160px;
            margin-right: 20px;
            position: relative;
        }

        .magazine-cover-rect {
            width: 160px;
            height: 190px;
            object-fit: cover;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .magazine-content-rect {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 190px;
            padding: 5px 0;
            flex-grow: 1;
        }

        .magazine-card-rectangular:hover .magazine-cover-rect {
            transform: scale(1.02);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .magazine-card-rectangular .badge {
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 20px;
        }

        .magazine-card-rectangular .badge.bg-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            border: none;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
        }

        .magazine-card-rectangular .badge.bg-light {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
            color: #495057 !important;
            border: 1px solid #dee2e6;
        }

        .magazine-card-rectangular h6 {
            font-weight: 700;
            color: #2c3e50;
            line-height: 1.4;
            margin-bottom: 8px;
        }

        .magazine-card-rectangular .text-muted {
            color: #6c757d !important;
            line-height: 1.5;
            font-size: 0.875rem;
        }

        .magazine-card-rectangular .fw-bold.text-primary {
            color: #667eea !important;
            font-size: 1.1rem;
            font-weight: 700;
        }

        .magazine-card-rectangular .btn-outline-primary {
            border-color: #667eea;
            color: #667eea;
            font-weight: 600;
            padding: 6px 16px;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .magazine-card-rectangular .btn-outline-primary:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .magazine-cover-small {
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .magazine-content-minimal {
            padding-top: 12px;
        }

        .magazine-card-minimal:hover .magazine-cover-small {
            transform: scale(1.02);
        }

        #featuredCarousel {
            height: 360px;
            overflow: hidden;
        }

        #featuredCarousel .carousel-inner {
            height: 360px;
        }

        #featuredCarousel .carousel-item {
            height: 360px;
        }

        #featuredCarousel .magazine-card-rectangular {
            height: 225px;
        }

        .stats-section {
            background: var(--dark-gradient);
            color: white;
        }

        .footer {
            background: #2c3e50;
            color: white;
            padding: 60px 0 20px;
        }

        .social-links a {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 10px;
            transition: all 0.3s ease;
            color: white;
            text-decoration: none;
        }

        .social-links a:hover {
            background: var(--primary-gradient);
            transform: translateY(-3px);
            color: white;
        }

        @media (max-width: 768px) {
            .hero-section {
                min-height: 80vh;
                text-align: center;
            }
            
            .section-padding {
                padding: 60px 0;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                @if($globalLogo && Storage::disk('public')->exists($globalLogo))
                    <img src="{{ Storage::url($globalLogo) }}" alt="{{ $globalSiteName }}" class="navbar-logo">
                @else
                    @if($globalLogo)
                        <!-- Debug: Logo path exists but file not found: {{ $globalLogo }} -->
                    @endif
                    <i class="bi bi-journal-bookmark me-2"></i>{{ $globalSiteName }}
                @endif
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('magazines.index') }}">Magazines</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                            @foreach(App\Models\Category::where('is_active', true)->get() as $category)
                                <li><a class="dropdown-item" href="{{ route('magazines.index', ['category' => $category->id]) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pages.show', 'about-us') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pages.show', 'contact-us') }}">Contact</a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-gradient ms-2" href="{{ route('register') }}">Sign Up</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-2"></i>{{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('user.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.purchases') }}"><i class="bi bi-cart-check me-2"></i>My Purchases</a></li>
                                @if(Auth::user()->isAdmin())
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-gear me-2"></i>Admin Panel</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="#" onclick="confirmLogout(event)">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show position-fixed" 
             style="top: 80px; right: 20px; z-index: 9999; min-width: 300px;" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show position-fixed" 
             style="top: 80px; right: 20px; z-index: 9999; min-width: 300px;" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="mb-3">
                        <i class="bi bi-journal-bookmark me-2"></i>MagStore
                    </h5>
                    <p class="text-light">Your premium destination for digital magazines. Discover, purchase, and enjoy high-quality content from around the world.</p>
                    <div class="social-links">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6 class="mb-3">Categories</h6>
                    <ul class="list-unstyled">
                        @foreach(App\Models\Category::where('is_active', true)->take(4)->get() as $category)
                            <li><a href="{{ route('magazines.index', ['category' => $category->id]) }}" class="text-light text-decoration-none">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6 class="mb-3">Information</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('pages.show', 'about-us') }}" class="text-light text-decoration-none">About Us</a></li>
                        <li><a href="{{ route('pages.show', 'contact-us') }}" class="text-light text-decoration-none">Contact Us</a></li>
                        <li><a href="{{ route('pages.show', 'privacy-policy') }}" class="text-light text-decoration-none">Privacy Policy</a></li>
                        <li><a href="{{ route('pages.show', 'terms-and-conditions') }}" class="text-light text-decoration-none">Terms & Conditions</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="mb-3">Contact Info</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-envelope-fill me-2"></i>
                            <a href="mailto:{{ \App\Models\Option::getValue('contact_email', 'info@magstore.com') }}" class="text-light text-decoration-none">
                                {{ \App\Models\Option::getValue('contact_email', 'info@magstore.com') }}
                            </a>
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-telephone-fill me-2"></i>
                            <a href="tel:{{ \App\Models\Option::getValue('contact_phone', '+1 (555) 123-4567') }}" class="text-light text-decoration-none">
                                {{ \App\Models\Option::getValue('contact_phone', '+1 (555) 123-4567') }}
                            </a>
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-geo-alt-fill me-2"></i>
                            <span class="text-light">
                                {{ \App\Models\Option::getValue('contact_address', '123 Magazine St, Digital City, DC 12345') }}
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-light">&copy; {{ date('Y') }} MagStore. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0 text-light">Made with <i class="bi bi-heart-fill text-danger"></i> by Your Team</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
            }
        });

        // Fix banner button clicks
        document.addEventListener('DOMContentLoaded', function() {
            // Stop carousel auto-play when hovering over buttons
            const bannerButtons = document.querySelectorAll('.banner-btn');
            const carousel = document.getElementById('bannerCarousel');
            
            if (carousel && bannerButtons.length > 0) {
                const bsCarousel = bootstrap.Carousel.getInstance(carousel) || new bootstrap.Carousel(carousel);
                
                bannerButtons.forEach(button => {
                    button.addEventListener('mouseenter', () => {
                        bsCarousel.pause();
                    });
                    
                    button.addEventListener('mouseleave', () => {
                        bsCarousel.cycle();
                    });
                    
                    // Ensure clicks work
                    button.addEventListener('click', function(e) {
                        e.stopPropagation();
                        console.log('Banner button clicked:', this.href);
                        // Let the default link behavior happen
                    });
                });
            }
        });

        // Logout confirmation
        function confirmLogout(event) {
            event.preventDefault();
            
            // Create a custom modal for better UX
            const modal = document.createElement('div');
            modal.className = 'modal fade';
            modal.id = 'logoutModal';
            modal.innerHTML = `
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title">
                                <i class="bi bi-box-arrow-right text-danger me-2"></i>
                                Confirm Logout
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center">
                            <p class="mb-0">Are you sure you want to logout?</p>
                        </div>
                        <div class="modal-footer border-0 justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" onclick="performLogout()">
                                <i class="bi bi-box-arrow-right me-1"></i>Logout
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
            const bsModal = new bootstrap.Modal(modal);
            bsModal.show();
            
            // Clean up modal after hiding
            modal.addEventListener('hidden.bs.modal', function() {
                document.body.removeChild(modal);
            });
        }
        
        function performLogout() {
            document.getElementById('logout-form').submit();
        }

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    if (bsAlert) {
                        bsAlert.close();
                    }
                }, 5000);
            });

            // Let Bootstrap handle dropdown initialization automatically
            // Bootstrap 5 automatically initializes dropdowns with data-bs-toggle="dropdown"
            console.log('Bootstrap dropdowns should initialize automatically');

            // Add manual click handler as fallback
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            dropdownToggles.forEach(function(toggle) {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Dropdown toggle clicked:', this.id);
                    
                    // Find the dropdown menu
                    const dropdownMenu = this.nextElementSibling;
                    if (dropdownMenu && dropdownMenu.classList.contains('dropdown-menu')) {
                        // Toggle the show class
                        dropdownMenu.classList.toggle('show');
                        this.setAttribute('aria-expanded', dropdownMenu.classList.contains('show'));
                        console.log('Manually toggled dropdown:', this.id, dropdownMenu.classList.contains('show'));
                    }
                });
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown')) {
                    const openDropdowns = document.querySelectorAll('.dropdown-menu.show');
                    openDropdowns.forEach(function(dropdown) {
                        dropdown.classList.remove('show');
                        const toggle = dropdown.previousElementSibling;
                        if (toggle) {
                            toggle.setAttribute('aria-expanded', 'false');
                        }
                    });
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>