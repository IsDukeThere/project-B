<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Bikin 1 akun Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@projectb.com',
            'password' => Hash::make('rahasia123'),
            'role' => 'admin',
        ]);

        // Bikin 1 akun Customer
        User::create([
            'name' => 'Pelanggan Setia',
            'email' => 'customer@projectb.com',
            'password' => Hash::make('rahasia123'),
            'role' => 'customer',
        ]);
    }
}
