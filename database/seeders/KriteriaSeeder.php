<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kriteriaData = [
            [
                'kode_kriteria' => 'C1',
                'nama_kriteria' => 'Penghasilan Per Bulan',
                'bobot' => 0.30,
                'jenis_atribut' => 'cost', // Semakin kecil gaji, semakin berhak mendapat (Cost)
                'status' => true,
                'sub_kriteria' => [
                    ['nama_sub_kriteria' => '< Rp 500.000', 'nilai' => 1],
                    ['nama_sub_kriteria' => 'Rp 500.000 - Rp 1.000.000', 'nilai' => 2],
                    ['nama_sub_kriteria' => 'Rp 1.000.000 - Rp 2.000.000', 'nilai' => 3],
                    ['nama_sub_kriteria' => '> Rp 2.000.000', 'nilai' => 4],
                ],
            ],
            [
                'kode_kriteria' => 'C2',
                'nama_kriteria' => 'Jumlah Tanggungan / Anak',
                'bobot' => 0.20,
                'jenis_atribut' => 'benefit', // Semakin besar tanggungan, semakin berhak mendapat (Benefit)
                'status' => true,
                'sub_kriteria' => [
                    ['nama_sub_kriteria' => '> 4 Orang', 'nilai' => 5],
                    ['nama_sub_kriteria' => '3 - 4 Orang', 'nilai' => 4],
                    ['nama_sub_kriteria' => '2 Orang', 'nilai' => 3],
                    ['nama_sub_kriteria' => '1 Orang', 'nilai' => 2],
                    ['nama_sub_kriteria' => 'Tidak Ada', 'nilai' => 1],
                ],
            ],
            [
                'kode_kriteria' => 'C3',
                'nama_kriteria' => 'Pekerjaan Kepala Keluarga',
                'bobot' => 0.20,
                'jenis_atribut' => 'benefit',
                'status' => true,
                'sub_kriteria' => [
                    ['nama_sub_kriteria' => 'Tidak Bekerja / Serabutan', 'nilai' => 5],
                    ['nama_sub_kriteria' => 'Buruh / Tani', 'nilai' => 4],
                    ['nama_sub_kriteria' => 'Pedagang Kecil / UMKM', 'nilai' => 3],
                    ['nama_sub_kriteria' => 'Karyawan Swasta', 'nilai' => 2],
                    ['nama_sub_kriteria' => 'PNS / TNI / Polri / BUMN', 'nilai' => 1],
                ],
            ],
            [
                'kode_kriteria' => 'C4',
                'nama_kriteria' => 'Status Tempat Tinggal',
                'bobot' => 0.15,
                'jenis_atribut' => 'benefit',
                'status' => true,
                'sub_kriteria' => [
                    ['nama_sub_kriteria' => 'Menumpang (Keluarga/Orang Lain)', 'nilai' => 5],
                    ['nama_sub_kriteria' => 'Sewa / Kontrak', 'nilai' => 3],
                    ['nama_sub_kriteria' => 'Milik Sendiri', 'nilai' => 1],
                ],
            ],
            [
                'kode_kriteria' => 'C5',
                'nama_kriteria' => 'Kondisi Rumah',
                'bobot' => 0.15,
                'jenis_atribut' => 'benefit',
                'status' => true,
                'sub_kriteria' => [
                    ['nama_sub_kriteria' => 'Dinding Bambu/Kayu, Lantai Tanah', 'nilai' => 5],
                    ['nama_sub_kriteria' => 'Dinding Semi Permanen, Lantai Semen', 'nilai' => 3],
                    ['nama_sub_kriteria' => 'Dinding Tembok, Lantai Keramik', 'nilai' => 1],
                ],
            ],
        ];

        foreach ($kriteriaData as $data) {
            $subKriteria = $data['sub_kriteria'];
            unset($data['sub_kriteria']);

            $kriteria = Kriteria::query()->updateOrCreate(
                ['kode_kriteria' => $data['kode_kriteria']],
                $data
            );

            $kriteria->subKriteria()->delete();
            $kriteria->subKriteria()->createMany($subKriteria);
        }
    }
}
