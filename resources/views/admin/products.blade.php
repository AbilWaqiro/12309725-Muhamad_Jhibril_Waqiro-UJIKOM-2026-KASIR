<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>

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

        .modal-content {
            border-radius: 16px;
            border: none;
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
        <h2 class="page-title">Manage Products</h2>
        <p class="subtitle">Kelola produk, stok, dan harga</p>
    </div>

    <!-- ADD BUTTON -->
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Add Product
        </a>
    </div>

    <!-- ERRORS -->
    @if ($errors->any())
        <div class="alert alert-danger rounded-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($products as $product)
                    <tr>

                        <td class="fw-semibold">#{{ $product->id }}</td>

                        <td>{{ $product->name }}</td>

                        <td class="text-muted">{{ $product->harga_rupiah }}</td>

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

                        <td class="text-end">

                            <a href="{{ route('admin.products.edit', $product->id) }}"
                               class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <button type="button"
                                    class="btn btn-sm btn-info"
                                    data-bs-toggle="modal"
                                    data-bs-target="#updateStockModal"
                                    data-product-id="{{ $product->id }}"
                                    data-product-name="{{ $product->name }}"
                                    data-current-stock="{{ $product->stock }}">
                                <i class="bi bi-box"></i>
                            </button>

                            <form method="POST"
                                  action="{{ route('admin.products.destroy', $product->id) }}"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                        </td>

                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

    </div>
</div>

<!-- MODAL -->
<div class="modal fade" id="updateStockModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-box-seam me-2"></i>Update Stock
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" id="updateStockForm">
                @csrf
                @method('PATCH')

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Product Name</label>
                        <input type="text" class="form-control" id="product_name" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">New Stock</label>
                        <input type="number"
                               class="form-control"
                               id="new_stock"
                               name="stock"
                               min="0"
                               max="100"
                               required>
                        <div class="form-text">
                            Maksimal stok 100
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    const updateStockModal = document.getElementById('updateStockModal');

    updateStockModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;

        const productId = button.getAttribute('data-product-id');
        const productName = button.getAttribute('data-product-name');
        const currentStock = button.getAttribute('data-current-stock');

        document.getElementById('product_name').value = productName;
        document.getElementById('new_stock').value = currentStock;

        document.getElementById('updateStockForm').action =
            '{{ route("admin.products.update-stock", ":id") }}'.replace(':id', productId);
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>