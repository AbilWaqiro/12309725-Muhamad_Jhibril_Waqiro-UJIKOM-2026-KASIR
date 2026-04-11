<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Detail</title>
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

    /* ================= PAGE TITLE ================= */
    h1 {
        font-weight: 800;
        color: #111827;
        margin-bottom: 20px;
    }

    /* ================= CARD GLOBAL ================= */
    .card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        margin-bottom: 20px;
    }

    .card-header {
        background: #f9fafb;
        border-bottom: 1px solid #eee;
        font-weight: 600;
        border-top-left-radius: 16px !important;
        border-top-right-radius: 16px !important;
    }

    .card-body p {
        margin-bottom: 8px;
        color: #374151;
        font-size: 14px;
    }

    /* ================= TABLE ================= */
    .table {
        margin-bottom: 0;
    }

    .table thead {
        background: #f9fafb;
    }

    .table th {
        font-size: 13px;
        font-weight: 700;
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

    .table tbody tr:hover {
        background: #f9fafb;
        transition: 0.2s;
    }

    /* ================= BUTTON ================= */
    .btn {
        border-radius: 10px !important;
        font-weight: 500;
    }

    .btn-secondary {
        background: #6b7280;
        border: none;
        box-shadow: 0 10px 20px rgba(107,114,128,0.2);
    }

    /* ================= STRONG TEXT ================= */
    strong {
        color: #111827;
    }

    /* ================= RESPONSIVE SPACING ================= */
    .container {
        padding-bottom: 40px;
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
        <h1>Order #{{ $order->id }}</h1>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Customer</div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $order->customer->name }}</p>
                        <p><strong>Phone:</strong> {{ $order->customer->phone_number }}</p>
                        <p><strong>Points Balance:</strong> {{ $order->customer->total_poin }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Payment</div>
                    <div class="card-body">
                        <p><strong>Total Price:</strong> {{ $order->total_price_rupiah }}</p>
                        <p><strong>Points Used:</strong> {{ $order->point_used }}</p>
                        <p><strong>Amount Paid:</strong> {{ $order->total_pay_rupiah }}</p>
                        <p><strong>Total Return:</strong> {{ $order->total_return_rupiah }}</p>
                        <p><strong>Points Earned:</strong> {{ $order->point_earned }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">Products</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->detailOrders as $detail)
                            <tr>
                                <td>{{ $detail->produk->name }}</td>
                                <td>{{ $detail->harga_rupiah }}</td>
                                <td>{{ $detail->amount }}</td>
                                <td>{{ $detail->sub_total_rupiah }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <a href="{{ route('employee.orders') }}" class="btn btn-secondary">Back to Orders</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
