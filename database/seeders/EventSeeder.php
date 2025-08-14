<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        Event::factory()->count(15)->create();
        
        $this->command->info('Created 15 events successfully!');
    }
}
