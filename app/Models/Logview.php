<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logview extends Model
{
    protected $table = 'logviews';
    protected $fillable = [
        'wp_id',
        'ip',
        'count',
        'created_at',
        'updated_at',
    ];
}
