<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6fb;
        }

        .navbar {
            background: linear-gradient(135deg, #1f2937, #111827);
        }

        .page-title {
            font-weight: 700;
            color: #1f2937;
        }

        .subtitle {
            color: #6b7280;
        }

        .card-table {
            border: none;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        }

        table thead {
            background: #f9fafb;
        }

        .table td, .table th {
            vertical-align: middle;
        }

        .btn {
            border-radius: 10px;
        }

        .badge-total {
            background: #ecfeff;
            color: #155e75;
            padding: 6px 10px;
            border-radius: 8px;
            font-size: 12px;
        }

        .date-text {
            font-size: 13px;
            color: #6b7280;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">

        <a class="navbar-brand fw-bold" href="#">
            <i class="bi bi-receipt me-2"></i>Admin Panel
        </a>

        <div class="ms-auto d-flex align-items-center gap-2">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm">
                <i class="bi bi-house me-1"></i>Dashboard
            </a>

            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-box-arrow-right me-1"></i>Logout
                </button>
            </form>
        </div>

    </div>
</nav>

<!-- CONTENT -->
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title">Order History</h2>
            <p class="subtitle">Riwayat transaksi semua customer</p>
        </div>

        <a href="{{ route('admin.orders.export') }}" class="btn btn-success">
            <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
        </a>
    </div>

    <!-- TABLE CARD -->
    <div class="card card-table p-3">

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($orders as $order)
                    <tr>

                        <td class="fw-semibold">#{{ $order->id }}</td>

                        <td>{{ $order->customer->nama_customer }}</td>

                        <td>
                            <span class="badge-total">
                                {{ $order->total_price_rupiah }}
                            </span>
                        </td>

                        <td class="date-text">
                            {{ $order->tanggal_order }}
                        </td>

                        <td class="text-end">

                            <a href="{{ route('admin.order.detail', $order->id) }}"
                               class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i> View
                            </a>

                        </td>

                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>