<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rentalitem extends Model
{
    protected $table = 'rentalitems';

    protected $fillable = [
        'rental_id',
        'product_id',
        'quantity',
    ];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
