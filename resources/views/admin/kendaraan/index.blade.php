@extends('layouts.main')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Kendaraan</h5>
            <a href="{{ route('admin.kendaraan.create') }}" class="btn btn-primary btn-sm">+ Tambah Kendaraan</a>
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
                            <th>Plat Nomor</th>
                            <th>Jenis Kendaraan</th>
                            <th>Warna</th>
                            <th>Pemilik</th>
                            <th>User</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kendaraan as $vehicle)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $vehicle->plat_nomor ?? '-' }}</td>
                                <td>{{ $vehicle->jenis_kendaraan ?? '-' }}</td>
                                <td>{{ $vehicle->warna ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ $vehicle->pemilik->user->nama_lengkap ?? '-' }}
                                    </span>
                                </td>
                                <td>{{ $vehicle->user->username ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.kendaraan.edit', $vehicle->id_kendaraan) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.kendaraan.destroy', $vehicle->id_kendaraan) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Yakin hapus data?')" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Data kendaraan belum tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
