<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'IndoApril')</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}"> 

    <!-- bootstrap icon (sementara CDN, nanti bisa lo ganti offline) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            display: flex;
            margin: 0;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #fff;
            border-right: 1px solid #e5e7eb;
            padding: 1.5rem 1rem;
        }

        .sidebar-brand {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .nav-item a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 15px;
            color: #555;
            text-decoration: none;
        }

        .nav-item a:hover {
            background: #f3f4f6;
        }

        .nav-item a.active {
            background: #3b9ede;
            color: #fff;
        }

        /* CONTENT WRAPPER */
        .content-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* NAVBAR */
        .navbar-custom {
            height: 60px;
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        .navbar-title {
            font-weight: 600;
        }

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
            padding: 20px;
            background: #f9fafb;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-brand">IndoKasir</div>

        <ul class="nav flex-column gap-1">
            <li class="nav-item">
                <a href="{{ route('dashboard.index') }}" class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                    <i class="bi bi-grid-fill"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('product.index') }}" class="{{ request()->routeIs('product.index') ? 'active' : '' }}">
                    <i class="bi bi-shop"></i> Produk
                </a>
            </li>

            <li class="nav-item">
                <a href="#">
                    <i class="bi bi-cart3"></i> Transaksi
                </a>
            </li>

            @if(auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="{{ request()->routeIs('user.*') ? 'active' : '' }}">
                        <i class="bi bi-person-circle"></i> User
                    </a>
                </li>
            @endif
        </ul>
    </div>

    <!-- CONTENT WRAPPER -->
    <div class="content-wrapper">

        <!-- NAVBAR -->
        <div class="navbar-custom">
            <div class="navbar-title">
                Dashboard
            </div>

            <div class="d-flex align-items-center gap-3">
                <span>{{ auth()->user()->name }}</span>

                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-sm btn-danger">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="main-content">
            @yield('content')
        </div>

    </div>

    <!-- script -->
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>