<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('offices')->insert([
            ['id' => '1', 'kota_kab' => 'Bandung', 'nama' => 'Kantor Pusat', 'alamat' => 'Jalan Naripan', 'ltd_loc' => '-6.914744', 'lng_loc' => '107.609810', 'type' => 'pusat', 'kanwil_id' => 0],
            // Tambahkan data lainnya
        ]);   
    }
}
