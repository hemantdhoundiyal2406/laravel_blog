<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'My Blog'))</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg site-navbar sticky-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <span class="navbar-brand-mark"><i class="bi bi-flower1"></i></span>
                <span>
                    <span class="brand-title">My Blog</span>
                    <span class="brand-subtitle">Modern Laravel Blog</span>
                </span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav mx-auto gap-lg-4 pt-3 pt-lg-0">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request('category') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
                        <ul class="dropdown-menu border-0 shadow">
                            @forelse($navCategories as $category)
                                <li><a class="dropdown-item" href="{{ route('blog.index', ['category' => $category->slug]) }}">{{ $category->name }}</a></li>
                            @empty
                                <li><span class="dropdown-item text-muted">No categories yet</span></li>
                            @endforelse
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}" href="{{ route('blog.index') }}">Blog</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a></li>
                </ul>

                <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                    <button class="btn btn-link text-dark fs-5 px-2" type="button" data-bs-toggle="modal" data-bs-target="#searchModal" aria-label="Search">
                        <i class="bi bi-search"></i>
                    </button>
                    <a href="#newsletter" class="btn btn-brand">
                        <i class="bi bi-envelope me-1"></i> Subscribe
                    </a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-dark">Admin</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-dark">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @include('partials.alerts')
        @yield('content')
    </main>

    @include('partials.footer')

    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <form action="{{ route('blog.index') }}" method="GET">
                    <div class="modal-header">
                        <h5 class="modal-title" id="searchModalLabel">Search Articles</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="search" name="search" class="form-control" placeholder="Search by title or keyword" value="{{ request('search') }}">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-brand" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
