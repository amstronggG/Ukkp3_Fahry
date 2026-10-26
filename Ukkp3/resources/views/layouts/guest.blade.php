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

        <style>
            * { box-sizing: border-box; }
            
            body {
                font-family: 'Inter', sans-serif;
                margin: 0;
                padding: 0;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                /* Background Dark Navy Mewah */
                background: radial-gradient(circle at top left, #1e293b 0%, #0f172a 50%, #020617 100%);
                color: #f8fafc;
                position: relative;
                overflow: hidden;
            }

            /* Efek Pendaran Cahaya di Background */
            body::before {
                content: '';
                position: absolute;
                top: -10%;
                left: -10%;
                width: 40%;
                height: 40%;
                background: rgba(59, 130, 246, 0.15);
                filter: blur(100px);
                border-radius: 50%;
                z-index: 0;
            }
            body::after {
                content: '';
                position: absolute;
                bottom: -10%;
                right: -10%;
                width: 30%;
                height: 30%;
                background: rgba(251, 191, 36, 0.1);
                filter: blur(100px);
                border-radius: 50%;
                z-index: 0;
            }

            /* Ikon Kubus */
            .logo-container {
                margin-bottom: 2rem;
                position: relative;
                z-index: 1;
            }
            .logo-container svg {
                width: 60px;
                height: 60px;
                stroke: #fbbf24;
                fill: none;
                stroke-width: 1.5;
                filter: drop-shadow(0 0 15px rgba(251, 191, 36, 0.5));
            }

            /* Kotak Form Glassmorphism */
            .glass-card {
                width: 100%;
                max-width: 420px;
                background: rgba(30, 41, 59, 0.6);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.08);
                border-top: 1px solid rgba(255, 255, 255, 0.15);
                border-radius: 20px;
                padding: 2.5rem 2.5rem;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6);
                position: relative;
                z-index: 1;
                box-sizing: border-box;
            }

            .footer-text {
                margin-top: 2rem;
                font-size: 0.85rem;
                color: #64748b;
                position: relative;
                z-index: 1;
            }
        </style>
    </head>
    <body>
        <!-- Ikon Kubus 3D -->
        <div class="logo-container">
            <a href="/">
                <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                </svg>
            </a>
        </div>

        <!-- Kotak Form Kaca -->
        <div class="glass-card">
            {{ $slot }}
        </div>
        
        <!-- Footer -->
        <div class="footer-text">
            &copy; {{ date('Y') }} Aplikasi UKKP3. All rights reserved.
        </div>
    </body>
</html>