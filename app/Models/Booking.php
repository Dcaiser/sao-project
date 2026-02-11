<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'order_code',
        'date_start',
        'date_end',
        'notes',
        'booking_status',
    ];

    public function items()
    {
        return $this->hasMany(Bookingitem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
