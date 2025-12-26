<?php

namespace App\Services;

use App\Models\HasilSaw;
use App\Models\Kriteria;
use App\Models\Pengaturan;
use App\Models\Penilaian;
use App\Models\Warga;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SawService
{
    public function calculate(): array
    {
        $kriteria = Kriteria::query()
            ->where('status', true)
            ->orderBy('kode_kriteria')
            ->get(['id', 'kode_kriteria', 'nama_kriteria', 'bobot', 'jenis_atribut']);

        $warga = Warga::query()->orderBy('nama')->get(['id', 'nik', 'nama']);

        $threshold = (float) (Pengaturan::query()->value('threshold_kelayakan') ?? 0.6);

        if ($kriteria->isEmpty() || $warga->isEmpty()) {
            return [
                'kriteria' => $kriteria,
                'warga' => $warga,
                'matrix' => [],
                'normalized' => [],
                'weights' => [],
                'results' => [],
                'threshold' => $threshold,
            ];
        }

        $weights = $this->normalizeWeights($kriteria);

        $nilai = Penilaian::query()
            ->whereIn('kriteria_id', $kriteria->pluck('id'))
            ->whereIn('warga_id', $warga->pluck('id'))
            ->get(['warga_id', 'kriteria_id', 'nilai'])
            ->groupBy('warga_id')
            ->map(fn (Collection $rows) => $rows->keyBy('kriteria_id'));

        $matrix = [];
        foreach ($warga as $w) {
            $row = [];
            foreach ($kriteria as $k) {
                $row[$k->id] = (float) ($nilai[$w->id][$k->id]->nilai ?? 0.0);
            }
            $matrix[$w->id] = $row;
        }

        $normalized = $this->normalizeMatrix($kriteria, $matrix);

        $results = [];
        foreach ($warga as $w) {
            $score = 0.0;
            foreach ($kriteria as $k) {
                $score += ($weights[$k->id] ?? 0.0) * ($normalized[$w->id][$k->id] ?? 0.0);
            }
            $results[] = [
                'warga_id' => $w->id,
                'nilai_preferensi' => $score,
            ];
        }

        usort($results, fn ($a, $b) => $b['nilai_preferensi'] <=> $a['nilai_preferensi']);

        $ranked = [];
        $rank = 1;
        foreach ($results as $row) {
            $status = $row['nilai_preferensi'] >= $threshold ? 'layak' : 'tidak';
            $ranked[] = [
                'warga_id' => $row['warga_id'],
                'nilai_preferensi' => $row['nilai_preferensi'],
                'peringkat' => $rank,
                'status_kelayakan' => $status,
            ];
            $rank++;
        }

        $wargaIds = $warga->pluck('id')->all();

        DB::transaction(function () use ($ranked, $wargaIds) {
            HasilSaw::query()
                ->whereNotIn('warga_id', $wargaIds)
                ->delete();

            foreach ($ranked as $row) {
                HasilSaw::query()->updateOrCreate(
                    ['warga_id' => $row['warga_id']],
                    [
                        'nilai_preferensi' => $row['nilai_preferensi'],
                        'peringkat' => $row['peringkat'],
                        'status_kelayakan' => $row['status_kelayakan'],
                    ],
                );
            }
        });

        return [
            'kriteria' => $kriteria,
            'warga' => $warga,
            'matrix' => $matrix,
            'normalized' => $normalized,
            'weights' => $weights,
            'results' => $ranked,
            'threshold' => $threshold,
        ];
    }

    private function normalizeWeights(Collection $kriteria): array
    {
        $sum = (float) $kriteria->sum(fn ($k) => (float) $k->bobot);

        if ($sum <= 0) {
            $equal = 1.0 / max((int) $kriteria->count(), 1);

            return $kriteria->mapWithKeys(fn ($k) => [$k->id => $equal])->all();
        }

        return $kriteria
            ->mapWithKeys(fn ($k) => [$k->id => (float) $k->bobot / $sum])
            ->all();
    }

    private function normalizeMatrix(Collection $kriteria, array $matrix): array
    {
        $maxByKriteria = [];
        $minByKriteria = [];

        foreach ($kriteria as $k) {
            $values = array_map(fn ($row) => $row[$k->id] ?? 0.0, $matrix);
            $maxByKriteria[$k->id] = max($values);
            $minByKriteria[$k->id] = min($values);
        }

        $normalized = [];
        foreach ($matrix as $wargaId => $row) {
            foreach ($kriteria as $k) {
                $x = (float) ($row[$k->id] ?? 0.0);

                if ($k->jenis_atribut === 'cost') {
                    $min = (float) ($minByKriteria[$k->id] ?? 0.0);
                    $normalized[$wargaId][$k->id] = $x > 0 ? $min / $x : 0.0;
                } else {
                    $max = (float) ($maxByKriteria[$k->id] ?? 0.0);
                    $normalized[$wargaId][$k->id] = $max > 0 ? $x / $max : 0.0;
                }
            }
        }

        return $normalized;
    }
}
