@extends('layout.layout')

@section('content')
    <div class="container mt-4">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-dark mb-0">Daftar User</h4>
            <a href="{{ route('user.create') }}" class="btn btn-primary shadow-sm">
                + Tambah User
            </a>
        </div>

        <div class="card border-0 shadow rounded-3">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover">
                        <thead class="table-light">
                            <tr class="text-secondary small text-uppercase">
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Role</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $index => $user)
                                <tr class="border-bottom">
                                    <td class="px-4">{{ $users->firstItem() + $index }}</td>
                                    <td class="px-4 fw-semibold text-dark">
                                        <a href="{{ route('user.show', $user->id) }}" class="text-decoration-none text-dark">
                                            {{ $user->name }}
                                        </a>
                                    </td>
                                    <td class="px-4">{{ $user->email }}</td>
                                    <td class="px-4 text-capitalize">{{ $user->role }}</td>
                                    <td class="px-4 text-center">
                                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                                            <a href="{{ route('user.show', $user->id) }}" class="btn btn-sm btn-info text-white">
                                                Detail
                                            </a>
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning text-white">
                                                Edit
                                            </a>
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus user ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-5">
                                        Belum ada user
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-end">
            {{ $users->links() }}
        </div>
    </div>
@endsection
