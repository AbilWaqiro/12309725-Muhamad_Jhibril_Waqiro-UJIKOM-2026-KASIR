<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

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

        .form-card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .form-control {
            border-radius: 10px;
            padding: 10px 12px;
        }

        .btn {
            border-radius: 10px;
        }

        label {
            font-weight: 600;
            color: #374151;
        }

        .form-text {
            font-size: 12px;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">

        <a class="navbar-brand fw-bold" href="#">
            <i class="bi bi-box-seam me-2"></i>Admin Panel
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
        <h2 class="page-title">Add Product</h2>
        <p class="subtitle">Tambahkan produk baru ke sistem</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card form-card p-4">

                <form method="POST"
                      action="{{ route('admin.products.store') }}"
                      enctype="multipart/form-data">

                    @csrf

                    <!-- NAME -->
                    <div class="mb-3">
                        <label>Product Name</label>
                        <input type="text"
                               class="form-control"
                               name="name"
                               value="{{ old('name') }}"
                               required>
                        @error('name')
                            <div class="text-danger mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- PRICE -->
                    <div class="mb-3">
                        <label>Price</label>
                        <input type="number"
                               class="form-control"
                               name="price"
                               min="0"
                               max="100000"
                               value="{{ old('price') }}"
                               required>
                        @error('price')
                            <div class="text-danger mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- STOCK -->
                    <div class="mb-3">
                        <label>Stock</label>
                        <input type="number"
                               class="form-control"
                               name="stock"
                               min="0"
                               max="100"
                               value="{{ old('stock') }}"
                               required>
                        <div class="form-text">
                            Maksimal stok adalah 100
                        </div>
                        @error('stock')
                            <div class="text-danger mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- IMAGE -->
                    <div class="mb-4">
                        <label>Product Image</label>
                        <input type="file"
                               class="form-control"
                               name="image"
                               accept="image/*">
                        @error('image')
                            <div class="text-danger mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- BUTTON -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.products') }}"
                           class="btn btn-secondary px-4">
                            Cancel
                        </a>

                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-plus-circle me-1"></i> Create Product
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>