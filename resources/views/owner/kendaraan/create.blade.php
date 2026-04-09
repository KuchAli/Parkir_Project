@extends('layouts.main')
@section('title', 'My Vehicle - Add New Vehicle')

@section('content')
<div class="container me-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5>Add Vehicle Data</h5>
        </div>

        <div class="card-body m-5 ">
            <form action="{{ route('owner.kendaraan.store') }}" method="POST">
                @csrf

            

                {{-- Plate Number --}}
                <div class="mb-3">
                    <label class="form-label">Plate Number
                        <small class="text-muted">(fill in according to your number plate)</small>
                    </label>
                    <input type="text" name="plat_nomor"
                        class="form-control @error('plat_nomor') is-invalid @enderror"
                        value="{{ old('plat_nomor') }}" placeholder=" B 1234 ABC">
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
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('owner.kendaraan.index') }}" class="btn btn-secondary me-2">Kembali</a>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
