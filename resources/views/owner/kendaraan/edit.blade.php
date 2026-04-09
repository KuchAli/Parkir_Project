@extends('layouts.main')

@section('content')
<div class="container me-4">
    <div class="card shadow-sm justify-content-center">
        <div class="card-header">
            <h5>Edit Vehicle Data </h5>
        </div>

        <div class="card-body m-5">
            <form action="{{ route('owner.kendaraan.update', $kendaraan->id_kendaraan) }}" method="POST">
                @csrf
                @method('PUT')
                {{-- Plate Number --}}
                <div class="mb-3">
                    <label class="form-label">Plate Number</label>
                    <input type="text" name="plat_nomor"
                        class="form-control @error('plat_nomor') is-invalid @enderror"
                        value="{{ old('plat_nomor', $kendaraan->plat_nomor) }}">
                    @error('plat_nomor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Color   --}}
                <div class="mb-3">
                    <label class="form-label">Color</label>
                    <input type="text" name="warna"
                        class="form-control @error('warna') is-invalid @enderror"
                        value="{{ old('warna', $kendaraan->warna) }}">
                    @error('warna')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

               

                {{-- Aksi --}}
                <div class="d-flex justify-content-end  pt-5">
                    <a href="{{ route('owner.kendaraan.index') }}" class="btn btn-secondary me-2">Back</a>
                    <button class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
