<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'UKKP3') }}</title>
        
        <!-- Font Inter -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        
        <style>
            body { font-family: 'Inter', sans-serif; }
        </style>
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar">
            <div>
                <!-- Ikon Kubus Emas -->
                <a href="{{ route('dashboard') }}" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                    <span style="color: #f8fafc; font-weight: 700; font-size: 1.2rem; letter-spacing: 0.5px;">
                        UKKP3 {{ Auth::user()->isAdmin() ? '(Admin)' : '' }}
                    </span>
                </a>
            </div>
            <div class="navbar-menu">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.users.index') }}">Kelola User</a>
                    <a href="{{ route('admin.pengaduan.index') }}">Kelola Pengaduan</a>
                @else
                    <a href="{{ route('pengaduan.index') }}">Pengaduan Saya</a>
                @endif
            </div>
            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="background:none; border:none; color:#94a3b8; cursor:pointer; font-weight:600; font-family: inherit;">Logout</button>
                </form>
            </div>
        </nav>

        <div class="container">
            @isset($header)
                <header class="header">
                    {{ $header }}
                </header>
            @endisset
            {{ $slot }}
        </div>
    </body>
</html>