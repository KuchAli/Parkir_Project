@extends('layouts.main')

@section('content')
<div class="container">

    <h4 class="mb-4">Dashboard Petugas</h4>

    <div class="row">

        <!-- Masuk Hari Ini -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Kendaraan Masuk Hari Ini</h6>
                    <h3>{{ $masukHariIni }}</h3>
                </div>
            </div>
        </div>

        <!-- Keluar Hari Ini -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Kendaraan Keluar Hari Ini</h6>
                    <h3>{{ $keluarHariIni }}</h3>
                </div>
            </div>
        </div>

        <!-- Sedang Parkir -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6> Total Transactiion</h6>
                    <h3>{{ $totalTransaksi }}</h3>
                </div>
            </div>
        </div>

    </div>

    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            Informasi Area Parkir
        </div>
         <div class="card-container border-0 rounded mb-2">
            <div class="col-md-2">
                <form method="GET" action="{{ route('petugas.dashboard') }}" 
                    class="row g-2 align-items-end">
                    <label for="sort" class="form-label mb-1">Sort By</label>
                    <select name="sort" onchange="this.form.submit()"
                            class="form-select">
                        <option value="terisi" {{ request('sort')=='terisi'?'selected':'' }}>Filled</option>
                        <option value="sisa" {{ request('sort')=='sisa'?'selected':'' }}>Sisa</option>
                        <option value="nama" {{ request('sort')=='nama_area'?'selected':'' }}>Nama</option>
                    </select>
                </form>
            </div>
         </div>
        <div class="card-body">
            <table class="attendance-table border text-center align-middle">
                <thead>
                    <tr>
                        <th class="text-center">Nama Area</th>
                        <th class="text-center">Kapasitas</th>
                        <th class="text-center">Terisi</th>
                        <th class="text-center">Sisa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($area as $a)
                    <tr>
                        <td>{{ $a->nama_area }}</td>
                        <td>{{ $a->kapasitas }}</td>
                        <td>{{ $a->terisi }}</td>
                        <td>{{ $a->kapasitas - $a->terisi }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                {{ $area->links() }}
            </div>
        </div>
    </div>

</div>
@endsection
