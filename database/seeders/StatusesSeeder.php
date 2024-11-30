<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statuses')->insert([
            ['id' => 1, 'nama' => 'pemenang baru'],
            ['id' => 2, 'nama' => 'penawaran'],
            ['id' => 3, 'nama' => 'pengajuan'],
            ['id' => 4, 'nama' => 'tidak berminat'],
            ['id' => 5, 'nama' => 'kredit disetujui'],
            ['id' => 6, 'nama' => 'kredit gagal'],
        ]);
    }
}
