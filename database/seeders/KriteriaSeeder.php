<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use App\Models\SubKriteria;
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
                'nama_kriteria' => 'Penghasilan Keluarga',
                'bobot'         => 0.300000,
                'jenis_atribut' => 'cost',
                'status'        => true,
                'sub_kriteria'  => [
                    ['nilai' => 1, 'nama_sub_kriteria' => '> Rp 3.000.000 / bulan'],
                    ['nilai' => 2, 'nama_sub_kriteria' => 'Rp 2.000.001 – Rp 3.000.000 / bulan'],
                    ['nilai' => 3, 'nama_sub_kriteria' => 'Rp 1.000.001 – Rp 2.000.000 / bulan'],
                    ['nilai' => 4, 'nama_sub_kriteria' => 'Rp 500.001 – Rp 1.000.000 / bulan'],
                    ['nilai' => 5, 'nama_sub_kriteria' => '<= Rp 500.000 / bulan'],
                ],
            ],
            [
                'kode_kriteria' => 'C2',
                'nama_kriteria' => 'Kondisi Rumah',
                'bobot'         => 0.250000,
                'jenis_atribut' => 'cost',
                'status'        => true,
                'sub_kriteria'  => [
                    ['nilai' => 1, 'nama_sub_kriteria' => 'Permanen dan sangat layak huni'],
                    ['nilai' => 2, 'nama_sub_kriteria' => 'Permanen namun perlu perbaikan'],
                    ['nilai' => 3, 'nama_sub_kriteria' => 'Semi permanen'],
                    ['nilai' => 4, 'nama_sub_kriteria' => 'Tidak permanen (kayu/bambu)'],
                    ['nilai' => 5, 'nama_sub_kriteria' => 'Tidak layak huni / gubuk'],
                ],
            ],
            [
                'kode_kriteria' => 'C3',
                'nama_kriteria' => 'Jumlah Tanggungan',
                'bobot'         => 0.200000,
                'jenis_atribut' => 'benefit',
                'status'        => true,
                'sub_kriteria'  => [
                    ['nilai' => 1, 'nama_sub_kriteria' => '1 orang'],
                    ['nilai' => 2, 'nama_sub_kriteria' => '2 orang'],
                    ['nilai' => 3, 'nama_sub_kriteria' => '3 orang'],
                    ['nilai' => 4, 'nama_sub_kriteria' => '4 orang'],
                    ['nilai' => 5, 'nama_sub_kriteria' => '>= 5 orang'],
                ],
            ],
            [
                'kode_kriteria' => 'C4',
                'nama_kriteria' => 'Kepemilikan Aset',
                'bobot'         => 0.150000,
                'jenis_atribut' => 'cost',
                'status'        => true,
                'sub_kriteria'  => [
                    ['nilai' => 1, 'nama_sub_kriteria' => 'Memiliki kendaraan bermotor & aset berharga > Rp 50jt'],
                    ['nilai' => 2, 'nama_sub_kriteria' => 'Memiliki kendaraan bermotor saja'],
                    ['nilai' => 3, 'nama_sub_kriteria' => 'Memiliki aset elektronik bernilai sedang'],
                    ['nilai' => 4, 'nama_sub_kriteria' => 'Hanya memiliki perabot rumah tangga dasar'],
                    ['nilai' => 5, 'nama_sub_kriteria' => 'Tidak memiliki aset apapun'],
                ],
            ],
            [
                'kode_kriteria' => 'C5',
                'nama_kriteria' => 'Akses Layanan Kesehatan',
                'bobot'         => 0.100000,
                'jenis_atribut' => 'cost',
                'status'        => true,
                'sub_kriteria'  => [
                    ['nilai' => 1, 'nama_sub_kriteria' => 'Memiliki BPJS aktif & mudah akses fasilitas kesehatan'],
                    ['nilai' => 2, 'nama_sub_kriteria' => 'Memiliki BPJS aktif namun akses terbatas'],
                    ['nilai' => 3, 'nama_sub_kriteria' => 'BPJS tidak aktif namun bisa berobat'],
                    ['nilai' => 4, 'nama_sub_kriteria' => 'Tidak memiliki jaminan kesehatan apapun'],
                    ['nilai' => 5, 'nama_sub_kriteria' => 'Tidak memiliki jaminan & tidak pernah berobat'],
                ],
            ],
        ];

        foreach ($kriteriaData as $data) {
            $subKriteriaData = $data['sub_kriteria'];
            unset($data['sub_kriteria']);

            $kriteria = Kriteria::query()->firstOrCreate(
                ['kode_kriteria' => $data['kode_kriteria']],
                $data,
            );

            foreach ($subKriteriaData as $sub) {
                SubKriteria::query()->firstOrCreate(
                    ['kriteria_id' => $kriteria->id, 'nilai' => $sub['nilai']],
                    ['nama_sub_kriteria' => $sub['nama_sub_kriteria']],
                );
            }
        }
    }
}
