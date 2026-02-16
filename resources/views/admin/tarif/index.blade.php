@extends('layouts.main')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Tarif Management</h5>
            <a href="{{ route('admin.tarif.create') }}" class="btn btn-primary btn-sm">
                + Add Tarif
            </a>
        </div>

        <div class="card-body m-5">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Vehicle Type</th>
                            <th>Tarif Rate</th>
                            <th>Creation</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tarifs as $t)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $t->jenis_kendaraan }}</td>
                                <td>{{ $t->tarif_per_jam }}</td>
                                <td>{{ $t->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.tarif.edit', $t->id_tarif) }}"
                                       class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('admin.tarif.destroy', $t->id_tarif) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Sure Delete Tarif?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    No tarif data available
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
