@extends('layouts.main')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Edit Area</h5>
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

            <form action="{{ route('admin.area.update', $area->id_area) }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Area Name</label>
                    <input type="text" name="nama_area" class="form-control @error('nama_area') is-invalid @enderror" value="{{ old('nama_area', $area->nama_area) }}" required>
                    @error('nama_area')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                <div class="mb-3">
                    <label class="form-label">Capacity</label>
                    <input type="number" name="kapasitas" class="form-control @error('kapasitas') is-invalid @enderror" value="{{ old('kapasitas', $area->kapasitas) }}" required>
                    @error('kapasitas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.area.index') }}"
                       class="btn btn-secondary">
                        Back
                    </a>
                    <button type="submit"
                            class="btn btn-success">
                        Update
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
