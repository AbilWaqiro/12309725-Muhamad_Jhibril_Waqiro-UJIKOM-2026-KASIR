<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body {
        background: #f4f6fb;
        font-family: 'Segoe UI', sans-serif;
    }

    /* ================= NAVBAR ================= */
    .navbar {
        background: linear-gradient(135deg, #1f2937, #111827);
    }

    /* ================= TITLE ================= */
    h1 {
        font-weight: 800;
        color: #111827;
    }

    /* ================= TABLE CARD LOOK ================= */
    .table {
        background: white;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    }

    .table thead {
        background: #f9fafb;
    }

    .table th {
        font-weight: 700;
        font-size: 13px;
        color: #374151;
        border: none !important;
    }

    .table td {
        vertical-align: middle;
        font-size: 14px;
        color: #111827;
    }

    .table-bordered {
        border: none !important;
    }

    /* ================= BUTTON ================= */
    .btn {
        border-radius: 10px !important;
        font-weight: 500;
    }

    .btn-success {
        box-shadow: 0 10px 20px rgba(34,197,94,0.2);
    }

    .btn-primary {
        box-shadow: 0 10px 20px rgba(13,110,253,0.2);
    }

    /* ================= EXPORT BUTTON ================= */
    .d-flex .btn-success {
        padding: 8px 16px;
    }

    /* ================= ALERT ================= */
    .alert {
        border-radius: 12px;
    }

    /* ================= EMPTY STATE ================= */
    td.text-center {
        color: #6b7280;
        padding: 20px;
    }

    /* ================= HOVER EFFECT ================= */
    .table tbody tr:hover {
        background: #f9fafb;
        transition: 0.2s;
    }

    /* ================= BADGE STYLE (optional future use) ================= */
    .badge {
        border-radius: 8px;
    }
</style>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Employee Panel</a>
            <div class="navbar-nav ms-auto">
                <a href="{{ route('employee.dashboard') }}" class="nav-link">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Your Orders</h1>
            <a href="{{ route('employee.orders.export') }}" class="btn btn-success">Export Excel</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sale Date</th>
                    <th>Customer</th>
                    <th>Total Price</th>
                    <th>Total Pay</th>
                    <th>Total Return</th>
                    <th>Used Points</th>
                    <th>Earned Points</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->sale_date }}</td>
                        <td>{{ $order->customer->name }}</td>
                        <td>{{ $order->total_price_rupiah }}</td>
                        <td>{{ $order->total_pay_rupiah }}</td>
                        <td>{{ $order->total_return_rupiah }}</td>
                        <td>{{ $order->point_used }}</td>
                        <td>{{ $order->point_earned }}</td>
                        <td><a href="{{ route('employee.order.detail', $order->id) }}" class="btn btn-sm btn-primary">Detail</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
