<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Products</title>

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

        .img-product {
            width: 55px;
            height: 55px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }

        .badge-stock {
            padding: 6px 10px;
            border-radius: 8px;
            font-size: 12px;
            background: #e0f2fe;
            color: #075985;
        }

        .price-text {
            font-weight: 600;
            color: #111827;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">

        <a class="navbar-brand fw-bold" href="#">
            <i class="bi bi-basket me-2"></i>Employee Panel
        </a>

        <div class="ms-auto d-flex align-items-center gap-2">
            <a href="{{ route('employee.dashboard') }}" class="btn btn-outline-light btn-sm">
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
        <h2 class="page-title">Products</h2>
        <p class="subtitle">Daftar produk yang tersedia untuk transaksi</p>
    </div>

    <!-- TABLE CARD -->
    <div class="card card-table p-3">

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Image</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($products as $product)
                    <tr>

                        <td class="fw-semibold">#{{ $product->id }}</td>

                        <td>{{ $product->name }}</td>

                        <td class="price-text">
                            {{ $product->harga_rupiah }}
                        </td>

                        <td>
                            <span class="badge-stock">
                                {{ $product->stock }}
                            </span>
                        </td>

                        <td>
                            @if($product->image_url)
                                <img src="{{ $product->image_url }}"
                                     class="img-product"
                                     alt="{{ $product->name }}">
                            @else
                                <span class="text-muted">-</span>
                            @endif
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