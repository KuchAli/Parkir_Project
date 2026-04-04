@extends('layouts.main')
@section('title', 'My Vehicles')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
              <div class="row mb-4">

                <div class="col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h4 class="text-muted">My Vehicle</h4>
                            <hr>
                             @forelse($kendaraan as $item)
                                <p class="fw-bold">Plate Number:<h3 class="fw-bold">{{ $item->plat_nomor ?? 'N/A' }}</h3></p>
                                <p class="fw-bold">Color:<h3 class="fw-bold">{{ ucfirst($item->warna) ?? 'N/A' }}</h3></p>
                                <button class="btn btn-primary">
                                    <a href="{{ route('owner.kendaraan.edit', $item->id_kendaraan) }}" class="text-white text-decoration-none"><i class="bi bi-pencil"></i> Edit Vehicle</a>
                                </button>
                             @empty
                                <p class="text-muted">You haven't added any vehicles yet.</p>
                                <button class="btn btn-secondary">
                                    <a href="{{ route('owner.kendaraan.create') }}" class="text-white text-decoration-none"><i class="bi bi-plus"></i> Add Vehicle</a>
                                </button>
                             @endforelse
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection