<?php

namespace Database\Seeders;

use App\Models\Kota;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fileKota= file_get_contents(base_path('/database/kota.json'));
        $fileKabupaten= file_get_contents(base_path('/database/kabupaten.json'));

        $dataKota= json_decode($fileKota, true);
        $dataKabupaten= json_decode($fileKabupaten, true);


         Kota::insert($dataKota);
         Kota::insert($dataKabupaten);
    }
}