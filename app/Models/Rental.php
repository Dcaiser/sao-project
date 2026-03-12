<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = [
        'id',
        'rental_code',
        'user_id',
        'product_id',
        'rental_start_date',
        'rental_end_date',
        'rental_start_time',
        'rental_end_time',
        'reason',
        'rental_status',

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
