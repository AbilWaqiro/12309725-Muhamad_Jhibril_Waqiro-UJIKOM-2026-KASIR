@extends('layout.layout')

@section('content')
    <div class="container mt-4">

        <!-- Alert -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-dark mb-0">Daftar Produk</h4>

            @if(Auth::user()->role === 'admin')
                <a href="{{ route('product.create') }}" class="btn btn-primary shadow-sm">
                    + Tambah Produk
                </a>
            @endif
        </div>

        <!-- Card -->
        <div class="card border-0 shadow rounded-3">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover">

                        <!-- Header Table -->
                        <thead class="table-light">
                            <tr class="text-secondary small text-uppercase">
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Gambar</th>
                                <th class="px-4 py-3">Nama Produk</th>
                                <th class="px-4 py-3">Harga</th>
                                <th class="px-4 py-3">Stok</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <!-- Body -->
                        <tbody>

                            @forelse($products as $index => $product)
                                <tr class="border-bottom">

                                    <!-- No -->
                                    <td class="px-4">
                                        {{ $products->firstItem() + $index }}
                                    </td>

                                    <!-- Gambar -->
                                    <td class="px-4">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                width="60"
                                                class="rounded shadow-sm border">
                                        @else
                                            <span class="text-muted fst-italic">Tidak ada</span>
                                        @endif
                                    </td>

                                    <!-- Nama -->
                                    <td class="px-4 fw-semibold text-dark">
                                        {{ $product->name }}
                                    </td>

                                    <!-- Harga -->
                                    <td class="px-4 text-success fw-semibold">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </td>

                                    <!-- Stock -->
                                    <td class="px-4">
                                        @if($product->stock > 10)
                                            <span class="badge rounded-pill bg-success px-3 py-2">
                                                {{ $product->stock }}
                                            </span>
                                        @else
                                            <span class="badge rounded-pill bg-danger px-3 py-2">
                                                {{ $product->stock }}
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Aksi -->
                                    <td class="px-4 text-center">
                                        <div class="d-flex justify-content-center gap-2 flex-wrap">

                                            <a href="{{ route('product.show', $product->id) }}"
                                                class="btn btn-sm btn-info text-white">
                                                Detail
                                            </a>

                                            @if(Auth::user()->role === 'admin')
                                                <a href="{{ route('product.edit', $product->id) }}"
                                                    class="btn btn-sm btn-warning text-white">
                                                    Edit
                                                </a>

                                                <!-- BUTTON MODAL -->
                                                <button 
                                                    type="button" 
                                                    class="btn btn-sm btn-primary btn-edit-stock"
                                                    data-id="{{ $product->id }}"
                                                    data-stock="{{ $product->stock }}"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editStockModal">
                                                    Edit Stok
                                                </button>

                                                <form action="{{ route('product.destroy', $product->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin hapus produk ini?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-sm btn-danger">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">
                                        Belum ada produk
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                </div>

            </div>
        </div>

        <!-- MODAL EDIT STOCK -->
        <div class="modal fade" id="editStockModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Stok Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form id="formEditStock" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="modal-body">

                            <input type="hidden" id="product_id">

                            <div class="mb-3">
                                <label class="form-label">Stok</label>
                                <input type="number" 
                                    name="stock" 
                                    id="product_stock" 
                                    class="form-control" 
                                    required>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Stok</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-end">
            {{ $products->links() }}
        </div>

    </div>

    <!-- SCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const buttons = document.querySelectorAll('.btn-edit-stock');

            buttons.forEach(button => {
                button.addEventListener('click', function () {

                    const id = this.dataset.id;
                    const stock = this.dataset.stock;

                    document.getElementById('product_stock').value = stock;

                    let url = "{{ route('product.updateStock', ':id') }}";
                    url = url.replace(':id', id);

                    document.getElementById('formEditStock').action = url;
                });
            });

        });
    </script>
@endsection