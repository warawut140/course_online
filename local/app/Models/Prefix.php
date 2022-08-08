<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prefix extends Model
{
    protected $table = 'prefixes';
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];
}
