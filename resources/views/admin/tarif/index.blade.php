@extends('layouts.main')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Tarif Management</h5>
            <a href="{{ route('admin.tarif.create') }}" class="btn btn-secondary btn-sm">
                + Add Tarif
            </a>
        </div>

        <div class="card-body m-5">

             @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Table -->
            <div class="overflow-x-auto ms-2">
                <table class="attendance-table border text-center align-middle">
                    <thead class="border">
                        <tr>
                            <th class="py-3 px-2 text-center">No</th>
                            <th class="py-3 px-2 text-center">Vehicle Type</th>
                            <th class="py-3 px-2 text-center">Tarif Rate</th>
                            <th class="py-3 px-2 text-center">Updated</th>
                            <th class="py-3 px-2 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-700">
                        @forelse ($tarifs as $t)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3 px-2">{{ $loop->iteration }}</td>

                            <td class="py-3 px-2 font-medium">
                                {{ ucfirst($t->jenis_kendaraan) }}
                            </td>

                            <td class="py-3 px-2">
                                Rp {{ number_format($t->tarif_per_jam, 0, ',', '.') }}
                            </td>

                            <td class="py-3 px-2">
                                {{ $t->updated_at->format('d-m-y') }}
                            </td>

                            <td class="py-3 px-2 text-center space-x-2">
                                <a href="{{ route('admin.tarif.edit', $t->id_tarif) }}"
                                   class="btn-action btn-edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('admin.tarif.destroy', $t->id_tarif) }}"
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Sure delete tarif?')"
                                        class="btn btn-delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-6 text-center text-gray-400">
                                Tarif data is not available
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
