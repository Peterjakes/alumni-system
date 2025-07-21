<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; 

class Event extends Model
{
    use HasFactory;

    /**
     * Many-to-Many: An event can have many users (alumni) registered
     */
    public function attendees()
    {
        return $this->belongsToMany(User::class, 'event_user');
    }
}
