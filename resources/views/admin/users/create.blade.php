@extends('layouts.main')


@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5>Tambah Pengguna</h5>
        </div>


        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}" required>
                </div>


                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                </div>


                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="d-flex">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control rounded-start me-3"
                            autocomplete="new-password"
                        >
                        <button
                            class="btn btn-secondary rounded-end"
                            type="button"
                            onclick="togglePassword()"
                        >
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>  
                </div>


                <div class="mb-3">
                    <label class="form-label">Status Active</label>
                    <select name="status_aktif" class="form-select" required>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>


                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary ms-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- SCRIPT TOGGLE PASSWORD --}}
<script>
function togglePassword() {
    const input = document.getElementById('password');
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>

@endsection