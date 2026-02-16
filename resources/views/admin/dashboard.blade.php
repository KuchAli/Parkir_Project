@extends('layouts.main')

@section('content')
<div class="container">
    <h3 class="mb-4">Admin Dashboard</h3>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Total Kendaraan</h6>
                    <h3>{{ $totalVehicles }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Total Tarif</h6>
                    <h3>{{ $totalTarif }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Total Pengguna</h6>
                    <h3>{{ $totalUsers }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Area</h6>
                    <h3>{{ $totalAreas }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Action -->
    <div class="card shadow-sm">
        <div class="card-header">
            Aksi Cepat
        </div>
        <div class="card-body">
            <a href="{{ route('admin.kendaraan.create') }}" class="btn btn-primary">
                + Add Vehicle
            </a>
            <a href="{{ route('admin.area.index') }}" class="btn btn-secondary">
                Area Management
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-info">
                User Management
            </a>
            <a href="{{ route('admin.logs.index') }}" class="btn btn-warning">
                Activity Logs
            </a>
        </div>
    </div>
</div>
@endsection
