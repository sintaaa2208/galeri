<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Palet Warna Pink & Blue Gradient */
        :root {
            --grad-pink: #ff9a9e;
            --grad-blue: #a1c4fd;
            --soft-pink: #fbc2eb;
            --soft-blue: #a6c1ee;
            --text-dark: #4a4a4a;
        }

        body {
            /* Background gradasi lembut untuk seluruh halaman */
            background: linear-gradient(135deg, #fdfcfb 0%, #e2d1c3 0%, #fbc2eb 0%, #a6c1ee 100%) !important;
            background-attachment: fixed !important;
            color: var(--text-dark);
            font-family: 'Poppins', 'Segoe UI', sans-serif;
            min-height: 100vh;
        }

        /* Navbar Customization dengan Gradasi */
        .navbar-pinkblue {
            background: linear-gradient(90deg, #ff758c 0%, #ff7eb3 20%, #7091ff 100%) !important;
            border-bottom: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 800;
            letter-spacing: 0.5px;
            color: #c06ff7 !important;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        /* Button Customization */
        .btn-primary {
            background: linear-gradient(45deg, #ff758c, #7091ff) !important;
            border: none !important;
            transition: transform 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(112, 145, 255, 0.3);
        }

        .btn-danger {
            background-color: #7578fc !important;
            border: none;
        }

        /* Container Content Box */
        .content-wrapper {
            background: rgba(130, 183, 232, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Alert Customization */
        .alert-success {
            background-color: rgba(177, 103, 246, 0.9);
            border-left: 5px solid #5751f3;
        }

        /* Nav Link */
        .nav-link {
            color: rgba(68, 166, 240, 0.9) !important;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #686ceb !important;
            opacity: 1;
        }

        .badge-role {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.4);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-pinkblue shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('products.index') }}">
            🪺💐 Galeri Produk
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                @auth
                    <li class="nav-item">
                        <span class="nav-link text-white me-3">
                            Halo, <strong>{{ Auth::user()->name }}</strong> 
                            <small class="badge badge-role ms-1">{{ Auth::user()->role }}</small>
                        </span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm px-3 rounded-pill">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light btn-sm ms-lg-2 px-4 rounded-pill" href="{{ route('register') }}" style="color: white !important;">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success shadow-sm border-0">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger shadow-sm border-0 text-white" style="background-color: #ff5e62;">{{ session('error') }}</div>
    @endif

    <div class="content-wrapper mb-5">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>