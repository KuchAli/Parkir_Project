@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Transaction Data</h4>
        
        @if (session('success'))
            <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('petugas.transaksi.index') }}" class="d-flex">
            <input type="text" 
            name="search" 
            class="form-control me-2"
            placeholder="Cari plat nomor / nama..."
            value="{{ request('search') }}">
            <button class="btn btn-dark">Search</button>
        </form>
    </div>
    
    
    {{-- Card Table --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <a href="{{ route('petugas.transaksi.create') }}" class="btn btn-dark btn-sm mb-3">
                    + Add Transaction
                </a>
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Plate Number</th>
                            <th>User Name</th>
                            <th>Parking Area</th>
                            <th>Entry Time</th>
                            <th>Exit Time</th>
                            <th>Status</th>
                            <th>Total Payment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse($transaksi as $index => $t)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $t->kendaraan->plat_nomor ?? '-' }}</td>
                                <td>{{ $t->user->nama_lengkap ?? '-' }}</td>
                                <td>{{ $t->area->nama_area ?? '-' }}</td>
                                <td>{{ $t->waktu_masuk }}</td>
                                <td>{{ $t->waktu_keluar ?? '-' }}</td>
                                <td>
                                    @if($t->status == 'masuk')
                                        <span class="badge bg-warning text-dark">Parkir</span>
                                    @else
                                        <span class="badge bg-success">Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    @if($t->biaya_total)
                                        Rp {{ number_format($t->biaya_total, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">

                                        {{-- Tombol Detail --}}
                                        <a href="{{ route('petugas.transaksi.detail', $t->id_parkir) }}"
                                           class="btn btn-sm btn-info text-white">
                                            Detail
                                        </a>

                                        {{-- Tombol Cetak Struk --}}
                                        @if($t->status == 'keluar')
                                            <a href="{{ route('petugas.parkir.struk', $t->id_parkir) }}"
                                               class="btn btn-sm btn-primary"
                                               target="_blank">
                                                Struk
                                            </a>
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="py-4">
                                    Tidak ada data transaksi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
