<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'user_id',
        'status',
        'gbpReferenceNo',
        'price',
        'created_at',
        'updated_at',
    ];
}
