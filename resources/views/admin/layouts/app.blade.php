<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize all dropdowns
        document.addEventListener('DOMContentLoaded', function() {
            var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
            var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl);
            });
        });
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name', 'Magazine Store') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .sidebar {
            background: linear-gradient(145deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            border-radius: 10px;
            margin: 2px 0;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white;
            transform: translateX(5px);
        }
        .main-content {
            background: #f8f9fa;
            min-height: 100vh;
        }
        .navbar {
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
        .navbar .dropdown-menu.show {
            display: block !important;
            opacity: 1 !important;
            visibility: visible !important;
        }
        .navbar .dropdown-toggle::after {
            margin-left: 0.5em;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .stats-card {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
        }
        .stats-card.sales {
            background: linear-gradient(45deg, #f093fb, #f5576c);
        }
        .stats-card.users {
            background: linear-gradient(45deg, #4facfe, #00f2fe);
        }
        .stats-card.magazines {
            background: linear-gradient(45deg, #43e97b, #38f9d7);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">
                            <i class="bi bi-journal-bookmark"></i>
                            Magazine Admin
                        </h4>
                    </div>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-speedometer2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                                <i class="bi bi-tags"></i>
                                Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.magazines.*') ? 'active' : '' }}" href="{{ route('admin.magazines.index') }}">
                                <i class="bi bi-journal-text"></i>
                                Magazines
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.purchases.*') ? 'active' : '' }}" href="{{ route('admin.purchases.index') }}">
                                <i class="bi bi-cart-check"></i>
                                Purchases
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                                <i class="bi bi-people"></i>
                                Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}" href="{{ route('admin.banners.index') }}">
                                <i class="bi bi-images"></i>
                                Banner Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.options.*') ? 'active' : '' }}" href="{{ route('admin.options.index') }}">
                                <i class="bi bi-gear"></i>
                                Options Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}" href="{{ route('admin.pages.index') }}">
                                <i class="bi bi-file-earmark-text"></i>
                                Pages
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <hr class="text-white">
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}" target="_blank">
                                <i class="bi bi-house"></i>
                                View Site
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <!-- Top Header Bar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom mb-3">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <h1 class="h2 mb-0">@yield('page-title', 'Dashboard')</h1>
                            
                            <!-- User Dropdown -->
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle me-2"></i>{{ Auth::user()->name }}
                                    <span class="badge bg-warning ms-2">Admin</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                                    <li><h6 class="dropdown-header">Admin Panel</h6></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.categories.index') }}"><i class="bi bi-tags me-2"></i>Categories</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.magazines.index') }}"><i class="bi bi-journal-text me-2"></i>Magazines</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.purchases.index') }}"><i class="bi bi-cart-check me-2"></i>Purchases</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.users.index') }}"><i class="bi bi-people me-2"></i>Users</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.options.index') }}"><i class="bi bi-gear me-2"></i>Options</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.pages.index') }}"><i class="bi bi-file-earmark-text me-2"></i>Pages</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('home') }}" target="_blank"><i class="bi bi-house me-2"></i>View Website</a></li>
                                    <li><a class="dropdown-item" href="{{ route('user.dashboard') }}"><i class="bi bi-person me-2"></i>User Dashboard</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="#" onclick="confirmAdminLogout(event)">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </a>
                                        <form id="admin-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>

                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
                    <div></div>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        @yield('page-actions')
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Initialize dropdowns when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Admin page loaded - Initializing dropdowns...');

            // Let Bootstrap handle dropdown initialization automatically
            // Bootstrap 5 automatically initializes dropdowns with data-bs-toggle="dropdown"
            console.log('Bootstrap dropdowns should initialize automatically');

            // Add manual click handler as fallback for admin dropdown
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            dropdownToggles.forEach(function(toggle) {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Admin dropdown toggle clicked:', this.id);
                    
                    // Find the dropdown menu
                    const dropdownMenu = this.nextElementSibling;
                    if (dropdownMenu && dropdownMenu.classList.contains('dropdown-menu')) {
                        // Toggle the show class
                        dropdownMenu.classList.toggle('show');
                        this.setAttribute('aria-expanded', dropdownMenu.classList.contains('show'));
                        console.log('Manually toggled admin dropdown:', this.id, dropdownMenu.classList.contains('show'));
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

        // Admin logout confirmation
        function confirmAdminLogout(event) {
            event.preventDefault();
            
            // Create a custom modal for better UX
            const modal = document.createElement('div');
            modal.className = 'modal fade';
            modal.id = 'adminLogoutModal';
            modal.innerHTML = `
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title">
                                <i class="bi bi-shield-exclamation text-warning me-2"></i>
                                Admin Logout
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center">
                            <p class="mb-0">Are you sure you want to logout from the admin panel?</p>
                            <small class="text-muted">You will be redirected to the homepage.</small>
                        </div>
                        <div class="modal-footer border-0 justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-warning" onclick="performAdminLogout()">
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
        
        function performAdminLogout() {
            document.getElementById('admin-logout-form').submit();
        }
    </script>
    
    @yield('scripts')
</body>
</html>