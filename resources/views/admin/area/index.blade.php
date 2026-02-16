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
                        @forelse ($areas as $area)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $area->nama_area }}</td>
                                <td>
                                    {{ $area->kapasitas }}
                                </td>

                                <td>
                                    {{ $area->terisi }}
                                </td>

                                <td>
                                    {{ $area->created_at
                                        ? \Carbon\Carbon::parse($area->created_at)->format('d-m-Y')
                                        : '-' }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.area.edit', $area->id_area) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.area.destroy', $area->id_area) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this data?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">
                                    Area data is not available
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
