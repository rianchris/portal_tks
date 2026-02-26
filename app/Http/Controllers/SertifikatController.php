<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;

class SertifikatController extends Controller
{
    public function download($no_sertifikat)
    {
        $peserta = Peserta::with('batch.sertifikat')
            ->where('no_sertifikat', $no_sertifikat)
            ->firstOrFail();




        // dd($peserta);

        $pdf = Pdf::loadView('sertifikat.pdf', [
            'peserta' => $peserta,
        ])->setPaper('a4', 'potrait');

        return $pdf->stream('sertifikat-' . $peserta->nama . '.pdf');
    }
}
