<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Detail</title>

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

        .card-box {
            border: none;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        }

        .info-label {
            color: #6b7280;
            font-size: 13px;
        }

        .info-value {
            font-weight: 600;
            color: #111827;
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

    <div class="mb-4">
        <h2 class="page-title">Order Detail</h2>
        <p class="subtitle">Detail lengkap transaksi pelanggan</p>
    </div>

    <!-- ORDER INFO -->
    <div class="card card-box p-4 mb-4">

        <div class="row g-3">

            <div class="col-md-4">
                <div class="info-label">Customer</div>
                <div class="info-value">{{ $order->customer->nama_customer }}</div>
            </div>

            <div class="col-md-4">
                <div class="info-label">Total</div>
                <div class="info-value">
                    <span class="badge-total">
                        {{ $order->total_price_rupiah }}
                    </span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-label">Date</div>
                <div class="info-value">{{ $order->tanggal_order }}</div>
            </div>

        </div>

    </div>

    <!-- ITEMS -->
    <div class="card card-box p-3">

        <h5 class="fw-bold mb-3">
            <i class="bi bi-box-seam me-1"></i> Items
        </h5>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">

                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($order->detailOrders as $detail)
                    <tr>
                        <td class="fw-semibold">
                            {{ $detail->produk->nama_produk }}
                        </td>

                        <td>{{ $detail->jumlah }}</td>

                        <td class="text-muted">
                            {{ $detail->harga_rupiah }}
                        </td>

                        <td class="fw-semibold">
                            {{ $detail->sub_total_rupiah }}
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

    </div>

    <!-- BACK BUTTON -->
    <div class="mt-4">
        <a href="{{ route('admin.orders') }}" class="btn btn-secondary px-4">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>