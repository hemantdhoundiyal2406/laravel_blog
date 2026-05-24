<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name', 'My Blog') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="admin-shell d-flex flex-column flex-lg-row">
        <aside class="admin-sidebar p-3 p-lg-4">
            <a class="d-flex align-items-center gap-2 text-white mb-4" href="{{ route('dashboard') }}">
                <span class="fs-3 text-danger"><i class="bi bi-flower1"></i></span>
                <span>
                    <span class="brand-title text-white">My Blog</span>
                    <span class="brand-subtitle text-white-50">Admin Panel</span>
                </span>
            </a>

            <nav class="nav flex-column">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
                <a class="nav-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}"><i class="bi bi-journal-text me-2"></i> Blogs</a>
                <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}"><i class="bi bi-grid me-2"></i> Categories</a>
                <a class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}"><i class="bi bi-inbox me-2"></i> Messages</a>
                <a class="nav-link {{ request()->routeIs('admin.subscribers.*') ? 'active' : '' }}" href="{{ route('admin.subscribers.index') }}"><i class="bi bi-envelope-paper me-2"></i> Subscribers</a>
                <a class="nav-link" href="{{ route('home') }}" target="_blank"><i class="bi bi-box-arrow-up-right me-2"></i> View Site</a>
            </nav>
        </aside>

        <div class="admin-main flex-grow-1">
            <header class="admin-topbar py-3 px-3 px-lg-4 d-flex align-items-center justify-content-between gap-3">
                <div>
                    <p class="text-muted-soft small mb-0">Logged in as</p>
                    <strong>{{ auth()->user()->name }}</strong>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-danger" type="submit"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
                </form>
            </header>

            <main class="p-3 p-lg-4">
                @include('partials.alerts')
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
