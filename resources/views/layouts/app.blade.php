<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Conference Management System')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">

    @stack('styles')

    <style>
        body {
            background: linear-gradient(135deg, #8e9aaf 0%, #cbc0d3 100%);
            min-height: 100vh;
            font-family: 'Figtree', sans-serif;
        }

        .navbar {
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand, .nav-link {
            color: white !important;
        }

        .navbar .user-info {
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            margin-right: 10px;
        }

        .navbar .btn-logout {
            background: rgba(220, 53, 69, 0.8);
            border: 1px solid rgba(220, 53, 69, 0.5);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .navbar .btn-logout:disabled {
            background: rgba(108, 117, 125, 0.5);
            border-color: rgba(108, 117, 125, 0.3);
            color: rgba(255, 255, 255, 0.5);
            cursor: not-allowed;
        }

        .navbar .btn-logout:not(:disabled):hover {
            background: rgba(220, 53, 69, 1);
            border-color: rgba(220, 53, 69, 0.8);
            transform: translateY(-1px);
        }

        .card {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }

        .card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }

        h1 {
            color: white;
            text-align: center;
            font-weight: 700;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark @yield('navbar-class', 'bg-primary')">
    <div class="container">
        <a class="navbar-brand" href="@yield('navbar-brand-url', '/')">
            @yield('navbar-brand', 'Conference Management System')
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                @yield('navbar-links')
            </ul>

            <div class="navbar-nav ms-auto d-flex align-items-center">
                <div class="user-info text-white me-3">
                    <i class="fas fa-user me-1"></i>
                    <span>{{ $userName ?? 'Arnas Nagys' }}</span>
                </div>

                @if(isset($showTime) && $showTime)
                    <div id="time-output" class="text-white me-3 user-info"></div>
                @endif

                <button class="btn btn-logout" disabled title="Autentifikacija dar nėra sukurta">
                    <i class="fas fa-sign-out-alt me-1"></i>
                    Atsijungti
                </button>

                @yield('navbar-extra')
            </div>
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>

@if(isset($showTime) && $showTime)
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const output = document.getElementById('time-output');
            if (output) {
                function updateTime() {
                    const now = new Date();
                    const options = {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit'
                    };
                    output.textContent = now.toLocaleDateString('lt-LT', options);
                }

                updateTime();
                setInterval(updateTime, 1000);
            }
        });
    </script>
@endif

@stack('scripts')
</body>
</html>
