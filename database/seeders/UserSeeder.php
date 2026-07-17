<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'uuid' => (string) Str::uuid(),
            'username' => 'admin',
            'pin' => Hash::make('123456'), // PIN bisa disesuaikan, bcrypt agar aman
            'hak_akses' => 'admin',
        ]);

        // User biasa
        User::create([
            'uuid' => (string) Str::uuid(),
            'username' => 'user',
            'pin' => Hash::make('123456'), // PIN bisa disesuaikan
            'hak_akses' => 'user',
        ]);
    }
}
