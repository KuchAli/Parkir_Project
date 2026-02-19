@extends('layouts.main')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Area Management</h5>
            <a href="{{ route('admin.area.create') }}" class="btn btn-secondary btn-sm">
                + Add Area
            </a>
        </div>

        <div class="card-body m-5">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <div class="card-container border-0 rounded mb-4">
                <!-- Search & Sort -->
                <form method="GET" action="{{ route('admin.area.index') }}" 
                    class="row g-3 align-items-end">

                    <div class="col-md-4">
                        <label for="search" class="form-label mb-1 ">Search</label>
                        <input 
                            type="text" 
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search area ..."
                            class="form-control"
                        >
                    </div>

                    <div class="col-md-2">
                        <label for="sort" class="form-label mb-1">Sort By</label>
                        <select name="sort" onchange="this.form.submit()"
                                class="form-select">
                            <option value="nama_area" {{ request('sort')=='nama_area'?'selected':'' }}>Area Name</option>
                            <option value="kapasitas" {{ request('sort')=='kapasitas'?'selected':'' }}>Capacity</option>
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
                            <th class="py-3 px-2 text-center">Area Name</th>
                            <th class="py-3 px-2 text-center">Capacity</th>
                            <th class="py-3 px-2 text-center">Amount</th>
                            <th class="py-3 px-2 text-center">Created</th>
                            <th class="py-3 px-2 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-700">
                        @forelse ($areas as $area)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3 px-2">{{ $loop->iteration }}</td>

                            <td class="py-3 px-2 font-medium">
                                {{ $area->nama_area }}
                            </td>

                            <td class="py-3 px-2">
                                {{ $area->kapasitas }}
                            </td>

                            <td class="py-3 px-2">
                                {{ $area->terisi }}
                            </td>

                            <td class="py-3 px-2">
                                {{ $area->created_at 
                                    ? \Carbon\Carbon::parse($area->created_at)->format('d-m-y') 
                                    : '-' }}
                            </td>

                            <td class="py-3 px-2 text-center space-x-2">
                                <a href="{{ route('admin.area.edit', $area->id_area) }}"
                                   class="btn-action btn-edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('admin.area.destroy', $area->id_area) }}"
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Are you sure delete this area?')"
                                        class="btn btn-delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-6 text-center text-gray-400">
                                Area data is not available
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $areas->links() }}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
