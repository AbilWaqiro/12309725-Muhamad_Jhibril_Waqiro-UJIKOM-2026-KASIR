@extends('layout.layout')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-dark mb-0">Detail User</h4>
            <a href="{{ route('user.index') }}" class="btn btn-secondary shadow-sm">
                ← Kembali
            </a>
        </div>

        <div class="card border-0 shadow rounded-3">
            <div class="card-body p-4">
                <div class="row gy-4">
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Nama:</strong> {{ $user->name }}</p>
                        <p class="mb-2"><strong>Email:</strong> {{ $user->email }}</p>
                        <p class="mb-2"><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2"><strong>ID User:</strong> {{ $user->id }}</p>
                        <p class="mb-2"><strong>Dibuat pada:</strong> {{ $user->created_at?->format('d M Y H:i') ?? '-' }}</p>
                        <p class="mb-0"><strong>Diperbarui:</strong> {{ $user->updated_at?->format('d M Y H:i') ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
