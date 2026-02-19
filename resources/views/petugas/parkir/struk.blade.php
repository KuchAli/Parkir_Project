@extends('layouts.main')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Struk Parkir</title>
    <style>
        body {
            font-family: monospace;
            width: 300px; /* cocok untuk thermal 58mm */
            margin: 0 auto;
        }

        .center {
            text-align: center;
        }

        .line {
            border-top: 1px dashed #000;
            margin: 5px 0;
        }

        .small {
            font-size: 12px;
        }

        @media print {
            body {
                margin: 0;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="center">
        <h3>PARKIRKU</h3>
        <div class="small">
           {{ $parkir->area->nama_area }}
        </div>
    </div>

    <div class="line"></div>

    <div class="small">
        No Transaksi : {{ $parkir->id }} <br>
        Petugas      : {{ $parkir->user?->nama_lengkap ?? '-' }} <br>
        --------------------------------<br>
        Plat         : {{ $parkir->kendaraan->plat_nomor ?? '-' }} <br>
        Jenis        : {{ $parkir->kendaraan->jenis_kendaraan ?? '-' }} <br>
        --------------------------------<br>
        Masuk        : {{ $parkir->waktu_masuk }} <br>
        Keluar       : {{ $parkir->waktu_keluar }} <br>
        --------------------------------<br>
        Durasi       : {{ $parkir->durasi }} Jam <br>
        Tarif/Jam    : Rp {{ number_format($parkir->tarif->tarif_per_jam) }} <br>
        --------------------------------<br>
    </div>

    <div class="center">
        <strong>Total Bayar</strong><br>
        <h3>Rp {{ number_format($parkir->biaya_total) }}</h3>
    </div>

    <div class="line"></div>

    <div class="center small">
        Terima Kasih<br>
        Simpan Struk Ini
    </div>

    <a href="{{ route('petugas.parkir.struk', $parkir->id_parkir) }}" target="_blank">
        <button class="btn btn-primary mt-3">Cetak Struk</button>
    </a>

</body>
</html>


@endsection