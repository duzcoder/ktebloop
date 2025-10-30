<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@ktebloop.com',
            'password' => Hash::make('password'),
            'phone' => '+212600000000',
        ]);

        User::create([
            'name' => 'Jean Dupont',
            'email' => 'jean.dupont@example.com',
            'password' => Hash::make('password'),
            'phone' => '+212611111111',
        ]);

        User::create([
            'name' => 'Marie Martin',
            'email' => 'marie.martin@example.com',
            'password' => Hash::make('password'),
            'phone' => '+212622222222',
        ]);
    }
}