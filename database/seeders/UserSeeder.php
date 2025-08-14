<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@alumni.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'john@alumni.com'],
            [
                'name' => 'John Alumni',
                'password' => Hash::make('alumni123'),
                'role' => 'alumni',
                'email_verified_at' => now(),
            ]
        );
        
        User::factory()->count(20)->create();
        
        $this->command->info('Created your admin, sample alumni, and 20 additional alumni users successfully!');
    }
}
