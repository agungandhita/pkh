<?php

namespace Database\Seeders;

use App\Models\Warga;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 50; $i++) {
            Warga::create([
                'nik' => $faker->unique()->numerify('################'),
                'nama' => $faker->name(),
                'alamat' => $faker->streetAddress() . ', ' . $faker->city(),
                'rt' => str_pad((string) $faker->numberBetween(1, 15), 3, '0', STR_PAD_LEFT),
                'rw' => str_pad((string) $faker->numberBetween(1, 10), 3, '0', STR_PAD_LEFT),
                'status_dtks' => $faker->boolean(70),
            ]);
        }
    }
}
