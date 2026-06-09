<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reservations')->insert([
            [
                'id' => 1,
                'user_id' => 2,
                'room_id' => 1,
                'tanggal' => '2025-12-10',
                'waktu_mulai' => '09:00',
                'waktu_berakhir' => '10:00',
                'tujuan' => 'Rapat koordinasi proyek',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'user_id' => 3,
                'room_id' => 2,
                'tanggal' => '2025-12-11',
                'waktu_mulai' => '13:00',
                'waktu_berakhir' => '15:00',
                'tujuan' => 'Presentasi hasil kerja',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'user_id' => 1,
                'room_id' => 3,
                'tanggal' => '2025-12-12',
                'waktu_mulai' => '10:00',
                'waktu_berakhir' => '11:30',
                'tujuan' => 'Diskusi internal tim',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
