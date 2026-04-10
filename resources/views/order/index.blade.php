@extends('layout.layout')

@section('title', 'Transaksi')

@section('content')
    <div class="container-fluid mt-4" style="max-width: 1200px;">

        {{-- ALERT --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h4 class="fw-bold mb-0">Riwayat Transaksi</h4>
                <small class="text-muted">Daftar semua transaksi yang telah dilakukan</small>
            </div>

            <div class="d-flex gap-2">
                @if(auth()->user()->role === 'employee')
                    <a href="{{ route('order.create') }}" class="btn btn-primary px-3">
                        + Transaksi
                    </a>
                @endif

                {{-- <a href="{{ route('order.export') }}" class="btn btn-outline-dark px-3">
                    Export
                </a> --}}
            </div>
        </div>

        {{-- CARD TABLE --}}
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table align-middle mb-0">

                        {{-- HEADER --}}
                        <thead style="background-color: #f8fafc;">
                            <tr class="text-muted small text-uppercase">
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Tanggal</th>
                                <th class="px-4 py-3">Kasir</th>
                                <th class="px-4 py-3">Customer</th>
                                <th class="px-4 py-3">Total</th>
                                <th class="px-4 py-3">Bayar</th>
                                <th class="px-4 py-3">Kembali</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>

                        {{-- BODY --}}
                        <tbody>
                            @forelse($orders as $index => $order)
                                <tr style="transition: 0.2s; font-size: 13px;">
                                    <td class="px-4 py-2 fw-semibold text-muted">
                                        {{ $orders->firstItem() + $index }}
                                    </td>

                                    <td class="px-4 py-2">
                                        {{ $order->sale_date }}
                                    </td>

                                    <td class="px-4 py-2">
                                        {{ $order->user?->name ?? '-' }}
                                    </td>

                                    <td class="px-4 py-2">
                                        {{ $order->customer?->name ?? 'Non-member' }}
                                    </td>

                                    <td class="px-4 py-2 fw-semibold text-success">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>

                                    <td class="px-4 py-2">
                                        Rp {{ number_format($order->total_pay, 0, ',', '.') }}
                                    </td>

                                    <td class="px-4 py-2">
                                        Rp {{ number_format($order->total_return, 0, ',', '.') }}
                                    </td>

                                    {{-- <td class="px-4 py-2 text-center">
                                        <a href="{{ route('order.show', $order->id) }}"
                                        class="btn btn-sm btn-dark px-2 py-1" style="font-size: 12px;">
                                            Detail
                                        </a>
                                    </td> --}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4" style="font-size: 13px;">
                                        Belum ada transaksi
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-4 d-flex justify-content-end">
            {{ $orders->links() }}
        </div>

    </div>
@endsection