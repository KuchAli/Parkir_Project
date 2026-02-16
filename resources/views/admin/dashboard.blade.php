@extends('layouts.main')

@section('content')
<div class="container">
    <h3 class="mb-4">Admin Dashboard</h3>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Total Vehicles</h6>
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
                    <h6>Total Users</h6>
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
            <h5 class="mb-0">Quick Actions</h5>
        </div>
        <div class="card-body align-items-center d-flex flex-wrap gap-2 justify-content-center">
            <a href="{{ route('admin.kendaraan.create') }}" class="btn btn-primary">
                + Add Vehicle
            </a>
            <a href="{{ route('admin.area.index') }}" class="btn btn-outline-secondary">
                Area Management
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                User Management
            </a>
            <a href="{{ route('admin.logs.index') }}" class="btn btn-outline-secondary">
                Activity Logs
            </a>
        </div>
    </div>
</div>
@endsection
