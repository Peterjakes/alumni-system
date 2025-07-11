<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the users table with an admin and sample alumni.
     */
    public function run(): void
    {
        // Created an admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@alumni.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Created a sample alumni user
        User::create([
            'name' => 'John Alumni',
            'email' => 'john@alumni.com',
            'password' => Hash::make('alumni123'),
            'role' => 'alumni',
        ]);
    }
}
