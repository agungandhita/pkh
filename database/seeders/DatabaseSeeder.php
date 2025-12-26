<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use App\Models\Pengaturan;
use App\Models\SubKriteria;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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

        if (Kriteria::query()->count() === 0) {
            $bobot = 1 / 50;
            $kriteriaRows = [];

            for ($i = 1; $i <= 50; $i++) {
                $kode = 'C'.$i;
                $kriteriaRows[] = [
                    'kode_kriteria' => $kode,
                    'nama_kriteria' => 'Kriteria '.$kode,
                    'bobot' => $bobot,
                    'jenis_atribut' => 'benefit',
                    'status' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            Kriteria::query()->insert($kriteriaRows);

            $subRows = [];
            $labels = [
                1 => 'Sangat Rendah',
                2 => 'Rendah',
                3 => 'Sedang',
                4 => 'Tinggi',
                5 => 'Sangat Tinggi',
            ];

            $kriteriaIds = Kriteria::query()->pluck('id');

            foreach ($kriteriaIds as $kriteriaId) {
                foreach ($labels as $nilai => $label) {
                    $subRows[] = [
                        'kriteria_id' => $kriteriaId,
                        'nama_sub_kriteria' => $label,
                        'nilai' => $nilai,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            SubKriteria::query()->insert($subRows);
        }
    }
}
