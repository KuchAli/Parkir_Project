@extends('layouts.main')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Pengguna</h5>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">+ Tambah Pengguna</a>
        </div>

        <div class="card-body m-5">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->nama_lengkap }}</td>
                                <td>{{ $user->username }}</td>
                                <td>
                                    @php
                                        $role = strtolower($user->role);
                                    @endphp

                                    @if ($role === 'admin')
                                        <span class="badge bg-primary">Admin</span>
                                    @elseif ($role === 'petugas')
                                        <span class="badge bg-warning text-dark">Petugas</span>
                                    @elseif ($role === 'peminjam')
                                        <span class="badge bg-secondary">Owner</span>
                                    @else
                                        <span class="badge bg-dark">Unknown</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.users.edit', $user->user_id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('admin.users.destroy', $user->user_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data?')"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Data pengguna belum tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
