<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Laravel Blog')</title>
    
    <!-- Meta tags for SEO -->
    @stack('meta')
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">
                <a href="{{ route('posts.index') }}" class="nav-link">
                    <h1>Laravel Blog</h1>
                </a>
            </div>
            
            <div class="nav-menu">
                <a href="{{ route('posts.index') }}" class="nav-link {{ request()->routeIs('posts.index') ? 'active' : '' }}">
                    All Posts
                </a>
                <a href="{{ route('posts.create') }}" class="nav-link {{ request()->routeIs('posts.create') ? 'active' : '' }}">
                    New Post
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Flash Messages -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    <ul class="error-list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Laravel Blog. Built with Laravel {{ app()->version() }}.</p>
        </div>
    </footer>

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>