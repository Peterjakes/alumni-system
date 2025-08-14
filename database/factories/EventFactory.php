<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        $eventTypes = ['Workshop', 'Seminar', 'Conference', 'Networking', 'Alumni Meet', 'Career Fair', 'Tech Talk', 'Panel Discussion'];
        $locations = ['Main Auditorium', 'Conference Room A', 'Tech Hub', 'Library Hall', 'Student Center', 'Innovation Lab', 'Outdoor Pavilion'];
        
        return [
            'title' => $this->faker->randomElement($eventTypes) . ': ' . $this->faker->catchPhrase(),
            'description' => $this->faker->paragraph(3),
            'event_date' => $this->faker->dateTimeBetween('now', '+6 months'),
            'location' => $this->faker->randomElement($locations),
            'image_url' => '/placeholder.svg?height=200&width=400',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
