<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = [
        'rental_code',
        'user_id',
        'product_id',
        'rental_start_date',
        'rental_end_date',
        'rental_start_time',
        'rental_end_time',
        'rental_status',
    ];
}
