<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use App\Models\Pengaturan;
use App\Models\SubKriteria;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminEmail = 'admin@pkh.test';
        $adminPassword = 'password';

        User::query()->firstOrCreate(
            ['email' => $adminEmail],
            [
                'name' => 'Admin',
                'password' => Hash::make($adminPassword),
            ],
        );

        Pengaturan::query()->firstOrCreate(
            ['id' => 1],
            ['threshold_kelayakan' => 0.600000],
        );

        $import = $this->parseKriteriaFromDocx(base_path('50 kriteria.docx'));

        if (count($import) === 50) {
            DB::transaction(function () use ($import) {
                foreach ($import as $row) {
                    $kriteria = Kriteria::query()->updateOrCreate(
                        ['kode_kriteria' => $row['kode_kriteria']],
                        [
                            'nama_kriteria' => $row['nama_kriteria'],
                            'bobot' => $row['bobot'],
                            'jenis_atribut' => $row['jenis_atribut'],
                            'status' => $row['status'],
                        ],
                    );

                    SubKriteria::query()
                        ->where('kriteria_id', $kriteria->id)
                        ->delete();

                    if (! empty($row['sub_kriteria'])) {
                        $now = now();
                        $subRows = array_map(
                            fn ($sub) => [
                                'kriteria_id' => $kriteria->id,
                                'nama_sub_kriteria' => $sub['nama_sub_kriteria'],
                                'nilai' => $sub['nilai'],
                                'created_at' => $now,
                                'updated_at' => $now,
                            ],
                            $row['sub_kriteria'],
                        );

                        SubKriteria::query()->insert($subRows);
                    }
                }
            });
        }
    }

    private function parseKriteriaFromDocx(string $path): array
    {
        if (! file_exists($path)) {
            return [];
        }

        $zip = new \ZipArchive;
        if ($zip->open($path) !== true) {
            return [];
        }

        $xml = $zip->getFromName('word/document.xml');
        $zip->close();

        if (! is_string($xml) || $xml === '') {
            return [];
        }

        $previous = libxml_use_internal_errors(true);
        $doc = new \DOMDocument;
        $loaded = $doc->loadXML($xml, LIBXML_NONET | LIBXML_NOERROR | LIBXML_NOWARNING);
        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        if (! $loaded) {
            return [];
        }

        $xpath = new \DOMXPath($doc);
        $xpath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');

        $tables = $xpath->query('//w:tbl');
        if (! $tables || $tables->length === 0) {
            return [];
        }

        $bestTable = null;
        $bestRowCount = -1;

        foreach ($tables as $tbl) {
            $trs = $xpath->query('./w:tr', $tbl);
            $count = $trs ? $trs->length : 0;
            if ($count > $bestRowCount) {
                $bestRowCount = $count;
                $bestTable = $tbl;
            }
        }

        if (! $bestTable) {
            return [];
        }

        $rows = [];
        $trs = $xpath->query('./w:tr', $bestTable);
        foreach ($trs as $tr) {
            $cells = [];
            $tcs = $xpath->query('./w:tc', $tr);
            foreach ($tcs as $tc) {
                $texts = [];
                $ts = $xpath->query('.//w:t', $tc);
                foreach ($ts as $t) {
                    $texts[] = $t->textContent;
                }
                $cell = preg_replace('/\s+/u', ' ', trim(implode('', $texts)));
                $cells[] = $cell;
            }
            if (count(array_filter($cells, fn ($v) => $v !== '')) > 0) {
                $rows[] = $cells;
            }
        }

        $result = [];
        foreach ($rows as $cells) {
            $kode = trim((string) ($cells[0] ?? ''));
            if (! preg_match('/^C\d+$/', $kode)) {
                continue;
            }

            $nama = trim((string) ($cells[1] ?? ''));
            $subText = trim((string) ($cells[2] ?? ''));
            $bobotText = trim((string) ($cells[3] ?? ''));

            $bobotSanitized = preg_replace('/[^0-9,.\-]/', '', $bobotText);
            $bobotSanitized = str_replace(',', '.', (string) $bobotSanitized);
            $bobot = (float) $bobotSanitized;

            $subKriteria = [];
            if ($subText !== '') {
                if (preg_match_all('/([^()]+?)\s*\((\d{1,2})\)/u', $subText, $m, PREG_SET_ORDER)) {
                    foreach ($m as $match) {
                        $label = preg_replace('/\s+/u', ' ', trim($match[1]));
                        $nilai = (int) $match[2];
                        if ($label === '' || $nilai <= 0) {
                            continue;
                        }
                        $subKriteria[] = [
                            'nama_sub_kriteria' => $label,
                            'nilai' => $nilai,
                        ];
                    }
                }
            }

            usort($subKriteria, fn ($a, $b) => $a['nilai'] <=> $b['nilai']);

            $result[] = [
                'kode_kriteria' => $kode,
                'nama_kriteria' => $nama,
                'bobot' => $bobot,
                'jenis_atribut' => 'benefit',
                'status' => true,
                'sub_kriteria' => $subKriteria,
            ];
        }

        usort($result, fn ($a, $b) => (int) substr($a['kode_kriteria'], 1) <=> (int) substr($b['kode_kriteria'], 1));

        return $result;
    }
}
