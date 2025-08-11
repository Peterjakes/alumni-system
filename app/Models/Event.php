<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; 

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * Removed 'price' as events are free. 'image_url' remains.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'event_date',
        'location',
        'image_url', // Added: URL for event banner/thumbnail
    ];

    /**
     * Many-to-Many: An event can have many users (alumni) registered.
     * Defines the relationship where an Event can have many attendees (Users).
     */
    public function attendees()
    {
        return $this->belongsToMany(User::class, 'event_user');
    }
}
