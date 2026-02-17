@extends('layouts.main')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5>Edit Pengguna</h5>
        </div>

        <div class="card-body">

            {{-- ERROR VALIDASI --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.users.update', $user->user_id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- NAMA --}}
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input
                        type="text"
                        name="nama_lengkap"
                        class="form-control"
                        value="{{ old('nama_lengkap', $user->nama_lengkap) }}"
                        required
                    >
                </div>

                {{-- EMAIL --}}
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input
                        type="text"
                        name="username"
                        class="form-control"
                        value="{{ old('username', $user->username) }}"
                        required
                    >
                </div>

                {{-- PASSWORD (AMAN + TOGGLE) --}}
                <div class="mb-3">
                    <label class="form-label">
                        Password
                        <small class="text-muted">(Kosongkan jika tidak diubah)</small>
                    </label>

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


                {{-- STATUS AKTIF --}}
                <div class="mb-3">
                    <label class="form-label">Status Active</label>
                    <select name="status_aktif" class="form-select" required>
                        <option value="1" {{ old('status_aktif', $user->status_aktif) == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('status_aktif', $user->status_aktif) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

                {{-- BUTTON --}}
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-outline-success ms-2">
                        Update
                    </button>
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
