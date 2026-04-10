@extends('layout.layout')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-dark mb-0">Detail Produk</h4>
            <a href="{{ route('product.index') }}" class="btn btn-secondary shadow-sm">
                ← Kembali
            </a>
        </div>

        <div class="card border-0 shadow rounded-3">
            <div class="card-body p-4">
                <div class="row gy-4">

                    <div class="col-md-5 text-center">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                class="img-fluid rounded shadow-sm"
                                alt="{{ $product->name }}">
                        @else
                            <div class="border rounded p-5 text-muted fst-italic">
                                Tidak ada gambar produk
                            </div>
                        @endif
                    </div>

                    <div class="col-md-7">
                        <h3 class="fw-bold">{{ $product->name }}</h3>
                        <p class="text-success fs-5 fw-semibold">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>

                        <p>
                            <span class="badge rounded-pill {{ $product->stock > 10 ? 'bg-success' : 'bg-danger' }} px-3 py-2">
                                Stok: {{ $product->stock }}
                            </span>
                        </p>

                        <div class="mt-4">
                            <p class="mb-2"><strong>ID Produk:</strong> {{ $product->id }}</p>
                            <p class="mb-2"><strong>Dibuat pada:</strong> {{ $product->created_at?->format('d M Y H:i') ?? '-' }}</p>
                            <p class="mb-0"><strong>Diperbarui:</strong> {{ $product->updated_at?->format('d M Y H:i') ?? '-' }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection