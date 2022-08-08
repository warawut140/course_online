<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Standards extends Model
{
    protected $table = 'standards';
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];
}
