<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilSaw;
use App\Models\Kriteria;
use App\Models\Pengaturan;
use App\Models\Penilaian;
use App\Models\Warga;

class DashboardController extends Controller
{
    public function index()
    {
        $wargaCount = Warga::query()->count();
        $kriteriaAktifCount = Kriteria::query()->where('status', true)->count();
        $penilaianCount = Penilaian::query()->count();
        $hasilCount = HasilSaw::query()->count();
        $threshold = Pengaturan::query()->value('threshold_kelayakan') ?? 0.6;

        return view('admin.dashboard.index', compact(
            'wargaCount',
            'kriteriaAktifCount',
            'penilaianCount',
            'hasilCount',
            'threshold',
        ));
    }
}
