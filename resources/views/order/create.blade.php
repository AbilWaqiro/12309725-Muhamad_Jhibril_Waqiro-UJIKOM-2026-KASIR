@extends('layout.layout')

@section('title', 'Tambah Transaksi')

@section('content')
<form action="{{ route('order.store') }}" method="POST">
    @csrf

    <div class="container mt-4" style="max-width:1100px;">
        <div class="row g-4">

            {{-- ================= LEFT: PRODUK ================= --}}
            <div class="col-lg-7">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body">

                        <h5 class="fw-bold mb-3">🛒 Pilih Produk</h5>

                        @foreach($products as $product)
                            <div class="d-flex align-items-center justify-content-between border-bottom py-2">
                                
                                <div>
                                    <input type="checkbox" name="product_id[]" value="{{ $product->id }}">
                                    <span class="ms-2 fw-semibold">{{ $product->name }}</span><br>
                                    <small class="text-muted">
                                        Rp {{ number_format($product->price) }} | Stok: {{ $product->stock }}
                                    </small>
                                </div>

                                <input type="number" 
                                    name="qty[{{ $product->id }}]" 
                                    value="1" 
                                    min="1"
                                    class="form-control form-control-sm text-center"
                                    style="width:70px;">
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

            {{-- ================= RIGHT: PEMBAYARAN ================= --}}
            <div class="col-lg-5">
                <div class="card shadow-sm border-0 rounded-4 p-3">

                    <h5 class="fw-bold mb-3">💳 Pembayaran</h5>

                    {{-- TIPE CUSTOMER --}}
                    <div class="mb-3">
                        <label class="small text-muted">Tipe Customer</label><br>

                        <div class="form-check form-check-inline">
                            <input type="radio" name="customer_type" value="member" checked class="form-check-input">
                            <label class="form-check-label">Member</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input type="radio" name="customer_type" value="non_member" class="form-check-input">
                            <label class="form-check-label">Non-member</label>
                        </div>
                    </div>

                    {{-- INPUT MEMBER --}}
                    <div class="mb-2">
                        <label class="small text-muted">Nama</label>
                        <input type="text" name="name" class="form-control form-control-sm">
                    </div>

                    <div class="mb-3">
                        <label class="small text-muted">No HP</label>
                        <div class="d-flex gap-2">
                            <input type="text" name="phone" value="{{ request('phone') }}" class="form-control form-control-sm">
                            
                            <button type="submit" formaction="{{ route('order.create') }}" class="btn btn-sm btn-outline-secondary">
                                Cek
                            </button>
                        </div>
                    </div>

                    {{-- INFO MEMBER --}}
                    @if(isset($customer))
                        <div class="alert alert-success py-2 small">
                            <strong>{{ $customer->name }}</strong><br>
                            Poin: {{ $customer->total_poin }}
                        </div>

                        <input type="hidden" name="customer_id" value="{{ $customer->id }}">

                        <div class="mb-3">
                            <label class="small text-muted">Gunakan Poin</label>
                            <input type="number" 
                                name="points_used"
                                max="{{ $customer->total_poin }}"
                                value="0"
                                class="form-control form-control-sm">
                        </div>
                    @endif

                    {{-- PEMBAYARAN --}}
                    <div class="mb-3">
                        <label class="small text-muted">Uang Bayar</label>
                        <input type="number" name="total_pay" required class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-semibold">
                        Simpan Transaksi
                    </button>

                </div>
            </div>

        </div>
    </div>
</form>
@endsection