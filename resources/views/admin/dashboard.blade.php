<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6fb;
            font-family: 'Segoe UI', sans-serif;
        }

        /* NAVBAR */
        .navbar {
            background: linear-gradient(135deg, #1f2937, #111827);
        }

        /* TITLE */
        .dashboard-title {
            font-weight: 800;
            color: #111827;
        }

        .subtitle {
            color: #6b7280;
        }

        /* KPI CARD */
        .kpi-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
            transition: 0.2s;
        }

        .kpi-card:hover {
            transform: translateY(-3px);
        }

        .kpi-icon {
            font-size: 26px;
            padding: 12px;
            border-radius: 12px;
            display: inline-block;
        }

        .kpi-value {
            font-size: 22px;
            font-weight: 800;
            color: #111827;
        }

        .kpi-label {
            color: #6b7280;
            font-size: 13px;
        }

        /* MENU CARD */
        .menu-card {
            border: none;
            border-radius: 16px;
            transition: all 0.25s ease;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.12);
        }

        .menu-icon {
            font-size: 28px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold">
            <i class="bi bi-shield-lock me-2"></i>Admin Panel
        </a>

        <form method="POST" action="{{ route('logout') }}" class="d-inline ms-auto">
            @csrf
            <button type="submit" class="btn btn-outline-light btn-sm">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
            </button>
        </form>
    </div>
</nav>

<div class="container py-5">

    <!-- TITLE -->
    <div class="mb-4">
        <h2 class="dashboard-title">Dashboard</h2>
        <p class="subtitle">Ringkasan sistem & aktivitas terbaru</p>
    </div>

    <!-- KPI SECTION -->
    <div class="row g-4 mb-4">

        <!-- USERS -->
        <div class="col-md-3">
            <div class="card kpi-card p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="kpi-icon bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <div class="kpi-value">{{ $totalUsers ?? 0 }}</div>
                        <div class="kpi-label">Total Users</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PRODUCTS -->
        <div class="col-md-3">
            <div class="card kpi-card p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="kpi-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <div>
                        <div class="kpi-value">{{ $totalProducts ?? 0 }}</div>
                        <div class="kpi-label">Products</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ORDERS -->
        <div class="col-md-3">
            <div class="card kpi-card p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="kpi-icon bg-info bg-opacity-10 text-info">
                        <i class="bi bi-receipt-cutoff"></i>
                    </div>
                    <div>
                        <div class="kpi-value">{{ $totalOrders ?? 0 }}</div>
                        <div class="kpi-label">Orders</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- REVENUE -->
        <div class="col-md-3">
            <div class="card kpi-card p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="kpi-icon bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                    <div>
                        <div class="kpi-value">{{ $totalRevenue ?? 'Rp 0' }}</div>
                        <div class="kpi-label">Revenue</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- QUICK MENU -->
    <div class="row g-4">

        <div class="col-md-4">
            <a href="{{ route('admin.users') }}" class="text-decoration-none">
                <div class="card menu-card text-center p-4">
                    <div class="menu-icon text-primary">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Manage Users</h5>
                    <p class="text-muted small">Kelola semua user sistem</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.products') }}" class="text-decoration-none">
                <div class="card menu-card text-center p-4">
                    <div class="menu-icon text-success">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Products</h5>
                    <p class="text-muted small">Kelola data produk</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.orders') }}" class="text-decoration-none">
                <div class="card menu-card text-center p-4">
                    <div class="menu-icon text-info">
                        <i class="bi bi-receipt-cutoff"></i>
                    </div>
                    <h5 class="fw-bold text-dark">History Orders</h5>
                    <p class="text-muted small">Riwayat transaksi</p>
                </div>
            </a>
        </div>

    </div>

</div>

</body>
</html>