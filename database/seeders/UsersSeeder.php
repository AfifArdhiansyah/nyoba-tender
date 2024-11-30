<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['id' => '123.456', 'nama' => 'Cecep Kurna', 'password' => '12345678', 'is_active' => 'true', 'role' => 'manager-pusat', 'office_id' => '1'],
            // Tambahkan data lainnya
        ]);
    }
}
