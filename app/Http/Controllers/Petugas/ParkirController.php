<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Picqer\Barcode\BarcodeGeneratorPNG;

class ParkirController extends Controller
{
    public function struk(Transaksi$transaksi)
    {
        $parkir=$transaksi->load(['user', 'area', 'tarif','kendaraan']);

        $generator = new BarcodeGeneratorPNG();

        $barcode = base64_encode(
            $generator->getBarcode('PKR-'.$parkir->id_parkir, $generator::TYPE_CODE_128)
        );

        return view('petugas.parkir.struk', compact('parkir','barcode','generator'));
    }
}
