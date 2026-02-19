@extends('layouts.main')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Activity Logs</h5>
        </div>

        <div class="card-body m-5">

            @if (session('success'))
                <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 text-green-700">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card-container border-0 rounded mb-4">
                <!-- Search & Sort -->
                <form method="GET" action="{{ route('admin.logs.index') }}" 
                    class="row g-3 align-items-end">

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
            <!-- Table -->
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
</div>
@endsection
