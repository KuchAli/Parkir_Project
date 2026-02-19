@extends('layouts.main')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Add Area</h5>
        </div>

        <div class="card-body m-5">
            <form action="{{ route('admin.area.store') }}" method="POST">
                @csrf

                {{-- Name Area --}}
                <div class="mb-3">
                    <label class="form-label">Area Name</label>
                    <input type="text" name="nama_area" class="form-control" required>
                </div>

                {{-- Capacity --}}
                <div class="mb-3">
                    <label class="form-label">Capacity</label>
                    <input type="number" name="kapasitas" class="form-control" required>
                </div>
               

                {{-- BUTTON --}}
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.area.index') }}" class="btn btn-secondary me-2">
                        Back
                    </a>
                    <button class="btn btn-primary">
                        Save
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
