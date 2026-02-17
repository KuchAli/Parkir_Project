@extends('layouts.main')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">User Management</h5>
            <a href="{{ route('admin.users.create') }}" class="btn btn-secondary btn-sm">+ Add User</a>
        </div>

        <div class="card-body m-5">
            @if (session('success'))
                <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 text-green-700">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card border-0 rounded mb-4 outline-none justify-content-between d-flex">
                <!-- Search & Sort -->
                <form method="GET" action="{{ route('admin.users.index') }}" 
                    class="row g-3 align-items-end">

                    <div class="col-md-4">
                        <label for="search" class="form-label mb-1">Search</label>
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
                            <option value="az" {{ request('sort')=='az'?'selected':'' }}>A - Z</option>
                            <option value="za" {{ request('sort')=='za'?'selected':'' }}>Z - A</option>
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
                    <thead class="border" style="border-radius: 20px; ">
                        <tr>
                            <th class="py-3 px-2 text-center">No</th>
                            <th class="py-3 px-2 text-center">Name</th>
                            <th class="py-3 px-2 text-center">Username</th>
                            <th class="py-3 px-2 text-center">Role</th>
                            <th class="py-3 px-2 text-center">Created</th>
                            <th class="py-3 px-2 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-700">
                        @forelse ($users as $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3 px-2">{{ $loop->iteration }}</td>
                            <td class="py-3 px-2 font-medium">{{ $user->nama_lengkap }}</td>
                            <td class="py-3 px-2 text-gray-600">{{ $user->username }}</td>

                            <td class="py-3 px-2">
                                @php $role = strtolower($user->role); @endphp

                                @if ($role === 'admin')
                                    <span class="status-admin">Admin</span>
                                @elseif ($role === 'petugas')
                                    <span class="status-petugas">Petugas</span>
                                @elseif ($role === 'owner')
                                    <span class="status-owner">Owner</span>
                                @else
                                    <span class="status-unknown">Unknown</span>
                                @endif
                            </td>

                            <td class="py-3 px-2 text-gray-500">
                                {{ $user->created_at->format('d-m-Y') }}
                            </td>

                            <td class="py-3 px-2 text-center space-x-2">
                                <a href="{{ route('admin.users.edit', $user->user_id) }}"
                                   class="btn-action btn-edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('admin.users.destroy', $user->user_id) }}"
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Yakin hapus data?')"
                                        class="btn btn-action btn-delete" >
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-6 text-center text-gray-400">
                                User data is not available
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class=" mt-3">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
