@extends('layouts.main')
@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Activity Logs</h5>
        </div>

        <div class="card-body m-5">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle table-striped">
                    <thead class="table-light align-middle">
                        <tr class="text-center">
                            <th>No</th>
                            <th>User</th>
                            <th>Activity</th>
                            <th>Timestamp</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @forelse ($logs as $log)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $log->user->nama_lengkap ?? 'Unknown User' }}</td>
                                <td>{{ $log->aktivitas }}</td>
                                <td>{{ \Carbon\Carbon::parse($log->waktu_aktivitas)->format('d-m-Y H:i:s') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No activity logs available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection