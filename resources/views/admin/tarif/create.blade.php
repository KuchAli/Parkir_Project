@extends('layouts.main')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Add Tarif Data</h5>
        </div>

        <div class="card-body m-5">

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

            <form action="{{ route('admin.tarif.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Vehicle Type</label>
                    <select name="jenis_kendaraan" class="form-select @error('jenis_kendaraan') is-invalid @enderror">
                        <option value="mobil" {{ old('jenis_kendaraan') == 'mobil' ? 'selected' : '' }}>Mobil</option>
                        <option value="motor" {{ old('jenis_kendaraan') == 'motor' ? 'selected' : '' }}>Motor</option>
                        <option value="truk" {{ old('jenis_kendaraan') == 'truk' ? 'selected' : '' }}>Truk</option>
                        <option value="bus" {{ old('jenis_kendaraan') == 'bus' ? 'selected' : '' }}>Bus</option>
                    </select>
                    @error('jenis_kendaraan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Tarif Rate</label>
                    <input type="number" name="tarif_per_jam" class="form-control @error('tarif_per_jam') is-invalid @enderror" value="{{ old('tarif_per_jam') }}" required>
                    @error('tarif_per_jam')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.tarif.index') }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>
                    <button type="submit"
                            class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
