@extends('layouts.main');
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Transaction Detail</h4>
    <a href="{{ route('petugas.transaksi.index') }}" class="btn btn-secondary btn-sm">Back</a>
</div>
<div class="card shadow-sm mb-4">
    <div class="card-header">
        <h5>Transaction Info</h5>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-md-4 fw-bold">Plate Number:</div>
            <div class="col-md-8">{{ $transaksi->kendaraan->plat_nomor }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-md-4 fw-bold">Vehicle Type:</div>
            <div class="col-md-8">{{ $transaksi->kendaraan->jenis_kendaraan }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-md-4 fw-bold">User Name:</div>
            <div class="col-md-8">{{ $transaksi->user->nama_lengkap }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-md-4 fw-bold">Parking Area:</div>
            <div class="col-md-8">{{ $transaksi->area->nama_area }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-md-4 fw-bold">Entry Time:</div>
            <div class="col-md-8">{{ $transaksi->waktu_masuk }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-md-4 fw-bold">Exit Time:</div>
            <div class="col-md-8">{{ $transaksi->waktu_keluar ?? '-' }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-md-4 fw-bold">Status:</div>
            <div class="col-md-8">
                @if($transaksi->status == 'masuk')
                    <span class="badge bg-warning text-dark">Parkir</span>
                @else
                    <span class="badge bg-success">Selesai</span>
                @endif
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-4 fw-bold">Duration (Hours):</div>
            <div class="col-md-8">{{ $transaksi->durasi_jam ?? '-' }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-md-4 fw-bold">Total Payment:</div>
            <div class="col-md-8">
                Rp {{ number_format($transaksi->biaya_total ?? 0,0,',','.') }}
            </div>
        </div>
    </div>
</div>
@if($transaksi->status == 'masuk')
    <div class="mb-4">
        <form action="{{ route('petugas.transaksi.keluar', $transaksi->id_parkir) }}" method="POST">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-dark w-100">Keluar & Bayar</button>
        </form>
    </div>
@endif

@endsection