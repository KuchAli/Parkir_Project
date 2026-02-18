@extends('layouts.main')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5>Edit Vehicle Data </h5>
        </div>

        <div class="card-body m-5">
            <form action="{{ route('admin.kendaraan.update', $kendaraan->id_kendaraan) }}" method="POST">
                @csrf
                @method('PUT')


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
                    <a href="{{ route('admin.kendaraan.index') }}" class="btn btn-secondary me-2">Back</a>
                    <button class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
