<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceRange extends Model
{
    protected $table = 'price_ranges';
    protected $fillable = [
        'price',
        'created_at',
        'updated_at',
    ];
}
