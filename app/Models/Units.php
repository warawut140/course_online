<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
    protected $table = 'units';
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];
}
