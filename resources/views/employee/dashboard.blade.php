<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6fb;
            font-family: 'Segoe UI', sans-serif;
        }

        .navbar {
            background: linear-gradient(135deg, #1f2937, #111827);
        }

        .dashboard-title {
            font-weight: 800;
            color: #111827;
        }

        .subtitle {
            color: #6b7280;
        }

        /* KPI */
        .kpi-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        }

        .kpi-icon {
            font-size: 24px;
            padding: 12px;
            border-radius: 12px;
        }

        .kpi-value {
            font-size: 22px;
            font-weight: 800;
            color: #111827;
        }

        .kpi-label {
            font-size: 13px;
            color: #6b7280;
        }

        /* MENU */
        .menu-card {
            border: none;
            border-radius: 16px;
            transition: 0.25s;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.12);
        }

        .menu-icon {
            font-size: 30px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold">
            <i class="bi bi-person-badge me-2"></i>Employee Panel
        </a>

        <form method="POST" action="{{ route('logout') }}" class="ms-auto">
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
        <p class="subtitle">Kasir panel untuk transaksi & operasional</p>
    </div>

    <!-- KPI SECTION -->
    <div class="row g-4 mb-4">

        <!-- TODAY SALES -->
        <div class="col-md-4">
            <div class="card kpi-card p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="kpi-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                    <div>
                        <div class="kpi-value">{{ $todaySales ?? 'Rp 0' }}</div>
                        <div class="kpi-label">Today Sales</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TRANSACTIONS -->
        <div class="col-md-4">
            <div class="card kpi-card p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="kpi-icon bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-receipt"></i>
                    </div>
                    <div>
                        <div class="kpi-value">{{ $todayTransactions ?? 0 }}</div>
                        <div class="kpi-label">Transactions Today</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PRODUCTS -->
        <div class="col-md-4">
            <div class="card kpi-card p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="kpi-icon bg-info bg-opacity-10 text-info">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <div>
                        <div class="kpi-value">{{ $totalProducts ?? 0 }}</div>
                        <div class="kpi-label">Available Products</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- MENU -->
    <div class="row g-4">

        <div class="col-md-4">
            <a href="{{ route('employee.products') }}" class="text-decoration-none">
                <div class="card menu-card text-center p-4">
                    <div class="menu-icon text-primary">
                        <i class="bi bi-basket-fill"></i>
                    </div>
                    <h5 class="fw-bold text-dark">List Products</h5>
                    <p class="text-muted small">Lihat daftar produk</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('employee.transactions.create') }}" class="text-decoration-none">
                <div class="card menu-card text-center p-4">
                    <div class="menu-icon text-success">
                        <i class="bi bi-cart-plus-fill"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Create Transaction</h5>
                    <p class="text-muted small">Buat transaksi baru</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('employee.orders') }}" class="text-decoration-none">
                <div class="card menu-card text-center p-4">
                    <div class="menu-icon text-info">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Transaction History</h5>
                    <p class="text-muted small">Riwayat transaksi</p>
                </div>
            </a>
        </div>

    </div>

</div>

</body>
</html>