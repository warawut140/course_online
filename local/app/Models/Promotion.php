<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotions';
    protected $fillable = [
        'title',
        'details',
        'filename',
        'month',
        'year',
        'startdate',
        'enddate',
        'admin_id',
        'created_at',
        'updated_at',
    ];
}
