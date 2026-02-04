<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->updateOrInsert(
            ['email' => 'admin@brookehennen.com'], // Check if exists by email
            [
                'name' =>  'Brook Admin',
                'password' => Hash::make('securePassword123'), // <--- CRITICAL: Encrypts the password
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}