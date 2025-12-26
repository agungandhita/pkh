<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilSaw;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\HttpFoundation\Response;

class LaporanController extends Controller
{
    public function index()
    {
        $hasil = HasilSaw::query()
            ->with('warga:id,nik,nama')
            ->orderBy('peringkat')
            ->paginate(20);

        return view('admin.laporan.index', compact('hasil'));
    }

    public function pdf(): Response
    {
        $hasil = HasilSaw::query()
            ->with('warga:id,nik,nama')
            ->orderBy('peringkat')
            ->get();

        $html = view('admin.laporan.pdf', compact('hasil'))->render();

        $options = new Options;
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'laporan-hasil-saw-'.now()->format('Ymd-His').'.pdf';
        $pdf = $dompdf->output();

        return response($pdf)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }
}
