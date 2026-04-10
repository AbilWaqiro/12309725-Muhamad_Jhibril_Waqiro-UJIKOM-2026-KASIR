@extends('layout.layout')

@section('content')
    <div class="container mt-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-dark mb-0">Tambah Produk</h4>
            <a href="{{ route('product.index') }}" class="btn btn-secondary shadow-sm">
                ← Kembali
            </a>
        </div>

        <!-- Card -->
        <div class="card border-0 shadow rounded-3">
            <div class="card-body p-4">

                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <!-- Left -->
                        <div class="col-md-6">
                            <!-- Nama -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Nama Produk</label>
                                <input type="text" name="name" class="form-control form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    placeholder="Contoh: Indomie Goreng">

                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Harga -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Harga</label>
                                <input type="number" name="price" class="form-control form-control @error('price') is-invalid @enderror" value="{{ old('price') }}"
                                    placeholder="Contoh: 3000">

                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Right -->
                        <div class="col-md-6">
                            <!-- Stock -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Stok</label>
                                <input type="number" name="stock" class="form-control form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}"
                                    placeholder="Contoh: 50">

                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Gambar -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Gambar Produk</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">

                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Preview -->
                            <div class="mt-3">
                                <img id="preview" class="img-thumbnail shadow-sm d-none" width="200">
                            </div>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            Simpan Produk
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

    <!-- Script -->
    <script>
        document.querySelector('input[name="image"]').onchange = evt => {
            const [file] = evt.target.files
            if (file) {
                const preview = document.getElementById('preview')
                preview.src = URL.createObjectURL(file)
                preview.classList.remove('d-none')
            }
        }
    </script>
@endsection