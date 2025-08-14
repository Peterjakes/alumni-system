<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        $graduationYears = range(2015, 2023);
        $courses = ['Computer Science', 'Information Technology', 'Software Engineering', 'Data Science', 'Cybersecurity', 'Web Development'];
        
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password123'), // Default password for all test users
            'phone' => $this->faker->phoneNumber(),
            'graduation_year' => $this->faker->randomElement($graduationYears),
            'bio' => $this->faker->sentence(10),
            'profile_photo_path' => null,
            'role' => 'alumni', // All generated users will be alumni
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
