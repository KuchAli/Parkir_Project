@extends('layouts.main')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5>Add Vehicle Data</h5>
        </div>

        <div class="card-body m-5">
            <form action="{{ route('admin.kendaraan.store') }}" method="POST">
                @csrf

                {{-- Select User --}}
                <div class="mb-3">
                    <label class="form-label">Owner</label>
                    <select name="user_id" class="form-select @error('user_id') is-invalid @enderror">
                        <option value="">-- Select User --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->user_id }}"
                                {{ old('user_id') == $user->user_id ? 'selected' : '' }}>
                                {{ $user->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Plate Number --}}
                <div class="mb-3">
                    <label class="form-label">Plate Number
                        <small class="text-muted">(fill in according to your number plate)</small>
                    </label>
                    <input type="text" name="plat_nomor"
                        class="form-control @error('plat_nomor') is-invalid @enderror"
                        value="{{ old('plat_nomor') }}">
                    @error('plat_nomor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Vehicle Type--}}
                <div class="mb-3">
                    <label class="form-label">Vehicle Type
                        <small class="text-muted">(select the type of your vehicle)</small>
                    </label>
                    <select name="jenis_kendaraan" class="form-select @error('jenis_kendaraan') is-invalid @enderror">
                        <option value="mobil">Mobil</option>
                        <option value="motor">Motor</option>
                        <option value="truk">Truk</option>
                        <option value="bus">Bus</option>
                    </select>
                    @error('jenis_kendaraan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Color --}}
                <div class="mb-3">
                    <label class="form-label">Color</label>
                    <input type="text" name="warna"
                        class="form-control @error('warna') is-invalid @enderror"
                        value="{{ old('warna') }}">
                    @error('warna')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                

                {{-- Aksi --}}
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.kendaraan.index') }}" class="btn btn-secondary me-2">Kembali</a>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
