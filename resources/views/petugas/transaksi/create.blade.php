@extends('layouts.main')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5>Add Transaction Data</h5>
        </div>

        <div class="card-body m-5">
            <form action="{{ route('petugas.transaksi.masuk') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Kendaraan</label>
                    <select name="id_kendaraan" class="form-control" required>
                        @foreach($kendaraan as $k)
                            <option value="{{ $k->id_kendaraan }}">{{ $k->plat_nomor }} — {{ $k->user->nama_lengkap }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Area Parkir</label>
                    <select name="id_area" class="form-control" required>
                        @foreach($area as $a)
                            @php
                                $sisa_slot = $a->kapasitas - $a->terisi;  // Hitung sisa slot
                            @endphp
                            <option value="{{ $a->id_area }}" 
                                {{ $sisa_slot <= 0 ? 'disabled' : '' }}>
                                {{ $a->nama_area }} 
                                (Sisa: {{ $sisa_slot }} / Total: {{ $a->kapasitas }})
                                @if($sisa_slot <= 0)
                                    - [PENUH]
                                @endif
                            </option>
                        @endforeach
                    </select>
                    
                    @php
                        $totalAreaTersedia = $area->sum(function($a) { 
                            return $a->kapasitas - $a->terisi; 
                        });
                    @endphp
                    
                    @if($totalAreaTersedia <= 0)
                        <small class="text-danger">Semua area parkir penuh!</small>
                    @endif
                </div>

                <button type="submit" class="btn btn-dark w-100">Masuk Parkir</button>
            </form>
        </div>
    </div>
</div>
@endsection