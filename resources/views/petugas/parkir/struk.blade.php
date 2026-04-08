<!DOCTYPE html>
<html>
<head>
    <title>Struk Parkir</title>

    <style>
        @page {
            size: 58mm auto;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: monospace;
            font-size: 12px;
        }

        .struk {
            width: 58mm;
            padding: 6px;
        }

        .center {
            text-align: center;
        }

        .line {
            border-top: 1px dashed #000;
            margin: 6px 0;
        }

        .row {
            display: flex;
            justify-content: space-between;
        }

        .label {
            flex: 1;
        }

        .value {
            text-align: right;
        }

        h3 {
            margin: 2px 0;
            font-size: 16px;
        }

        .title {
            font-weight: bold;
            letter-spacing: 1px;
        }

        .total {
            font-size: 16px;
            font-weight: bold;
        }

        .small {
            font-size: 11px;
        }

        .no-print {
            margin-top: 10px;
            text-align: center;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">

<div class="struk">

    <!-- HEADER -->
    <div class="center">
        <div class="title">PARKIRKU</div>
        <div class="small">{{ $parkir->area->nama_area }}</div>
    </div>

    <div class="line"></div>

    <!-- INFO TRANSAKSI -->
    <div class="row">
        <div>No</div>
        <div class="value">PKR-{{ str_pad($parkir->id_parkir, 3, '0', STR_PAD_LEFT) }}</div>
    </div>

    <div class="row">
        <div>Petugas</div>
        <div class="value">{{ $parkir->user?->nama_lengkap ?? '-' }}</div>
    </div>

    <div class="line"></div>

    <!-- KENDARAAN -->
    <div class="row">
        <div>Plat</div>
        <div class="value">{{ $parkir->kendaraan->plat_nomor ?? '-' }}</div>
    </div>

    <div class="row">
        <div>Jenis</div>
        <div class="value">{{ $parkir->kendaraan->jenis_kendaraan ?? '-' }}</div>
    </div>

    <div class="line"></div>

    <!-- WAKTU -->
    <div class="row">
        <div>Masuk</div>
        <div class="value">{{ $parkir->waktu_masuk }}</div>
    </div>

    <div class="row">
        <div>Keluar</div>
        <div class="value">{{ $parkir->waktu_keluar ?? '-' }}</div>
    </div>

    <div class="line"></div>

    <!-- TARIF -->
    <div class="row">
        <div>Durasi</div>
        <div class="value">{{ $parkir->durasi ?? '-' }} Jam</div>
    </div>

    <div class="row">
        <div>Tarif/Jam</div>
        <div class="value">Rp {{ number_format($parkir->tarif->tarif_per_jam ?? 0,0,',','.') }}</div>
    </div>

    <div class="line"></div>

    <!-- TOTAL -->
    <div class="row total">
        <div>TOTAL</div>
        <div class="value">Rp {{ number_format($parkir->biaya_total ?? 0,0,',','.') }}</div>
    </div>

    <div class="line"></div>

        <!-- BARCODE -->
       <div class="center" style="margin-top:8px;">
            <img src="data:image/png;base64,{{ $barcode }}" style="width:100%; height:50px;">
            <div class="small">
                PKR-{{ str_pad($parkir->id_parkir, 3, '0', STR_PAD_LEFT) }}
            </div>
        </div>

    <div class="line"></div>

    <!-- FOOTER -->
    <div class="center small">
        Terima Kasih <br>
        Simpan Struk Ini
    </div>

    <!-- BUTTON -->
    <div class="no-print">
        <a href="{{ route('petugas.transaksi.index') }}" class="btn btn-secondary btn-sm">
            Kembali
        </a>
    </div>

</div>

</body>
</html>