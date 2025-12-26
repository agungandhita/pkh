<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Warga;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenilaianController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $kriteriaAktifIds = Kriteria::query()->where('status', true)->pluck('id');
        $kriteriaAktifCount = (int) $kriteriaAktifIds->count();

        $warga = Warga::query()
            ->when($q !== '', function ($query) use ($q) {
                $query
                    ->where('nik', 'like', '%'.$q.'%')
                    ->orWhere('nama', 'like', '%'.$q.'%');
            })
            ->withCount([
                'penilaian as penilaian_count' => fn ($q) => $q->whereIn('kriteria_id', $kriteriaAktifIds),
            ])
            ->orderBy('nama')
            ->paginate(15)
            ->withQueryString();

        return view('admin.penilaian.index', compact('warga', 'q', 'kriteriaAktifCount'));
    }

    public function edit(Warga $warga)
    {
        $kriteria = Kriteria::query()
            ->where('status', true)
            ->with(['subKriteria' => fn ($q) => $q->orderBy('nilai')])
            ->orderBy('kode_kriteria')
            ->get();

        $existing = Penilaian::query()
            ->where('warga_id', $warga->id)
            ->get()
            ->keyBy('kriteria_id');

        return view('admin.penilaian.edit', compact('warga', 'kriteria', 'existing'));
    }

    public function update(Request $request, Warga $warga): RedirectResponse
    {
        $kriteriaIds = Kriteria::query()->where('status', true)->pluck('id')->all();

        if (count($kriteriaIds) === 0) {
            return redirect()->route('admin.penilaian.index')->with('error', 'Tidak ada kriteria aktif.');
        }

        $data = $request->validate([
            'nilai' => ['required', 'array'],
        ]);

        foreach ($kriteriaIds as $kriteriaId) {
            $request->validate([
                'nilai.'.$kriteriaId => ['required', 'numeric', 'min:1', 'max:5'],
            ]);
        }

        DB::transaction(function () use ($warga, $kriteriaIds, $data) {
            foreach ($kriteriaIds as $kriteriaId) {
                Penilaian::query()->updateOrCreate(
                    ['warga_id' => $warga->id, 'kriteria_id' => $kriteriaId],
                    ['nilai' => $data['nilai'][$kriteriaId]],
                );
            }
        });

        return redirect()->route('admin.penilaian.index')->with('success', 'Penilaian berhasil disimpan.');
    }
}
