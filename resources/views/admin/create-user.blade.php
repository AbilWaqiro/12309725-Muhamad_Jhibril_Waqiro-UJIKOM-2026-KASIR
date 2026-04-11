<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6fb;
        }

        .navbar {
            background: linear-gradient(135deg, #1f2937, #111827);
        }

        .form-card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .page-title {
            font-weight: 700;
            color: #1f2937;
        }

        .subtitle {
            color: #6b7280;
        }

        .form-control, .form-select {
            border-radius: 10px;
            padding: 10px 12px;
        }

        .btn-primary {
            border-radius: 10px;
        }

        .btn-secondary {
            border-radius: 10px;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            <i class="bi bi-shield-lock me-2"></i>Admin Panel
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
        <h2 class="page-title">Add User</h2>
        <p class="subtitle">Tambahkan user baru ke sistem</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card form-card p-4">

                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf

                    <!-- NAME -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <!-- EMAIL -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <!-- ROLE -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Role</label>
                        <select class="form-select" name="role" required>
                            <option value="admin">Admin</option>
                            <option value="employee">Employee</option>
                        </select>
                    </div>

                    <!-- BUTTON -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.users') }}" class="btn btn-secondary px-4">
                            Cancel
                        </a>

                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-person-plus me-1"></i> Create User
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