@extends('layout.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold text-dark mb-1">Dashboard {{ ucfirst($role) }}</h4>
                <p class="text-muted mb-0">
                    Selamat datang, {{ auth()->user()->name }}. Ini tampilan khusus untuk peran <strong>{{ $role }}</strong>.
                </p>
            </div>
        </div>

        @if($role === 'admin')
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm p-4">
                        <h6 class="text-uppercase text-secondary">Total User</h6>
                        <div class="display-6 fw-bold">{{ $dashboardData['totalUsers'] }}</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm p-4">
                        <h6 class="text-uppercase text-secondary">Total Produk</h6>
                        <div class="display-6 fw-bold">{{ $dashboardData['totalProducts'] }}</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm p-4">
                        <h6 class="text-uppercase text-secondary">Total Pesanan</h6>
                        <div class="display-6 fw-bold">{{ $dashboardData['totalOrders'] }}</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm p-4">
                        <h6 class="text-uppercase text-secondary">Total Pendapatan</h6>
                        <div class="display-6 fw-bold text-success">Rp {{ number_format($dashboardData['totalRevenue'], 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm p-4">
                <h5 class="fw-semibold mb-3">Ringkasan Admin</h5>
                <p class="mb-0 text-muted">
                    Sebagai admin, Anda dapat mengelola user, produk, dan melihat statistik penjualan secara lengkap.
                </p>
            </div>
        @elseif($role === 'kasir')
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-4">
                        <h6 class="text-uppercase text-secondary">Produk Tersedia</h6>
                        <div class="display-6 fw-bold">{{ $dashboardData['totalProducts'] }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-4">
                        <h6 class="text-uppercase text-secondary">Pesanan Hari Ini</h6>
                        <div class="display-6 fw-bold">{{ $dashboardData['todayOrders'] }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-4">
                        <h6 class="text-uppercase text-secondary">Pendapatan Hari Ini</h6>
                        <div class="display-6 fw-bold text-success">Rp {{ number_format($dashboardData['todayRevenue'], 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm p-4">
                <h5 class="fw-semibold mb-3">Ringkasan Kasir</h5>
                <p class="mb-0 text-muted">
                    Sebagai kasir, Anda dapat melihat produk dan memproses penjualan hari ini melalui halaman transaksi.
                </p>
            </div>
        @endif
    </div>
@endsection