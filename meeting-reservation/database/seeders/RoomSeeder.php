<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        DB::table('rooms')->insert([
            [
                'id' => 1,
                'nama' => 'Conversation Hall',
                'kapasitas' => '100',
                'lokasi' => 'Gedung B Universitas Teknologi Bandung',
                'deskripsi' => 'Ruangan Max 100 orang, dilengkapi dengan AC, Proyektor, Sound System.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama' => 'Ruang Serba Guna',
                'kapasitas' => '50',
                'lokasi' => 'Gedung A Ruangan Serba Guna Lantai 2',
                'deskripsi' => 'Kursi dengan Kapasitas 50 orang, dilengkapi dengan AC dan Proyektor.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nama' => 'Lab Komputer Lantai 3',
                'kapasitas' => '25',
                'lokasi' => 'Gedung A Lab Komputer Lantai 3',
                'deskripsi' => 'Dilengkapi dengan 25 unit komputer, AC, dan Proyektor.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
