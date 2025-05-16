<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // unique check
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'status' => 1, // assuming status 1 means active
                'role_id' => 1, // adjust according to your role setup
                'password' => Hash::make('Drc@1234'), // use a secure password
            ]
        );
    }
}
