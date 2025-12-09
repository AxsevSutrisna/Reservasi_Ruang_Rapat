<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin Utama',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Asep Sutrisna Suhada Putra',
                'email' => 'asep@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('asep123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Dospem',
                'email' => 'dospem@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('dospem123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
