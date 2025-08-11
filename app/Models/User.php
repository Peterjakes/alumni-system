<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Event; 

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * Added 'role', 'status', 'phone', 'graduation_year', 'profile_photo_path'
     * to allow mass assignment for new user profile and approval features.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Added: 'admin' or 'alumni'
        'status', // Added: 'pending', 'approved', 'rejected' for user approval
        'phone', // Added: User's phone number for M-Pesa and contact
        'graduation_year', // Added: Alumni's graduation year
        'profile_photo_path', // Added: Path to user's profile photo
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Many-to-Many: A user can register for many events.
     * Defines the relationship where a User can have many registered Events.
     */
    public function registeredEvents()
    {
        return $this->belongsToMany(Event::class, 'event_user');
    }

    /**
     * One-to-Many: A user can make many M-Pesa donations.
     * Defines the relationship where a User can have many MPesaDonations.
     */
    public function mpesaDonations()
    {
        return $this->hasMany(MPesaDonation::class);
    }
}