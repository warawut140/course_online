<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BitCoin extends Model
{
    protected $table = 'bit_coins';
    protected $fillable = [
        'profile_id',
        'coins',
        'created_at',
        'updated_at',
    ];
}
