<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'bookingitem_id',
        'rental_id',
        'product_id',
        'rental_code',
        'borrower_name',
        'borrower_phone',
        'product_name',
        'category_name',
        'quantity',
        'rental_start_date',
        'rental_end_date',
        'rental_status',
    ];

    protected $casts = [
        'rental_start_date' => 'date',
        'rental_end_date' => 'date',
    ];
}
