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

        $this->call([
            KriteriaSeeder::class,
            WargaSeeder::class,
        ]);
    }
}
