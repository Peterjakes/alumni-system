<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPesaDonation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * Added 'checkout_request_id' for M-Pesa callback matching.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name', // Added name field for donor identification
        'amount',
        'phone',
        'transaction_id',
        'status',
        'checkout_request_id', // Added: Unique ID from M-Pesa STK push for callback matching
    ];

    /**
     * One-to-Many (Inverse): A donation belongs to a user.
     * Defines the inverse relationship where an MPesaDonation belongs to a User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
