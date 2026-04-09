@extends('layouts.main')
@section('title', 'Parking Application - Reservasi Form')
@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h4 class="text-muted">Make a Booking</h4>
                        <hr>
                        <form method="POST" action="{{ route('owner.reservasi.store') }}">
                            @csrf
                           
                            <div class="mb-3">
                                <label>Vehicle</label>
                                <select name="id_kendaraan" class="form-control">
                                    @foreach($kendaraans as $kendaraan)
                                        <option value="{{ $kendaraan->id_kendaraan }}">{{ $kendaraan->plat_nomor }} - {{ $kendaraan->user->nama_lengkap }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Parking Area</label>
                                <select name="id_area" class="form-control">
                                    @foreach($areas as $area)
                                        <option value="{{ $area->id_area }}">{{ $area->nama_area }} -- {{ $area->kapasitas }} slots available</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Entry Time</label>
                                <input type="datetime-local" name="waktu_masuk" class="form-control">
                            </div>


                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary me-2" type="submit">Book Now</button>
                                <button class="btn btn-secondary" type="button" onclick="window.history.back()">Cancel</button>
                            </div>
                        </form>
                        
                    </div>
                </div> 
            </div>
        </div>
    </div>
@endsection