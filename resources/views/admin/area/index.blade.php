@extends('layouts.main')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Area Management</h5>
            <a href="{{ route('admin.area.create') }}" class="btn btn-primary btn-sm">
                + Add Area
            </a>
        </div>

        <div class="card-body m-5">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Area Name</th>
                            <th>Capacity</th>
                            <th>Amount</th>
                            <th>Creation</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($peminjamans as $peminjaman)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $peminjaman->user->name }} (ID: {{ $peminjaman->user_id }})</td>

                                <td>
                                    {{ $peminjaman->approvedBy->name ?? '-' }}
                                </td>

                                <td>
                                    {{ $peminjaman->loan_date
                                        ? \Carbon\Carbon::parse($peminjaman->loan_date)->format('d-m-Y')
                                        : '-' }}
                                </td>

                                <td>
                                    {{ $peminjaman->return_deadline
                                        ? \Carbon\Carbon::parse($peminjaman->return_deadline)->format('d-m-Y')
                                        : '-' }}
                                </td>
                                <td>
                                    @php
                                        $status = strtolower($peminjaman->status);
                                    @endphp

                                    @if ($status === 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif ($status === 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif ($status === 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @elseif ($status === 'returned')
                                        <span class="badge bg-primary">Returned</span>
                                    @else
                                        <span class="badge bg-secondary">Unknown</span>
                                    @endif
                                </td>

                                <td>
                                    @php
                                        $status = strtolower($peminjaman->status);
                                    @endphp
                                    {{-- SETUJUI --}}
                                    @if ($peminjaman->status === 'pending')
                                        <form action="{{ route('admin.loans.approve', $peminjaman->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-success btn-sm">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                        </form>

                                        {{-- TOLAK --}}
                                        <form action="{{ route('admin.loans.reject', $peminjaman->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-danger btn-sm">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </form>
                                    @endif

                                    {{-- SELESAIKAN --}}
                                    @if ($peminjaman->status === 'approved')
                                        <form action="{{ route('admin.loans.returned', $peminjaman->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-primary btn-sm">
                                                <i class="bi bi-box-arrow-in-down"></i>
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <form action="{{ route('admin.loans.destroy', $peminjaman->id) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin hapus data?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">
                                    Data peminjaman belum tersedia
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
