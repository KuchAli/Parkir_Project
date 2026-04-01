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
         <div class="card-container border-0 rounded mb-4">
                <!-- Search & Sort -->
                <form method="GET" action="{{ route('admin.dashboard') }}" 
                    class="row g-3 align-items-end mb-3">

                    <div class="col-md-4">
                        <label for="search" class="form-label mb-1 ">Search</label>
                        <input 
                            type="text" 
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search name ..."
                            class="form-control"
                        >
                    </div>

                    <div class="col-md-2">
                        <label for="sort" class="form-label mb-1">Sort By</label>
                        <select name="sort" onchange="this.form.submit()"
                                class="form-select">
                            <option value="newest" {{ request('sort')=='newest'?'selected':'' }}>Newest</option>
                            <option value="oldest" {{ request('sort')=='oldest'?'selected':'' }}>Oldest</option>
                        </select>
                    </div>

                    <div class="col-md-2 ms-auto d-flex justify-content-end">
                        <button class="btn btn-primary">
                            <i class="bi bi-search"></i> Search
                        </button>
                    </div>

                </form>

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
                            @if (strtolower($log->status) == 'masuk')
                                <span class="badge bg-success">Masuk</span>
                            @elseif (strtolower($log->status) == 'keluar')
                                <span class="badge bg-danger">Keluar</span>
                            @else
                                <span class="badge bg-secondary">{{ $log->status }}</span>
                            @endif
                        </td>
                        <td class="py-3 px-2">
                            {{ \Carbon\Carbon::parse($log->created_at)->format('d-m-Y H:i:s') }}
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
