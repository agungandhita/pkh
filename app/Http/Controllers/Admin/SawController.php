<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilSaw;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Warga;
use App\Services\SawService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class SawController extends Controller
{
    public function index()
    {
        $wargaCount = Warga::query()->count();
        $kriteriaAktifCount = Kriteria::query()->where('status', true)->count();
        $hasilCount = HasilSaw::query()->count();

        return view('admin.saw.index', compact('wargaCount', 'kriteriaAktifCount', 'hasilCount'));
    }

    public function hitung(SawService $saw): RedirectResponse
    {
        $kriteriaIds = Kriteria::query()->where('status', true)->pluck('id');
        $kriteriaCount = (int) $kriteriaIds->count();

        if ($kriteriaCount === 0) {
            return redirect()->route('admin.saw.index')->with('error', 'Tidak ada kriteria aktif.');
        }

        $wargaIds = Warga::query()->pluck('id');

        if ($wargaIds->isEmpty()) {
            return redirect()->route('admin.saw.index')->with('error', 'Belum ada data warga.');
        }

        $filledByWarga = Penilaian::query()
            ->select('warga_id', DB::raw('count(*) as cnt'))
            ->whereIn('kriteria_id', $kriteriaIds)
            ->whereIn('warga_id', $wargaIds)
            ->groupBy('warga_id')
            ->pluck('cnt', 'warga_id');

        $incomplete = 0;
        foreach ($wargaIds as $wargaId) {
            if ((int) ($filledByWarga[$wargaId] ?? 0) < $kriteriaCount) {
                $incomplete++;
            }
        }

        if ($incomplete > 0) {
            return redirect()
                ->route('admin.penilaian.index')
                ->with('error', 'Penilaian belum lengkap untuk '.$incomplete.' warga.');
        }

        $saw->calculate();

        return redirect()->route('admin.hasil.index')->with('success', 'Perhitungan SAW selesai.');
    }

    public function hasil()
    {
        $hasil = HasilSaw::query()
            ->with('warga:id,nik,nama')
            ->orderBy('peringkat')
            ->paginate(20);

        return view('admin.hasil.index', compact('hasil'));
    }
}
