@extends('layouts.main')
@section('title', 'Welcome To Parking Application')
@section('content')
<div class="container">
   <div class="row justify-content-center">
        <div class="col-lg-10">
                {{-- Sort --}}
                <form method="GET" class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label class="form-label">Started</label>
                        <input type="date" name="start_date" 
                            value="{{ request('start_date') }}" 
                            class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Ended</label>
                        <input type="date" name="end_date" 
                            value="{{ request('end_date') }}" 
                            class="form-control">
                    </div>
                    <div class="col-md-2 p-4 mb-2">
                        <button class="btn btn-primary w-100">Filter</button>
                    </div>
                </form>

            <div class="row mb-4">

                <div class="col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h6 class="text-muted">Total Transaksi</h6>
                            <h3 class="fw-bold">{{ $totalTransaksi }}</h3>
                            <small class="text-muted">
                                {{ $start->format('d M Y') }} - {{ $end->format('d M Y') }}
                            </small>
                        </div>
                    </div>
                </div>

                {{-- Card Rekap --}}
                <div class="col-md-6">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h6 class="text-muted">Total Pengeluaran</h6>
                                <h3 class="fw-bold">
                                    Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                                </h3>
                                <small class="text-muted">
                                    Periode terpilih
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card Transaksi --}}
                <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h5 class="mb-4">Transaksi Terbaru</h5>

                    @forelse($transaksi as $item)
                        <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                            <div>
                                <strong>{{ $item->kendaraan->plat_nomor ?? '-' }}</strong>
                                <br>
                                <small class="text-muted">
                                    {{ $item->waktu_masuk }}
                                </small>
                            </div>
                            <div class="text-end">
                                <strong>
                                    Rp {{ number_format($item->biaya_total, 0, ',', '.') }}
                                </strong>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Tidak ada transaksi pada periode ini.</p>
                    @endforelse
                </div>
                <div class="mt-3">
                    {{ $transaksi->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

    
@endsection