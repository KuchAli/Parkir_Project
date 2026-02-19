@extends('layouts.main')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Vehicle Management</h5>
            <a href="{{ route('admin.kendaraan.create') }}" class="btn btn-secondary btn-sm">
                + Add Vehicle
            </a>
        </div>

        <div class="card-body m-5">
            @if (session('success'))
                <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 text-green-700">
                    {{ session('success') }}
                </div>
            @endif
             <div class="card-container border-0 rounded mb-4">
                <!-- Search & Sort -->
                <form method="GET" action="{{ route('admin.kendaraan.index') }}" 
                    class="row g-3 align-items-end">

                    <div class="col-md-4">
                        <label for="search" class="form-label mb-1 ">Search</label>
                        <input 
                            type="text" 
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search name or username..."
                            class="form-control"
                        >
                    </div>

                    <div class="col-md-2">
                        <label for="sort" class="form-label mb-1">Sort By</label>
                        <select name="sort" onchange="this.form.submit()"
                                class="form-select">
                            <option value="newest" {{ request('sort')=='newest'?'selected':'' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort')=='oldest'?'selected':'' }}>Terlama</option>
                            <option value="plat_nomor" {{ request('sort')=='plat_nomor'?'selected':'' }}>Plat Nomor</option>
                            <option value="jenis_kendaraan" {{ request('sort')=='jenis_kendaraan'?'selected':'' }}>Jenis Kendaraan</option>
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
                            <th class="py-3 px-2 text-center">Plate Number</th>
                            <th class="py-3 px-2 text-center">Vehicle Type</th>
                            <th class="py-3 px-2 text-center">Color</th>
                            <th class="py-3 px-2 text-center">Owner</th>
                            <th class="py-3 px-2 text-center">Created</th>
                            <th class="py-3 px-2 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-700">
                        @forelse ($kendaraan as $vehicle)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3 px-2">{{ $loop->iteration }}</td>
                            <td class="py-3 px-2 font-medium">
                                {{ $vehicle->plat_nomor ?? '-' }}
                            </td>
                            <td class="py-3 px-2">
                                {{ $vehicle->jenis_kendaraan ? ucfirst($vehicle->jenis_kendaraan) : '-' }}
                            </td>
                            <td class="py-3 px-2">
                                {{ $vehicle->warna ?? '-' }}
                            </td>
                            <td class="py-3 px-2">
                                <span class="status-owner">
                                    {{ $vehicle->user->nama_lengkap ?? '-' }}
                                </span>
                            </td>
                            <td class="py-3 px-2">
                                {{ $vehicle->created_at->format('d-m-y') }}
                            </td>
                            <td class="py-3 px-2 text-center space-x-2">
                                <a href="{{ route('admin.kendaraan.edit', $vehicle->id_kendaraan) }}"
                                   class="btn-action btn-edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('admin.kendaraan.destroy', $vehicle->id_kendaraan) }}"
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Yakin hapus data?')"
                                        class="btn btn-delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-6 text-center text-gray-400">
                                Vehicle data is not available
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
                <div class="mt-3">
                    {{ $kendaraan->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
