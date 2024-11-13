<?php

namespace Database\Seeders;

use App\Models\Kurir;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KurirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kurir::insert([
            [
                'code'=>'jne',
                'title'=>'Jalur Nugraha Ekakurir (JNE)'
            ],
            [
                'code'=>'pos',
                'title'=>'POS Indonesia'
            ],
            [
                'code'=>'tiki',
                'title'=>'Citra Van Titipan Kilat'
            ],
        ]);
    }
}