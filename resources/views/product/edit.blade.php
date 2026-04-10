@extends('layout.layout')

@section('content')
    <div class="container mt-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-dark mb-0">Edit Produk</h4>
            <a href="{{ route('product.index') }}" class="btn btn-secondary shadow-sm">
                ← Kembali
            </a>
        </div>

        <div class="card border-0 shadow rounded-3">
            <div class="card-body p-4">

                <form action="{{ route('product.update', $product->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="row">
                        <!-- LEFT -->
                        <div class="col-md-6">
                            <!-- NAMA -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Nama Produk</label>
                                <input type="text"
                                    name="name"
                                    class="form-control form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $product->name) }}"
                                    placeholder="Masukkan nama produk">

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- HARGA -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Harga</label>
                                <input type="number"
                                    name="price"
                                    class="form-control form-control @error('price') is-invalid @enderror"
                                    value="{{ old('price', $product->price) }}"
                                    placeholder="Masukkan harga">

                                @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- STOK -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Stok</label>
                                <input type="number"
                                    class="form-control form-control bg-light"
                                    value="{{ $product->stock }}"
                                    disabled>
                                <small class="text-muted">
                                    Stok diubah dari halaman daftar produk
                                </small>
                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="col-md-6">
                            <!-- GAMBAR SAAT INI -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Gambar Saat Ini</label><br>

                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                        class="img-thumbnail shadow-sm mb-2"
                                        width="200">
                                @else
                                    <p class="text-muted fst-italic">Tidak ada gambar</p>
                                @endif
                            </div>

                            <!-- GANTI GAMBAR -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Ganti Gambar</label>
                                <input type="file"
                                    name="image"
                                    class="form-control @error('image') is-invalid @enderror"
                                    accept="image/*">

                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- PREVIEW GAMBAR -->    
                            <div class="mt-3">
                                <img id="preview" class="img-thumbnail shadow-sm d-none" width="200">
                            </div>

                        </div>

                    </div>

                    <!-- BUTTON -->
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            Update Produk
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