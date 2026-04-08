<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'name',
        'parent_id',
        'role',
        'activity',
        'object',
    ];
}
