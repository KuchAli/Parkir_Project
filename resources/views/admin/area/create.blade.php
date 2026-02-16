@extends('layouts.main')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Tambah Data Peminjaman</h5>
        </div>

        <div class="card-body m-5">
            <form action="{{ route('admin.loans.store') }}" method="POST">
                @csrf

                {{-- USER --}}
                <div class="mb-3">
                    <label class="form-label">User</label>
                    <select name="user_id" class="form-select" required>
                        <option value="">-- Pilih User --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }} (ID: {{ $user->id }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- LOAN DATE --}}
                <div class="mb-3">
                    <label class="form-label">Loan Date</label>
                    <input type="date" name="loan_date" class="form-control" required>
                </div>

                {{-- RETURN DEADLINE --}}
                <div class="mb-3">
                    <label class="form-label">Return Deadline</label>
                    <input type="date" name="return_deadline" class="form-control" required>
                </div>

                {{-- BUTTON --}}
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.loans.index') }}" class="btn btn-secondary me-2">
                        Kembali
                    </a>
                    <button class="btn btn-primary">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
