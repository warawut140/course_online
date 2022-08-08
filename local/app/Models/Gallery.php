<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'galleries';
    protected $fillable = [
        'filename',
        'type',
        'isActive',
        'original_name',
        'actby',
        'created_at',
        'updated_at',
    ];
}
