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

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- NAMA --}}
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $user->name) }}"
                        required
                    >
                </div>

                {{-- EMAIL --}}
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email', $user->email) }}"
                        required
                    >
                </div>

                {{-- PASSWORD (AMAN + TOGGLE) --}}
                <div class="mb-3">
                    <label class="form-label">
                        Password
                        <small class="text-muted">(Kosongkan jika tidak diubah)</small>
                    </label>

                    <div class="input-group">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            autocomplete="new-password"
                        >
                        <button
                            class="btn btn-outline-secondary"
                            type="button"
                            onclick="togglePassword()"
                            title="Tampilkan / Sembunyikan Password"
                        >
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                {{-- ROLE --}}
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role_id" class="form-select" required>
                        <option value="">-- Pilih Role --</option>
                        @foreach ($roles as $role)
                            <option
                                value="{{ $role->id }}"
                                {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}
                            >
                                {{ ucfirst($role->role_name) }}
                            </option>
                        @endforeach
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
