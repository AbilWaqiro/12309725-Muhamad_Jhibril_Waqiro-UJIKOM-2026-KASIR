<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>

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

        .badge-role {
            padding: 6px 10px;
            border-radius: 8px;
            font-size: 12px;
        }

        .badge-admin {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-employee {
            background: #dcfce7;
            color: #166534;
        }

        .btn {
            border-radius: 10px;
        }

        .alert {
            border-radius: 12px;
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
        <h2 class="page-title">Manage Users</h2>
        <p class="subtitle">Kelola semua user sistem</p>
    </div>

    <!-- ALERT -->
    @if($message = session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($message = session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- TOP ACTION -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus me-1"></i> Add User
        </a>
    </div>

    <!-- TABLE CARD -->
    <div class="card card-table p-3">

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="fw-semibold">#{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td class="text-muted">{{ $user->email }}</td>

                        <td>
                            @if($user->role === 'admin')
                                <span class="badge badge-role badge-admin">Admin</span>
                            @else
                                <span class="badge badge-role badge-employee">Employee</span>
                            @endif
                        </td>

                        <td class="text-end">

                            <a href="{{ route('admin.users.edit', $user->id) }}"
                               class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>

                            @if(auth()->id() !== $user->id)
                                <form method="POST"
                                      action="{{ route('admin.users.destroy', $user->id) }}"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-sm btn-danger" disabled title="Tidak bisa hapus akun sendiri">
                                    <i class="bi bi-trash"></i>
                                </button>
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