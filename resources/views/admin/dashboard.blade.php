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
    
    <div class="card shadow-sm mt-4">
        <div class="card-header">
            <h5 class="mb-0">Log Activity</h5>
        </div>
        <div class="overflow-x-auto ms-2">
            <table class="attendance-table border text-center align-middle">
                <thead class="border">
                    <tr>
                        <th class="py-3 px-2 text-center">No</th>
                        <th class="py-3 px-2 text-center">User</th>
                        <th class="py-3 px-2 text-center">Activity</th>
                        <th class="py-3 px-2 text-center">Timestamp</th>
                    </tr>
                </thead>

                <tbody class="text-gray-700">
                    @forelse ($logs as $log)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-3 px-2">
                            {{ $loop->iteration }}
                        </td>

                        <td class="py-3 px-2 font-medium">
                            {{ $log->user->nama_lengkap ?? 'Unknown User' }}
                        </td>

                        <td class="py-3 px-2">
                            {{ $log->aktivitas }}
                        </td>

                        <td class="py-3 px-2">
                            {{ \Carbon\Carbon::parse($log->waktu_aktivitas)->format('d-m-Y H:i:s') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-6 text-center text-gray-400">
                            No activity logs available
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
            <div class="mt-3">
                {{ $logs->links() }}
            </div>
        </div>
    </div>


</div>
@endsection
